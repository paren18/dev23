<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="регестрация1.css">
    <script src="../jqry/jquery-3.6.4.min.js"></script>
    <script src="../jqry/js/lightbox-plus-jquery.js"></script>

    <title>Вход/Регистрация</title>
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
                <form action="Личный_кабинет.php">
                    <button class="btn btn-success" id="butt" type="submit">Личный кабинет</button>
                </form>
        <?php else: ?>
            <form action="Вход.php">
                <button class="btn btn-success" id="butt" type="submit">Вход</button>
            </form>
        <?php endif ?>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <h1>Форма регистрации</h1>
            <form id="regstr" method="post">
                <input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>
                <input type="text" name="name" class="form-control" id="name" placeholder="Имя"><br>
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>
                <input type="password" name="pass_too" class="form-control" id="pass_too"
                       placeholder="Потвердите пароль"><br>
                <button type="submit" class="btn btn-success" id="butt">Зарегистрироваться</button>
                <p></p>
                <div id="msg"></div>

            </form>
        </div>

        <div class="col-4"></div>

    </div>
</div>
<script>
    $(document).on('submit', '#regstr', function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "regstr.php",
            data: $(this).serialize(),
            success: function (data) {
                $('#msg').html(data);
                $('#regstr').find('input').val('');
            }
        });
    });
</script>
</body>
</html>