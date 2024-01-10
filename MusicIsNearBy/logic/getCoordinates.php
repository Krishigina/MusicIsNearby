<?php
function getDatabaseConnection()
{
    try {
        $dbh = new PDO('mysql:dbname=musicschool;host=localhost', 'root', '');
        return $dbh;
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Ошибка подключения к базе данных: ' . $e->getMessage()]);
        die();
    }
}

function getCoordinatesByOrganization($organization)
{
    $dbh = getDatabaseConnection();
    try {
        $sth = $dbh->prepare("SELECT Latitude, Longitude, EduOrganization FROM alltables WHERE EduOrganization = :organization");
        $sth->execute(['organization' => $organization]);
        $coordinates = $sth->fetch(PDO::FETCH_ASSOC);
        return $coordinates;
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Ошибка запроса к базе данных: ' . $e->getMessage()]);
        die();
    }
}

function getAllSchools()
{
    $dbh = getDatabaseConnection();
    try {
        $sth = $dbh->prepare("SELECT DISTINCT EduOrganization FROM alltables");
        $sth->execute();
        $schools = $sth->fetchAll(PDO::FETCH_COLUMN);
        return $schools;
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Ошибка запроса к базе данных: ' . $e->getMessage()]);
        die();
    }
}

function getSchoolsCoordinates()
{
    $schools = getAllSchools();
    $coordinates = [];
    foreach ($schools as $school) {
        $coordinates[$school] = getCoordinatesByOrganization($school);
    }
    return $coordinates;
}

// Получение координат для конкретной школы
// $organization = 'ГБОУ ВО МГИМ им. А.Г. Шнитке';
// $coordinates = getCoordinatesByOrganization($organization);
// header('Content-Type: application/json');
// echo json_encode($coordinates);

// Получение массива координат всех школ
// $allSchoolsCoordinates = getSchoolsCoordinates();
// header('Content-Type: application/json');
// echo json_encode($allSchoolsCoordinates);
?>
