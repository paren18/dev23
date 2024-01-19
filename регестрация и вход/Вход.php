<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="регестрация1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../jqry/jquery-3.6.4.min.js"></script>

    <title>Вход</title>
</head>
<body>
<div class="md-12" id="menu">
    <div class="menu__comp">
        <form action="../Отзывы/Отзывы.php" >
            <button class="btn btn-success" id="butt" type="submit">Отзывы</button>
        </form>
    </div>
    <div  class="menu__comp">
        <?php if (isset($_SESSION['user'])): ?>
                <form action="Личный_кабинет.php" >
                    <button class="btn btn-success" id="butt" type="submit">Личный кабинет</button>
                </form>
        <?php else: ?>
            <form action="регестрация.php" >
                <button class="btn btn-success" id="butt" type="submit">Регистрация</button>
            </form>

        <?php endif ?>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <h1>Вход</h1>
            <form id="auth" method="post">
                <input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>
                <button class="btn btn-success" id="butt" type="submit">Авторизоваться</button>
                <br>
                <p></p>

                <div id="msg"></div>
            </form>
        </div>
        <div class="col-4"></div>

    </div>
</div>
<script>
    $(document).on('submit', '#auth', function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "auth.php",
            data: $(this).serialize(),
            success: function (data) {
                $('#msg').html(data);
                $('#auth').find('input').val('');
            }
        });
    });
</script>
</body>
</html>