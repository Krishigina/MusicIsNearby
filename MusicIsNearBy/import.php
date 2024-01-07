<?php
$apiKey = '84620c80-a065-41ee-bee2-09462868e83d';
$baseURL = 'https://apidata.mos.ru/v1/datasets/1037/rows';
$maxLimit = 500; // Максимальное количество записей на каждой странице

$totalData = array(); // Массив для объединенных данных
$skip = 0; // Смещение (начальное значение)

do {
    $url = $baseURL . '?$top=' . $maxLimit . '&$skip=' . $skip . '&api_key=' . $apiKey;
    $response = file_get_contents($url);

    if ($response !== false) {
        $data = json_decode($response, true);

        // Добавление полученных данных в общий массив
        $totalData = array_merge($totalData, $data);

        // Проверка, остались ли еще данные
        if (count($data) < $maxLimit) {
            break; // Прерываем цикл, если достигли последней страницы
        }

        // Увеличиваем смещение для следующей страницы
        $skip += $maxLimit;
    } else {
        echo 'Не удалось получить данные с API.';
        break;
    }
} while (true);

// Вывод общего массива данных
echo '<pre>';
print_r($totalData);
echo '</pre>';

$data = $totalData;

$csvFile = new SplFileObject('output.csv', 'w');

// Записываем заголовки столбцов
$headers = array_keys($data[0]['Cells']);
$csvFile->fputcsv($headers);

foreach ($data as $item) {
    $csvFile->fputcsv($item['Cells']);
}

$csvFile = null;

// НУЖНО СДЕЛАТЬ АВТОМАТИЧЕСКОЕ ОБНОВЛЕНИЕ ДАННЫХ (ЗАПРОСАМИ) В БД