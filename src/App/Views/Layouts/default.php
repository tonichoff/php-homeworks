<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"-->
<!--          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" href="../main.css">-->
</head>
<body>
    <a href="http://localhost:8080">Главнная страница</a>
    <a href="http://localhost:8080/login">Вход</a>
    <a href="http://localhost:8080/register">Регистрация</a>
    <?php
        require $content;

        ?>
</body>