<?php
session_start();
require_once '../db1.php';
$otzivId = $_GET['id'];
$otzivLogin = $_GET['login'];
$result = mysqli_query($mysql, "SELECT * FROM `otziv` WHERE `id` = $otzivId AND `login` = '$otzivLogin'");
$otziv = mysqli_fetch_assoc($result);

$resultComments = mysqli_query($mysql, "SELECT * FROM `comments` WHERE `idotziv` = $otzivId");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="отзыв.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../jqry/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="md-12" id="menu">
    <div class="menu__comp">
        <form action="../Отзывы/Отзывы.php">
            <button class="btn btn-success" id="butt" type="submit">Отзывы</button>
        </form>
    </div>
    <div class="menu__comp">
        <?php if (isset($_SESSION['user'])): ?>
            <form action="../регестрация и вход/Личный_кабинет.php">
                <button class="btn btn-success" id="butt" type="submit">Личный кабинет</button>
            </form>
        <?php else: ?>
            <form action="../регестрация и вход/регестрация.php">
                <button class="btn btn-success" id="butt" type="submit">Регистрация</button>
            </form>
        <?php endif ?>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
<h1><?php echo $otziv['heading']; ?></h1>
<h3>Автор: <?php echo $otziv['login']; ?></h3>
<h3>Краткое содержание: <?php echo $otziv['summary']; ?></h3>
<h2>Полное содержание:</h2>
<p class="border border-dark bg-white pb-5"><?php echo $otziv['text']; ?></p>

<a href="edit.php?id=<?php echo $otziv["id"]; ?>&login=<?php echo $otziv["login"]; ?>"
       class="text-dark h5">Изменить</a>
            <h2 class="mt-4">Комментарии:</h2>
            <?php
            while ($comment = mysqli_fetch_assoc($resultComments)) {
                echo '<p class="border border-dark bg-white pb-5">' . $comment['text'] . '</p>';
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>


