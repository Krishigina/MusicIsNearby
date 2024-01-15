<?php
// live_search.php
// Подключение к базе данных
include 'db_connect.php';

// Получение данных из GET-запроса
$typeOptions = isset($_GET['type_options']) ? $_GET['type_options'] : array();
$modelOptions = isset($_GET['model_options']) ? $_GET['model_options'] : array();
$countryOptions = isset($_GET['country_options']) ? $_GET['country_options'] : array();

// Используйте фильтры только если они указаны
$typeFilter = $typeOptions ? " AND InstrumentType IN ('" . implode("','", $typeOptions) . "')" : "";

// SQL-запрос с учетом фильтров
// Запрос на выборку уникальных значений EduOrganization
$uniqueOrganizationsQuery = "SELECT DISTINCT EduOrganization FROM alltables WHERE 1=1$typeFilter";
$uniqueOrganizationsResult = mysqli_query($conn, $uniqueOrganizationsQuery);

// Обработка результатов запроса на выборку уникальных значений
while ($uniqueOrganizationRow = mysqli_fetch_assoc($uniqueOrganizationsResult)) {
    $eduOrganization = $uniqueOrganizationRow['EduOrganization'];

    // Запрос на выборку информации о школе
    $schoolInfoQuery = "SELECT EduOrganization, InstrumentType, InstrumentState, InstrumentCountryOfOrigin FROM alltables WHERE EduOrganization = '$eduOrganization'$typeFilter";
    $schoolInfoResult = mysqli_query($conn, $schoolInfoQuery);

    // Обработка результатов запроса на выборку информации о школе
    echo '<a href="school_details.php?school_name=' . urlencode($eduOrganization) . '">';
    echo '<div class="school-card" style="background-color: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ddd; border-radius: 6px; cursor: pointer; transition: background-color 0.3s, color 0.3s;">';
    echo '<h2 style="font-size: 16px;">' . $eduOrganization . '</h2>';
    echo '</div>';
    echo '</a>';

    // Освобождение результата запроса на выборку информации о школе
    mysqli_free_result($schoolInfoResult);
}

// Освобождение результата запроса на выборку уникальных значений
mysqli_free_result($uniqueOrganizationsResult);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>
