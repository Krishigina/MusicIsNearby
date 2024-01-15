<?php
require 'db_connect.php';
function executeQuery($conn, $sql)
{
    $result = $conn->query($sql);

    if (!$result) {
        // Обработка ошибки, например, вывод сообщения и логирование
        echo "Ошибка выполнения запроса: " . $conn->error;
        // exit(); // Убрал exit после вывода ошибки
    }

    return $result;
}

if (isset($_GET['query']) && isset($_GET['school_name']) && isset($_GET['type'])) {
    $query = $_GET['query'];
    $school_name = $_GET['school_name'];
    $type = $_GET['type'];

    $sql = "SELECT DISTINCT CONCAT(InstrumentModel, ' - ', InstrumentMonthRentCosts, '₽') AS InstrumentModel FROM alltables WHERE EduOrganization = '$school_name' AND InstrumentType = '$type' AND InstrumentModel LIKE '%$query%' AND InstrumentModel IS NOT NULL AND InstrumentType IS NOT NULL";
    $result = executeQuery($conn, $sql);

    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['InstrumentModel'])) {
            echo "<li>{$row['InstrumentModel']}</li>";
        }
    }
    echo "</ul>";
}

$conn->close();
?>