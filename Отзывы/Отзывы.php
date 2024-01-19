<?php
session_start();
require_once '../db1.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="отзыв.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../jqry/jquery-3.6.4.min.js"></script>
    <style>
    </style>
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
<div class="container mt-12">
    <div class="row">
        <div class="col-5">
            <div class="menu__part">

                <?php if (isset($_SESSION['user'])):
                    echo '<h2> ' . $_SESSION["user"]['login'] . '</h2>';
                    ?>
                    <form action="otziv.php" method="post">
                        <textarea type="text" name="heading" class="form-control " id="text" style="height: 40px;" placeholder=" Заголовок"></textarea>
                        <textarea type="text" name="summary" class="form-control" id="text" style="height: 40px;" placeholder=" Краткое содержание"></textarea>
                        <textarea type="text" name="text" class="form-control" id="text" placeholder=" Полный отзыв"></textarea>
                        <button class="btn btn-success" id="butt">Оставить отзыв</button>
                    </form>
                <?php else: ?>
                    <h2>Вы не можете остовлять отзывы</h2>
                <?php endif ?>
                <?php
                if (isset($_SESSION['commistake'])) {
                    echo '<p class="py-2  bg-warning text-black " style="margin-top: 30px;">' . $_SESSION['commistake'] . '</p>';
                }
                unset($_SESSION['commistake']);
                ?>

                </form>
            </div>
        </div>
        <div class="col-2"></div>
        <div class="col-5 pt-5">

            <?php
            $result = mysqli_query($mysql, "SELECT * FROM `otziv`");
            foreach ($result as $otziv) {
                ?>
                <table>
                    <tr><h1 class="mt-3">Заголовок: <?php echo $otziv["heading"] ?></h1></tr>
                   <tr><h3>Краткое содержание: <?php echo $otziv["summary"] ?></h3></tr>
                        <td><a href="del.php?id= <?php echo $otziv["id"]; ?>& login=<?php echo $otziv["login"]; ?> "
                               class="text-dark h5">Удалить комментарий</a></td>
                    <tr><td><a href="view.php?id= <?php echo $otziv["id"]; ?>& login=<?php echo $otziv["login"]; ?> "
                               class="text-dark h5">Посмотреть</a></td></tr>
                        <td></td>
                    </tr>


                </table>
            <?php } ?>
        </div>
    </div>


</div>
</body>
</html>




