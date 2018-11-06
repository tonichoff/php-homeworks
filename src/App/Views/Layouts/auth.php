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
<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    echo 'Привет, ' . $user->getLogin();
}
require $content;
?>
</body>