<?php
require_once 'logic/getCoordinates.php';
if (isset($_GET['school_name'])) {
    $school_name = $_GET['school_name'];
}
$organization = $school_name;
$coordinates = getCoordinatesByOrganization($organization);
?>

<!DOCTYPE html> 
<html>

<head>
    <title>Музыка рядом - ваш помощник по выбору музыкальной школы</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/v3/?apikey=26f1b1fe-241d-42de-8c3a-10083d193e62&lang=ru_RU"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/img/music-svgrepo-com.svg" rel="icon">
    
    <script>
        main();
        async function main() {

            const longitude = '<?php echo $coordinates["Longitude"]; ?>';
            const latitude = '<?php echo $coordinates["Latitude"]; ?>';
            const organizationName = '<?php echo $coordinates["EduOrganization"]; ?>';
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
            const CENTER_COORDINATES = [longitude, latitude];
            // координаты метки на карте
            const MARKER_COORDINATES = [longitude, latitude];

            // Объект с параметрами центра и зумом карты
            const LOCATION = { center: CENTER_COORDINATES, zoom: 17 };

            // Создание объекта карты
            map = new YMap(document.getElementById('map'), { location: LOCATION });

            // Добавление слоев на карту
            map.addChild(scheme = new YMapDefaultSchemeLayer());
            map.addChild(new YMapDefaultFeaturesLayer());

            // Добавление элементов управления на карту
            map.addChild(new YMapControls({ position: 'right' })
                .addChild(new YMapZoomControl({}))
            );
            map.addChild(new YMapControls({ position: 'top right' })
                .addChild(new YMapGeolocationControl({}))
            );

            // Создание маркера
            const el = document.createElement('img');
            el.className = 'my-marker';
            el.src = 'assets/img/markerschool.svg';
            el.title = organizationName;
            // При клике на маркер меняем центр карты на LOCATION с заданным duration
            el.onclick = () => map.update({ location: { ...LOCATION, duration: 400 } });

            // Создание заголовка маркера
            const markerTitle = document.createElement('div');
            markerTitle.className = 'marker-title marker-title-inner';
            markerTitle.innerHTML = organizationName;

            // Контейнер для элементов маркера
            const imgContainer = document.createElement('div');
            imgContainer.appendChild(el);
            imgContainer.appendChild(markerTitle);

            // Добавление центра карты
            map.addChild(new YMapMarker({ coordinates: CENTER_COORDINATES }));

            // Добавление маркера на карту
            map.addChild(new YMapMarker({ coordinates: MARKER_COORDINATES }, imgContainer));
        }
    </script>
</head>

<body>
    
    <!-- <div id="map" style="width: 800px; height: 600px"></div> -->

</body>

</html>
