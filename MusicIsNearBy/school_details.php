<?php
// school_details.php

require 'db_connect.php';

// Проверка наличия параметра запроса
if (isset($_GET['school_name'])) {
    $school_name = $_GET['school_name'];

    // Запрос к базе данных для получения подробной информации о школе
    $sql = "SELECT * FROM output WHERE EduOrganization = '$school_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Получение данных о школе
        $school_data = $result->fetch_assoc();

        // Здесь вы можете использовать переменные $school_data['column_name'] для вывода информации на страницу
        $school_name = $school_data['EduOrganization'];

        // Изменения в переменных для полей InstrumentSort и InstrumentType
        $instrumentSort = implode(', ', array_map('trim', explode(',', $school_data['InstrumentSort'])));
        $instrumentType = implode(', ', array_map('trim', explode(',', $school_data['InstrumentType'])));
        // Добавьте другие поля, которые вам нужны

        // Закрытие соединения с базой данных
        $conn->close();
    } else {
        // Если школа не найдена
        echo 'Школа не найдена.';
        exit();
    }
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
    <script src="https://api-maps.yandex.ru/2.1/?apikey=26f1b1fe-241d-42de-8c3a-10083d193e62&lang=ru_RU"
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
            <a href="#about" class="get-started-btn scrollto">Get Started</a>
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
                                <img src="assets/img/portfolio/portfolio-1.jpg" alt="">
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
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <h2>This is an example of portfolio detail</h2>
                        <p>
                            Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore
                            quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim.
                            Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi
                            nulla at esse enim cum deserunt eius.
                        </p>
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
            <div id="map" style="width: 100%; height:500px"></div>
            <script type="text/javascript">
                ymaps.ready(init);
                function init() {
                    var point = [<?php echo $object['point']; ?>];
                    var myMap = new ymaps.Map("map", {
                        center: point,
                        zoom: 16
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                    var myPlacemark = new ymaps.Placemark(point, {
                        balloonContent: '<?php echo $object['name']; ?>'
                    }, {
                        preset: 'islands#icon',
                        iconColor: '#ff0000'
                    });

                    myMap.geoObjects.add(myPlacemark);
                }
            </script>
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-5 mt-lg-0">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                    required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </div>
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
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Полезные ссылки</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.html">Главная</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Все школы</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Наши сервисы</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Просмотреть школы на карте</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Сравнить школы</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Заявка на аренду инструмента</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Подробная информация о
                                    школе</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Поиск с фильтрацией</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Статьи о музыкальном образовании</a>
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