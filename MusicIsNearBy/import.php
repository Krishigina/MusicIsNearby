<?php
require_once('db_connect.php'); // Подключение файла db_connect.php

$apiKey = '84620c80-a065-41ee-bee2-09462868e83d';
$baseURL = 'https://apidata.mos.ru/v1/datasets/1037/rows';
$maxLimit = 500; // Максимальное количество записей на каждой странице
$updateInterval = 120; // Интервал обновления данных в секундах (в данном случае 1 час)

// Установка максимального времени выполнения скрипта в 0 (без ограничения)
ini_set('max_execution_time', 0);

function fetchDataFromAPI($skip, $limit, $apiKey, $baseURL) {
    $params = [
        '$top' => $limit,
        '$skip' => $skip,
        'api_key' => $apiKey
    ];
    $url = $baseURL . '?' . http_build_query($params);
    $response = file_get_contents($url);

    if ($response !== false) {
        $data = json_decode($response, true);
        return $data;
    } else {
        echo 'Не удалось получить данные с API.';
        return false;
    }
}

function updateDatabase($conn, $data)
{
    // Очистка таблицы перед обновлением, если необходимо
    mysqli_query($conn, "TRUNCATE TABLE output");

    // Загрузка данных в базу данных MySQL
    $stmt = mysqli_prepare($conn, "INSERT INTO output (EduOrganization, InstrumentSort, InstrumentType, InstrumentModel, InstrumentState, InstrumentCountryOfOrigin, InstrumentManufacturer, InstrumentManufacturingDate, InstrumentMonthRentCosts, InstrumentRepairDone, global_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($data as $item) {
        $rowData = array_values($item['Cells']);
        mysqli_stmt_bind_param($stmt, str_repeat('s', count($rowData)), ...$rowData);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
}

function exportToCSV($data, $filename) {
    $csvFile = new SplFileObject($filename, 'w');

    // Записываем заголовки столбцов
    $headers = array_keys($data[0]['Cells']);
    $csvFile->fputcsv($headers);

    foreach ($data as $item) {
        $csvFile->fputcsv($item['Cells']);
    }

    $csvFile = null;
}

$conn = mysqli_connect($db_host, $db_user, $db_password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$totalData = array(); // Массив для объединенных данных
$skip = 0; // Смещение (начальное значение)

do {
    $data = fetchDataFromAPI($skip, $maxLimit, $apiKey, $baseURL);

    if ($data !== false) {
        // Добавление полученных данных в общий массив
        $totalData = array_merge($totalData, $data);

        // Проверка, остались ли еще данные
        if (count($data) < $maxLimit) {
            break; // Прерываем цикл, если достигли последней страницы
        }

        // Увеличиваем смещение для следующей страницы
        $skip += $maxLimit;
    } else {
        break;
    }
} while (true);

// Обработка ошибок и предотвращение вывода данных перед установкой заголовка
ob_start();

// Вывод общего массива данных
echo '<pre>';
print_r($totalData);
echo '</pre>';

// Вставка данных в базу данных
updateDatabase($conn, $totalData);

// Экспорт данных в CSV
exportToCSV($totalData, 'output.csv');

ob_end_clean(); // Очищаем буфер вывода

mysqli_close($conn);

// Ожидание перед следующим обновлением данных
sleep($updateInterval);

// Перенаправление на самого себя для автоматического обновления
header("Location: {$_SERVER['PHP_SELF']}");
exit();
?>