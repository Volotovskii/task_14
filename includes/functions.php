<?php

// Функция получения списка пользователей и хэшей паролей
function getUsersList() {
    $users = [];
    $filePath = __DIR__ . '/../includes/db/users.json';
    // Загрузка данных пользователей из файла
    if (file_exists($filePath)) {
        $usersData = json_decode(file_get_contents($filePath), true);
        // Проверка на наличие данных
        if (!empty($usersData)) {
            
            $users = $usersData;
        }
    }
    return $users;
}



// Функция проверки существования пользователя
function existsUser($login) {
    $users = getUsersList();

    return isset($users[$login]);
}

// Функция проверки пароля
function checkPassword($login, $password) {
    $users = getUsersList();
    
    if (existsUser($login)) {
        return password_verify($password, $users[$login]['password']);
    }
    return false;
}

// Функция получения имени текущего пользователя
function getCurrentUser() {
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return null;
}

// Функция получения усгул
function getProductAll($discount)
{
    $productPath = __DIR__ . '/../includes/db/services.json';
    $products = json_decode(file_get_contents($productPath), true);


    // Выводим товары в блоках
    echo   "<div class='container'>";
        echo "<div class='product-container'>";
            foreach ($products as $product) {
                echo "<div class='product'>";
                echo "<div class='image'>";
                echo "<img src='{$product['image']}' alt='{$product['name']}'>";
                echo "</div>";
                echo "<h3>{$product['name']}</h3>";
  
                if ($discount > 0) {
                    echo "<p class='old'>Цена: {$product['price']} руб.</p>";
                    $discountedPrice = $product['price'] - ($product['price'] * $discount / 100);
                    echo "<p>Цена со скидкой: {$discountedPrice} руб.</p>";
                    echo "<p>Скидка: {$discount}%";
                }else{
                    echo "<p>Цена: {$product['price']} руб.</p>";
                }
                echo "</div>";
            }
        echo "</div>";
    echo "</div>";
}



?>


