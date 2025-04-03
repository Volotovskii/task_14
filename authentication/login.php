<?php

session_start();
require_once '../includes/functions.php';
require_once './fun.php';

if (getCurrentUser()) {
    header('Location: ../index.html');
    exit;
}


if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (checkPassword($login, $password)) {
        $_SESSION['user'] = $login;
        $_SESSION['discount_expires'] = time() + 24 * 60 * 60;

        // Запоминаем время захода
        usersStock($login);

        header('Location: ../index.html');
        exit;
    } else {
        $_SESSION['error'] = 'Неверный логин или пароль.';
    }
}
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
//print_r($error);
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>

<body>


    <div class="container">
        <h1>Авторизация</h1>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <div class="login">
            <form method="post">
                <input type="text" name="login" id="login" placeholder="Логин" required><br>

                <input type="password" name="password" id="password" placeholder="Пароль" required><br>

                <button type="submit">Войти</button>
            </form>
        </div>
        <p>Ещё нет аккаунта? <a href="./registration.php">Зарегистрируйтесь</a></p>
    </div>
</body>

</html>