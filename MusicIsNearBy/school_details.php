<?php
// school_details.php

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

require 'db_connect.php';
require_once 'mapsingeschool.php';

// Проверка наличия параметра запроса
if (isset($_GET['school_name'])) {
    $school_name = $_GET['school_name'];

    // Запрос к базе данных для получения данных о школе
    $sql = "SELECT 
    GROUP_CONCAT(DISTINCT InstrumentSort SEPARATOR ', ') AS InstrumentSort_values,
    (
        SELECT GROUP_CONCAT(DISTINCT InstrumentType ORDER BY count_type DESC SEPARATOR ', ')
        FROM (
            SELECT InstrumentType, COUNT(*) AS count_type
            FROM alltables
            WHERE EduOrganization = '$school_name'
            GROUP BY InstrumentType
            ORDER BY count_type DESC
            LIMIT 5
        ) AS subquery
    ) AS Top_5_InstrumentTypes,
    (
        SELECT InstrumentState
        FROM (
            SELECT InstrumentState, COUNT(*) AS count_state
            FROM alltables
            WHERE EduOrganization = '$school_name'
            GROUP BY InstrumentState
            ORDER BY count_state DESC
            LIMIT 1
        ) AS subquery
    ) AS Most_frequent_InstrumentState,
    IF(MAX(InstrumentMonthRentCosts IS NOT NULL) > 0, 'есть', 'нет') AS have_rent
FROM alltables
WHERE EduOrganization = '$school_name';";

    $sql2 = "SELECT 
COALESCE(InstrumentType, '-') AS InstrumentType, 
COALESCE(InstrumentModel, '-') AS InstrumentModel, 
COALESCE(InstrumentState, '-') AS InstrumentState, 
COALESCE(InstrumentManufacturer, '-') AS InstrumentManufacturer, 
COALESCE(InstrumentManufacturingDate, '-') AS InstrumentManufacturingDate, 
COALESCE(InstrumentRepairDone, '-') AS InstrumentRepairDone, 
COALESCE(InstrumentMonthRentCosts, '-') AS InstrumentMonthRentCosts
FROM alltables
WHERE EduOrganization = '$school_name'
ORDER BY RAND()
LIMIT 5;";

    $result = executeQuery($conn, $sql);

    $result2 = executeQuery($conn, $sql2);

    if ($result->num_rows > 0) {
        // Получение данных
        $school_data = $result->fetch_assoc();
        $instrumentSort = $school_data['InstrumentSort_values'];
        $instrumentType = $school_data['Top_5_InstrumentTypes'];
        $instrumentState = $school_data['Most_frequent_InstrumentState'];
        $instrumentRent = $school_data['have_rent'];
    } else {
        // Если школа не найдена
        echo 'Школа не найдена.';
        exit();
    }

    // Закрытие соединения с базой данных (можете закрыть после получения данных о школе)
    $conn->close();
} else {
    // Если параметр запроса отсутствует
    echo 'Отсутствует параметр запроса.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Музыка рядом - ваш помощник по выбору музыкальной школы</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Yandex Maps API -->
    <script src="https://api-maps.yandex.ru/v3/?apikey=26f1b1fe-241d-42de-8c3a-10083d193e62&lang=ru_RU"
        type="text/javascript"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Header -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-lg-between">
            <h1 class="logo me-auto me-lg-0"><a href="index.html">Музыка рядом<span>.</span></a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto" href="index.html">Главная</a></li>
                </ul>
            </nav>
            <!-- <a href="#about" class="get-started-btn scrollto">Get Started</a> -->
        </div>
    </header>

    <!-- Breadcrumbs -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <?php echo $school_name; ?>
                </h2>
                <ol>
                    <li><a href="schools.php">Назад</a></li>
                    <li>
                        <?php echo $school_name; ?>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <!-- Your portfolio images go here -->
                            <div class="swiper-slide">
                                <?php
                                $image_name = "portfolio" . $school_name . "-1.jpg";
                                ?>
                                <img src="assets/img/portfolio/<?php echo $image_name; ?>" alt="">
                            </div>

                            <div class="swiper-slide">
                                <?php
                                $image_name = "portfolio" . $school_name . "-2.jpg";
                                ?>
                                <img src="assets/img/portfolio/<?php echo $image_name; ?>" alt="">
                            </div>

                            <div class="swiper-slide">
                                <?php
                                $image_name = "portfolio" . $school_name . "-3.jpg";
                                ?>
                                <img src="assets/img/portfolio/<?php echo $image_name; ?>" alt="">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Информация о школе</h3>
                        <ul>
                            <li><strong>Вид музыкального инструмента</strong>:
                                <?php echo $instrumentSort; ?>
                            </li>
                            <li><strong>Тип музыкального инструмента</strong>:
                                <?php echo $instrumentType; ?>
                            </li>
                            <li><strong>Общее состояние инструментов</strong>:
                                <?php echo $instrumentState; ?>
                            </li>
                            <li><strong>Наличие аренды</strong>:
                                <?php echo $instrumentRent; ?>
                            </li>
                        </ul>
                        <div class="center-containerSchool">
                            <a href="school_details_pro.php?school_name=<?php echo $school_name; ?>"
                                class="schoolBtn">Подробнее</a>
                        </div>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h2>Немного об обеспеченности музыкальными инструментами</h2>
                    <div class="table-wrapper">
                        <table>
                            <tr style='text-align: center; padding: 10px;'>
                                <th>Инструмент</th>
                                <th>Модель</th>
                                <th>Состояние</th>
                                <th>Производитель</th>
                                <th>Дата выпуска инструмента</th>
                                <th>Проводившийся ремонт</th>
                                <th>Стоимость аренды в месяц</th>
                            </tr>
                            <?php
                            // Fetch and display all rows
                            while ($school_data2 = $result2->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . ($school_data2['InstrumentType'] ?? '-') . "</td>";
                                echo "<td>" . ($school_data2['InstrumentModel'] ?? '-') . "</td>";
                                echo "<td>" . ($school_data2['InstrumentState'] ?? '-') . "</td>";
                                echo "<td>" . ($school_data2['InstrumentManufacturer'] ?? '-') . "</td>";
                                echo "<td>" . ($school_data2['InstrumentManufacturingDate'] ?? '-') . "</td>";
                                echo "<td>" . ($school_data2['InstrumentRepairDone'] ?? '-') . "</td>";
                                echo "<td>" . ($school_data2['InstrumentMonthRentCosts'] ?? '-') . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            <!-- Добавьте остальные строки таблицы -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Адрес</h2>
                <p>Местоположение школы</p>
            </div>

            <div id="map" class="w-100" style="height: 80vh;"></div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>Музыка рядом<span>.</span></h3>
                            <p>
                                ул. Автозаводская 16 <br>
                                Москва, Россия<br><br>
                                <!-- <strong>Phone:</strong> +1 5589 55488 55<br>
                  <strong>Email:</strong> info@example.com<br> -->
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Полезные ссылки</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.html">Главная</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Все школы</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a
                                    href="https://data.mos.ru/opendata/1037?isDynamic=false">Ссылка на источник
                                    данных</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Наши сервисы</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="mapschools.php">Просмотреть школы на
                                    карте</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="application.php">Заявка на аренду
                                    инструмента</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Подробная информация о
                                    школе</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="searchfilters.php">Поиск с фильтрацией</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="article.php">Статьи о музыкальном
                                    образовании</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>