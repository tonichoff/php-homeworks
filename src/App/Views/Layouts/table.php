<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<a href="http://localhost:8080">Главнная страница</a>
<form method="POST">
<select name="field" id="combobox">
    <option name="id" selected>ID</option>
    <option name="login">Логин</option>
    <option name="email">Почта</option>
    <option name="birthday">День рождения</option>
</select><input name="input" type="text">
    <button id="button" onclick="buttonClick()">Поиск</button>
</form>
<table border="1">
    <caption>Резльутат поиска</caption>
    <tr>
        <th>ID</th>
        <th>Логин</th>
        <th>Почта</th>
        <th>Дата рождения</th>
    </tr>
    <?php
        $need_values = ['id', 'login', 'email', 'birthday'];
        for ($i = 0; $i < count($table); $i++) {
            $row = '<tr>';
            foreach ($need_values as $value) {
                $row .= '<td>' . $table[$i][$value] . '</td>';
            }
            $row .= '</tr>';
            print $row;
        }
    ?>
</table>
</body>