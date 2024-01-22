<?php
session_start();
require_once '../db1.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($mysql, "SELECT * FROM `otziv` WHERE `id` = $id");
    $otziv = mysqli_fetch_assoc($result);

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка данных формы изменения отзыва
    $id = $_POST['id'];
    $heading = $_POST['heading'];
    $login = $_POST['login'];
    $summary = $_POST['summary'];
    $text = $_POST['text'];


    $queryUpdate = "UPDATE `otziv` SET `heading` = '$heading', `login` = '$login', `summary` = '$summary', `text` = '$text' WHERE `id` = $id";
    $result = mysqli_query($mysql, $queryUpdate);

    $commentText = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    if (!empty($commentText)) {
        $queryInsertComment = "INSERT INTO `comments` (`idotziv`, `text`) VALUES ($id, '$commentText')";
        $resultComment = mysqli_query($mysql, $queryInsertComment);
    }

    header('Location: Отзывы.php');
    exit();
    exit();
}
?>

<!DOCTYPE html>
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
        <div class="col-md-6 offset-md-3">
            <form method="post" action="edit.php">
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $otziv['id']; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="heading" class="form-label">Заголовок</label>
                    <input type="text" name="heading" value="<?php echo $otziv['heading']; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" name="login" value="<?php echo $otziv['login']; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">Краткое содержание</label>
                    <input type="text" name="summary" value="<?php echo $otziv['summary']; ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Полное содержание</label>
                    <textarea name="text" class="form-control"><?php echo $otziv['text']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий</label>
                    <textarea name="comment" class="form-control"></textarea>
                </div>
                <button type="submit" id="butt" class="btn btn-success offset-md-4">Сохранить изменения</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
