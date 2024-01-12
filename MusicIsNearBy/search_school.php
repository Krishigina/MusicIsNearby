<?php 
// search_school.php

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

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    $sql = "SELECT DISTINCT EduOrganization FROM alltables WHERE EduOrganization LIKE '%$query%'";
    $result = executeQuery($conn, $sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['EduOrganization'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Нет результатов.";
    }
}
$conn->close();
?>
