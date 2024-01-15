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

if (isset($_GET['query']) && isset($_GET['school_name'])) {
    $query = $_GET['query'];
    $school_name = $_GET['school_name'];

    $sql = "SELECT DISTINCT InstrumentType
        FROM alltables 
        WHERE EduOrganization = '$school_name' 
        AND InstrumentType LIKE '%$query%' 
        AND InstrumentMonthRentCosts IS NOT NULL";
    $result = executeQuery($conn, $sql);

    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['InstrumentType']}</li>";
    }
    echo "</ul>";
}

$conn->close();
?>