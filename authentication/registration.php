<?php

session_start();
require_once '../includes/functions.php';
require_once './fun.php';

if (getCurrentUser()) {
    header('Location: ../in.html');
    exit;
}


if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['birthday'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    if (existsUser($login)) {
        $error = 'Пользователь с таким логином уже существует.';
    } else {

        saveUser($login, $password, $birthday);

        header('Location: ../in.html');
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>

<body>



    <div class="container">
        <h1>Регистрация</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="login">
            <form method="post">
               
                <input type="text" name="login" id="login" placeholder="Логин" required><br>

                <input type="password" name="password" id="password" placeholder="Пароль" required><br>

                <label for="birthday">Дата рождения:</label>
                <input type="date" name="birthday" id="birthday" required><br><br>

                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</body>

</html>