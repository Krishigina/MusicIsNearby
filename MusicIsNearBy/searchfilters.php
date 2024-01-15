<?php
// Подключение к базе данных
include 'db_connect.php';

// SQL-запрос для получения уникальных значений из столбца
$sql = "SELECT DISTINCT name FROM instrumentType";
$result = mysqli_query($conn, $sql);

// Массив для хранения уникальных значений
$instrumentTypes = array();

// Заполнение массива уникальными значениями из базы данных
while ($row = mysqli_fetch_assoc($result)) {
    $instrumentTypes[] = $row['name'];
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>


<!-- searchfilters.php -->
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

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/img/music-svgrepo-com.svg" rel="icon">
</head>

<body>

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

    <main id="main"><br><br><br><br>

        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="portfolio-info">
                    <h3>Найти школу</h3>
                    <form id="data-selection-form">
                        <!-- <div class="form-group">
                            <label for="field1">Тип инструмента:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="typeOption1" name="type_options[]"
                                    value="Аккордеон">
                                <label class="form-check-label" for="option1">Аккордеон</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="typeOption2" name="type_options[]"
                                    value="Бас-гитара">
                                <label class="form-check-label" for="option2">Бас-гитара</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="typeOption3" name="type_options[]"
                                    value="Пианино">
                                <label class="form-check-label" for="option3">Пианино</label>
                            </div>
                        </div> -->
                        <div class="accordion" id="instrumentAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="typeHeading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#typeCollapse" aria-expanded="true"
                                        aria-controls="typeCollapse">
                                        Выбор типа инструмента
                                    </button>
                                </h2>
                                <div id="typeCollapse" class="accordion-collapse collapse show"
                                    aria-labelledby="typeHeading" data-bs-parent="#instrumentAccordion">
                                    <div class="accordion-body">
                                        <div class="form-group">
                                            <label for="field1"></label>
                                            <?php
                                            // Динамическое создание чекбоксов на основе уникальных значений из базы данных
                                            foreach ($instrumentTypes as $type) {
                                                echo '<div class="form-check checkbox-margin">';
                                                echo '<input type="checkbox" class="form-check-input" id="typeOption' . $type . '" name="type_options[]" value="' . $type . '">';
                                                echo '<label class="form-check-label" for="typeOption' . $type . '">' . $type . '</label>';
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion" id="stateAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="stateHeading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#stateCollapse" aria-expanded="true"
                                        aria-controls="stateCollapse">
                                        Выбор состояния
                                    </button>
                                </h2>
                                <div id="stateCollapse" class="accordion-collapse collapse show"
                                    aria-labelledby="stateHeading" data-bs-parent="#stateAccordion">
                                    <div class="accordion-body">
                                        <div class="form-group">
                                            <label for="field2"></label>
                                            <div class="form-check checkbox-margin">
                                                <input type="checkbox" class="form-check-input" id="modelOption1"
                                                    name="model_options[]" value="хорошее">
                                                <label class="form-check-label" for="option1">хорошее</label>
                                            </div>
                                            <div class="form-check checkbox-margin">
                                                <input type="checkbox" class="form-check-input" id="modelOption2"
                                                    name="model_options[]" value="удовлетворительное">
                                                <label class="form-check-label" for="option2">удовлетворительное</label>
                                            </div>
                                            <div class="form-check checkbox-margin">
                                                <input type="checkbox" class="form-check-input" id="modelOption3"
                                                    name="model_options[]" value="неудовлетворительное">
                                                <label class="form-check-label"
                                                    for="option3">неудовлетворительное</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion" id="countryAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="countryHeading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#countryCollapse" aria-expanded="true"
                                        aria-controls="countryCollapse">
                                        Выбор страны производителя
                                    </button>
                                </h2>
                                <div id="countryCollapse" class="accordion-collapse collapse show"
                                    aria-labelledby="countryHeading" data-bs-parent="#countryAccordion">
                                    <div class="accordion-body">
                                        <div class="form-group">
                                            <label for="field3"></label>
                                            <div class="form-check checkbox-margin">
                                                <input type="checkbox" class="form-check-input" id="countryOption1"
                                                    name="country_options[]" value="российское">
                                                <label class="form-check-label" for="countryOption1">российское</label>
                                            </div>
                                            <div class="form-check checkbox-margin">
                                                <input type="checkbox" class="form-check-input" id="countryOption2"
                                                    name="country_options[]" value="зарубежное">
                                                <label class="form-check-label" for="countryOption2">зарубежное</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="container mt-4">
                            <h4>Результаты поиска:</h4>
                            <div id="liveSearchResults"></div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
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
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Полезные ссылки</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.html">Главная</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Все школы</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://data.mos.ru/opendata/1037?isDynamic=false">Ссылка на источник данных</a></li>
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
                            <li><i class="bx bx-chevron-right"></i> <a href="searchfilters.php">Поиск с фильтрацией</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Статьи о музыкальном образовании</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <div id="preloader"></div>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Функция для живого поиска школ
            function liveSearch() {
                let typeOptions = $('input[name="type_options[]"]:checked').map(function () {
                    return this.value;
                }).get();

                let modelOptions = $('input[name="model_options[]"]:checked').map(function () {
                    return this.value;
                }).get();

                let countryOptions = $('input[name="country_options[]"]:checked').map(function () {
                    return this.value;
                }).get();

                // Выполнение Ajax-запроса
                $.ajax({
                    url: 'live_search.php',
                    method: 'GET',
                    data: {
                        type_options: typeOptions,
                        model_options: modelOptions,
                        country_options: countryOptions
                    },
                    success: function (data) {
                        $('#liveSearchResults').html(data);
                    }
                });
            }
            // Обработка изменений в форме для живого поиска
            $('#data-selection-form input[type="checkbox"]').on('change', function () {
                liveSearch();
            });
        });
    </script>
</body>

</html>