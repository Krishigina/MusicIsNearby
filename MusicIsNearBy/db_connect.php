<?php
// Настройки подключения к БД
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$database = 'musicschool';

// Создание подключения к БД
$conn = mysqli_connect($db_host, $db_user, $db_password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Выбор базы данных
mysqli_select_db($conn, $database) or die("Cannot select DB");
?>