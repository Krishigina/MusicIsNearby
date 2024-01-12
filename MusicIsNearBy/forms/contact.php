<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/src/Exception.php';
require 'src/src/PHPMailer.php';
require 'stc/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $mail = new PHPMailer(true);

    try {
        // Конфигурация для отправки почты через SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.yandex.ru'; // Замените на адрес SMTP-сервера вашего хостинг-провайдера
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shishiginachristine@yandex.ru'; // Замените на ваш электронный адрес
        $mail->Password   = 'zcbm.150+A'; // Замените на пароль от вашего электронного адреса
        $mail->SMTPSecure = 'tls'; // Используйте "tls" или "ssl" в зависимости от требований вашего хостинг-провайдера
        $mail->Port       = 587; // Установите правильный порт SMTP-сервера, если требуется

        // Отправка письма
        $mail->setFrom($email);
        $mail->addAddress('shishiginachristine@yandex.ru'); // Замените на ваш электронный адрес
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\n\nEmail: $email";

        $mail->send();
        echo 'Ваша заявка была отправлена. Благодарим!';
    } catch (Exception $e) {
        echo 'Ваша заявка не удалась. Пожалуйста, попробуйте еще раз позже. Ошибка: ' . $mail->ErrorInfo;
    }
}
?>
