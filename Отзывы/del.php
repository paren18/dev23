<?php
session_start();
require_once '../db1.php';

$result = mysqli_query($mysql, "SELECT * FROM `otziv`");

foreach ($result as $otziv) {
    $userlogin = $_SESSION["user"]['login'];
    $otzivlogin = $otziv["login"];
    $otzivid = $otziv['id'];

    if ($userlogin == $otzivlogin) {
        // Удаление комментариев связанных с отзывом
        $mysql->query("DELETE FROM `comments` WHERE `idotziv` = '$otzivid'");

        // Затем удаление самого отзыва
        $mysql->query("DELETE FROM `otziv` WHERE `id` = '$otzivid'");
    } else {
        $_SESSION['commistake'] = 'Это не ваш комментарий';
    }
}

header('Location: Отзывы.php');
?>
