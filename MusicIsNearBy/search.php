<?php
// Подключение к базе данных с использованием вашего класса
require 'db_connect.php';

if(!$conn){
    die("Ошибка подключения к базе данных: " . $connect->getConnectionError());
}

if(isset($_POST["query"])){
    $output = '';
    $query = "SELECT DISTINCT EduOrganization FROM output WHERE EduOrganization LIKE '%".$_POST["query"]."%'";
    
    $result = $conn->query($query);
    $output = '<ul class="list-unstyled">';
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $output .= '<li>'.$row["EduOrganization"].'</li>';
        }
    }else{
        $output .= '<li><br>Школа не найдена</li>';
    }
    
    $output .= '</ul>';
    echo $output;
}

$conn->close();
?>