<?php
require 'db_connect.php'; // Подключение к базе данных

if (!$conn) {
  die("Ошибка подключения к базе данных: " . $db->getConnectionError());
}

$output = '';
$query = $_POST['query'];

if ($query != '') {
  $sql = "SELECT DISTINCT EduOrganization FROM output WHERE EduOrganization LIKE '%$query%'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $school_name = $row['EduOrganization'];
      $output .= "<div class='school-card'>$school_name</div>";
    }
  } else {
    $output = 'Школы не найдены';
  }
} else {
  // Если ничего не введено, выводим все школы
  $sql = "SELECT DISTINCT EduOrganization FROM output";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $school_name = $row['EduOrganization'];
      $output .= "<div class='school-card'>$school_name</div>";
    }
  } else {
    $output = 'Нет доступных школ';
  }
}

$conn->close();
echo $output;
?>
