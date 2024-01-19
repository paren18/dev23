<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dev23";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login = $_POST['login'];
$name = $_POST['name'];
$pass = $_POST['pass'];
$pass_too = $_POST['pass_too'];

if (empty($login) || empty($pass)) {
    echo '<div class="py-2 bg-danger text-black">Введите логин или пароль</div>';
} else {
    $result1 = $conn->query("SELECT * FROM `users` WHERE `login` = '$login'");
    $user1 = $result1->fetch_assoc(); 

    if (!empty($user1)) {
        echo '<div class="py-2 bg-warning text-black">Данный логин уже используется!</div>';
    } else if ($pass === $pass_too) {
        $conn->query("INSERT INTO `users` (`login`, `pass`, `name`) VALUES ('$login', '$pass', '$name')");
        echo '<div class="py-2 bg-success text-black">Вы зарегистрировались</div>';
    } else {
        echo '<div class="py-2 bg-danger text-black">Пароли не совпадают</div>';
    }
}

$conn->close();
?>