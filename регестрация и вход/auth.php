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
$pass = $_POST['pass'];

$stmt = $conn->prepare("SELECT * FROM `users` WHERE `login` = ? AND `pass` = ?");
$stmt->bind_param("ss", $login, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['user'] = [
        "login" => $user['login'],
        "name" => $user['name']
    ];
    
    echo '<div class="py-2  bg-success text-black ">Добро пожаловать</div>';
} else {
    echo '<div class="py-2  bg-danger text-black ">Неверный логин или пароль</div>';
}
?>
