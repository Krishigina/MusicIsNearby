<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

# проверка, что ошибки нет
if (!error_get_last()) {

    // Переменные, которые отправляет пользователь
    $schoolName = $_POST['schoolName'];
    $name = $_POST['name'];
    $userEmailmy = $_POST['userEmailmy'];
    $typeInstrument = $_POST['typeInstrument'];
    $model = $_POST['model'];


    // Формирование самого письма
    $title = "Заявка на аренду от $name. Инструмент $typeInstrument ($model)";
    $body = "
    <h1><center>Новая заявка на аренду</center></h1>
    <h3>Контактные данные</h3>
    <b>Имя:</b> $name<br>
    <b>Почта:</b> $userEmailmy<br><br>
    <b>Я хотел бы арендовать Инструмент $typeInstrument ($model) из Школы $schoolName</b><br>
    ";

    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function ($str, $level) {
        $GLOBALS['data']['debug'][] = $str; };

    // Настройки вашей почты
    $mail->Host = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username = 'musicschools@mail.ru'; // Логин на почте
    $mail->Password = 'TiW5fvqG31uFUagRyuwk'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('musicschools@mail.ru', 'Музыка рядом'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('musicschools@mail.ru');  


    // Прикрипление файлов к письму
    if (!empty($file['name'][0])) {
        for ($i = 0; $i < count($file['tmp_name']); $i++) {
            if ($file['error'][$i] === 0)
                $mail->addAttachment($file['tmp_name'][$i], $file['name'][$i]);
        }
    }
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    // Проверяем отправленность сообщения
    if ($mail->send()) {
        $data['result'] = "success";
        $data['info'] = "Сообщение успешно отправлено!";
    } else {
        $data['result'] = "error";
        $data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
        $data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
    }

} else {
    $data['result'] = "error";
    $data['info'] = "В коде присутствует ошибка";
    $data['desc'] = error_get_last();
}

// Отправка результата
header('Content-Type: application/json');
echo json_encode($data);

?>