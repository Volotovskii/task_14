<?php 

require_once './includes/functions.php';

// сколько дней до дня рождения
function getBirthdayInfo($login) {

    // Дата рождения пользователя
    $birthdayDate = getBirthdayDb($login);

    // Получаем текущую дату 
    $currentDate = date('Y-m-d');

    // Преобразуем даты в объекты DateTime
    $birthdayDateTime = new DateTime($birthdayDate);
    $currentDateTime = new DateTime($currentDate);

    // Создаем объект DateTime для следующего дня рождения
    $nextBirthdayDateTime = clone $birthdayDateTime;

    // Находим следующий день рождения
    while ($nextBirthdayDateTime < $currentDateTime) {
        $nextBirthdayDateTime->modify('+1 year');
    }


    // Вычисляем разницу в днях
    $daysLeft = $currentDateTime->diff($nextBirthdayDateTime)->days; // Достаем дни из объекта DateInterval

    // Проверяем, является ли сегодня днем рождения
    $isBirthday = ($currentDate == date('Y-m-d', strtotime($birthdayDate))) ? true : false;

    $birthday = "<strong>До вашего дня рождения осталось:</strong> " . $daysLeft ." дней";
    if($isBirthday){
        $birthday = "<strong>С дём рождения!</strong> Вам доступна скидка 5% на весь ассортимент услуг";
    }

    return ['isBirthday' => $isBirthday, 'daysLeft' => $daysLeft,'birthday' =>$birthday];


}

// Дата рождения 
function getBirthdayDb($login) {

    $users = getUsersList();

    if (existsUser($login)) {
        return $users[$login]['birthday'];
    }
    return false;
}


// вызов под др каждого клиента
function product($login){
    
    $discount = "0"; // скидка всегда (можно убрать 0)

    $birthday = getBirthdayInfo($login);
    if($birthday['isBirthday']){
     $discount = "5";
     return getProductAll($discount);
    }
    
    return getProductAll($discount);
}