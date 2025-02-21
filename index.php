<?php 
// require_once './authentication/login.php';

 session_start();
 require_once './includes/functions.php';
 require_once './stock/birthday_stock.php';
 require_once './stock/hour_stock.php';


if (isset($_SESSION['user'])) {

  // Время до конца суточной акции
  $hoursLeft = getDayInfo($_SESSION['user']);

  // Дни до День Рождения
  $daysLeft = getBirthdayInfo($_SESSION['user']);

echo "<p>  Это контент для зарегистрированных пользователей.</p>";
echo "<heade>
        <div class='links'>
          <a href='./logout.php'>Выйти </a>
          <p>Привет,{$_SESSION['user']}! </p>
          <p> {$daysLeft['birthday']} </p>
          <p><strong>Индивидуальная акция:</strong> осталось времени: {$hoursLeft['hours']} ч {$hoursLeft['minutes']} мин {$hoursLeft['seconds']} сек.</p>
        </div>
    </heade>";
 
    echo " <div class='stock'> 
        <p><strong>Сегодня вам доступны акции: </strong></p>";

  echo "
        <div class='hour bl'>
        <p>Акция, действующая 24 часа:</p>
            <div class='container'>
              <div class='product-container1'>
                <div class='product'>
                <div class='image'>
                  <img src='{$hoursLeft['product']['product']['image']}' alt='{$hoursLeft['product']['product']['name']}'>
                  <p>" . ($hoursLeft['product']['product']['name']) . "</p>";
  if (!empty($hoursLeft['discount'][1])) {
    echo "
                    <p class='old'> Цена: " . ($hoursLeft['product']['product']['price']) . "</p>
                    <p> Цена по акции: " . ($hoursLeft['discount'][0]) . "</p>
                    ";
                    
  } else {
    echo "<p> Цена: " . ($hoursLeft['product']['product']['price']) . "</p>";
  }
  echo "        
      </div>
                </div>
              </div>
            </div>
          </div>";

    echo "<hr /><p><strong>Услуги</strong></p>";
        echo product($_SESSION['user']);
        echo "<hr />";
    include 'user.html';
    echo "</div>";
    echo "<p>  Это контент для зарегистрированных пользователей.</p>";
            } else {
              echo "<heade><div class='links'> <a href='./authentication/login.php'>Войти</a></div></heade>";
              echo "<p>Чтобы воспользоваться всеми преимуществами сайта, <a href='./authentication/login.php''>войдите на сайт</a> или <a href='./authentication/registration.php'>зарегистрируйтесь</a>.</p>";  
            }