<?php

// Сохраняем и перезаписываем время входа через 24чс + товар для акции
function usersStock($login) {

    $filePath = __DIR__ .'/../includes/db/session.json';


    // Загружаем существующих пользователей из файла, 
    // если он существует, иначе создаем пустой массив
    if (file_exists($filePath)) {
        $stock = json_decode(file_get_contents($filePath), true);
    }
    
    // Проверяем, есть ли запись для текущего пользователя
    if (!isset($stock[$login])) {
        // Если записи нет, создаем ее
        $randomIndex = getProduct();

        //сутки для истечение индивидуальной акции  $stock[$login] = ['session' => time() + 24 * 60 * 60, 'serviceIndex' => $randomIndex];
        $stock[$login] = ['session' => time() + 24 * 60 * 60, 'serviceIndex' => $randomIndex];
        } else {
            // Если запись уже существует, обновляем время сессии, если прошло 24 часа 
            // И меняем акцию? 
            if ( ($stock[$login]['session']-time())< 0) {
            $stock[$login]['session'] = time() + 24 * 60 * 60;
            $stock[$login]['serviceIndex'] = getProduct();
            }
        }
    file_put_contents($filePath, json_encode($stock));
}

// Функция для сохранения данных пользователя
function saveUser($login, $password, $birthday) {
    $filePath = __DIR__ .'/../includes/db/users.json';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Загружаем существующих пользователей из файла, 
    // если он существует, иначе создаем пустой массив
     
    $users = [];
    if (file_exists($filePath)) {
        $users = json_decode(file_get_contents($filePath), true);
    } 

    // Добавляем нового пользователя в массив
    $users[$login] = ['password' => $hashedPassword, 'birthday' => $birthday];

    // Сохраняем обновленные данные пользователей в файл
    file_put_contents($filePath, json_encode($users));
 }

 function getProduct(){
    $productPath = __DIR__ .'/../includes/db/services.json';

    // выбор акцин товара? отдельная функция?
    $services = json_decode(file_get_contents($productPath), true);

    // Выбираем рандомный товар для акции
    //return $services[rand(0, count($services) - 1)];
    return ['product' => $services[rand(0, count($services) - 1)], 'discount' => rand(1, 10)];
 }
