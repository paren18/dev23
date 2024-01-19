<?php
session_start();
require_once '../db1.php';

if (isset($_SESSION["user"], $_POST['heading'], $_POST['summary'], $_POST['text'])) {
    $login = $_SESSION["user"]['login'];
    $heading = $_POST['heading'];
    $summary = $_POST['summary'];
    $text = $_POST['text'];

    // Подготовка SQL-запроса
    $sql = "INSERT INTO `otziv` (`login`, `text`, `heading`, `summary`) VALUES (?, ?, ?, ?)";

    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('ssss', $login, $text, $heading, $summary);

    if ($stmt->execute()) {
        // Редирект после успешного выполнения
        header('Location: Отзывы.php');
        exit();
    } else {
        // Обработка ошибки
        echo "Ошибка выполнения SQL-запроса: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Обработка ошибки отсутствия необходимых данных
    echo "Отсутствуют необходимые данные для добавления отзыва.";
}
?>
