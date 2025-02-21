<?php 

require_once './includes/functions.php';
require_once './authentication/fun.php';

function getDayInfo($login) {

    // TODO Вывод только для определелённого логина? 
    $stock = json_decode(file_get_contents('./includes/db/session.json'), true);
    // Получаем текущее время
    $currentTime = time();

    // Если при обновлении сутки прошли обнов. всё
    // Если хочу обновить данные без перезакгрузки страницы добавить AJAX
    if($stock[$login]['session']-time()< 0){
        usersStock($login);  
    }

    $timeLeft =  $stock[$login]['session']-$currentTime;

    $hours = floor($timeLeft / (60 * 60));
    $minutes = floor(($timeLeft % (60 * 60)) / 60);
    $seconds = $timeLeft % 60;

    //$discount = rand(1, 10);
    $discountedPrice = $stock[$login]['serviceIndex']['product']['price'] - ($stock[$login]['serviceIndex']['product']['price'] * $stock[$login]['serviceIndex']['discount'] / 100);

    return ['hours' => $hours, 'minutes' => $minutes,'seconds' => $seconds,'product'=>$stock[$login]['serviceIndex'],'discount'=>[$discountedPrice,$stock[$login]['serviceIndex']['discount']]];
}