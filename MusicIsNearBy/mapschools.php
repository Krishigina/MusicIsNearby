<?php
require_once 'logic/getCoordinates.php';
// $organization = 'ГБПОУ г. Москвы «МГКМИ им. Ф.Шопена»';
$organizations = getSchoolsCoordinates();
?>

<!DOCTYPE html>
<html>

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
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

<script>
    main();
    async function main() {


        // ожидание загрузки модулей
        await ymaps3.ready;
        const {
            YMap,
            YMapDefaultSchemeLayer,
            YMapControls,
            YMapDefaultFeaturesLayer,
            YMapMarker
        } = ymaps3;

        // Импорт модулей для элементов управления на карте
        const {
            YMapZoomControl,
            YMapGeolocationControl
        } = await ymaps3.import('@yandex/ymaps3-controls@0.0.1');

        // Координаты центра карты
        const CENTER_COORDINATES = [37.6176, 55.7558]; // Default center coordinates
        // Объект с параметрами центра и зумом карты
        const LOCATION = { center: CENTER_COORDINATES, zoom: 13 };

        // Создание объекта карты
        // Получение массива координат школ из PHP


        // Создание объекта карты
        map = new YMap(document.getElementById('map'), { location: LOCATION });

        // Добавление слоев на карту
        map.addChild(scheme = new YMapDefaultSchemeLayer());
        map.addChild(new YMapDefaultFeaturesLayer());

        // Добавление элементов управления на карту
        map.addChild(new YMapControls({ position: 'right' })
            .addChild(new YMapZoomControl({}))
        );
        map.addChild(new YMapControls({ position: 'bottom right' })
            .addChild(new YMapGeolocationControl({}))
        );


        const schoolsCoordinates = <?php echo json_encode($organizations); ?>;


        // Создание маркеров для каждой школы
        Object.keys(schoolsCoordinates).forEach(school => {
            const { Latitude, Longitude, EduOrganization } = schoolsCoordinates[school];



            const CENTER_COORDINATES = [Longitude, Latitude];


            // Создание маркера
            const el = document.createElement('img');
            el.className = 'my-marker';
            el.src = 'assets/img/markerschool.svg';
            el.title = EduOrganization;

            // При клике на маркер меняем центр карты на координаты школы с заданным duration
            el.onclick = () => map.update({ location: { center: [parseFloat(Longitude), parseFloat(Latitude)], zoom: 10, duration: 400 } });

            // Создание заголовка маркера
            const markerTitle = document.createElement('div');
            markerTitle.className = 'marker-title marker-title-inner';
            markerTitle.innerHTML = EduOrganization;

            // Контейнер для элементов маркера
            const imgContainer = document.createElement('div');
            imgContainer.appendChild(el);
            imgContainer.appendChild(markerTitle);


            // Добавление маркера на карту
            map.addChild(new YMapMarker({ coordinates: [parseFloat(Longitude), parseFloat(Latitude)] }, imgContainer));

        });

    }
</script>

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
            <form class="d-flex">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" placeholder="Название школы" style="font-family: Poppins" aria-label="Search" />
                </div>

            </form>
            <a href="#about" class="get-started-btn scrollto">Get Started</a>
        </div>
    </header>
    <div class="container-fluid">
        <div id="map" class="w-100" style="height: 100vh;"></div>
    </div>

</body>

</html>