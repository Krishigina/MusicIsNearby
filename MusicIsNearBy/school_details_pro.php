<?php
// school_details_pro.php

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

// Проверка наличия параметра запроса
if (isset($_GET['school_name'])) {
    $school_name = $_GET['school_name'];

    // Пагинация
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $perPage = 25; // Установите количество строк на странице по своему усмотрению
    $start = ($page - 1) * $perPage;

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
    LIMIT $start, $perPage;";

    $result2 = executeQuery($conn, $sql2);

    // Подсчет общего количества строк
    $totalRowsSql = "SELECT COUNT(*) FROM alltables WHERE EduOrganization = '$school_name'";
    $totalRowsResult = executeQuery($conn, $totalRowsSql);
    $totalRows = $totalRowsResult->fetch_row()[0];

    // Вычисление общего количества страниц
    $totalPages = ceil($totalRows / $perPage);

    // Закрытие соединения с базой данных (можете закрыть после получения данных о школе)
    $conn->close();
} else {
    // Если параметр запроса отсутствует
    echo 'Отсутствует параметр запроса.';
    exit();
}
?>


<style>
    /* Добавленные стили для отступов и выравнивания */
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        padding: 5px 10px;
        margin: 0 5px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
    }

    .pagination a:hover {
        background-color: #ddd;
        color: #fff;
    }

    .pagination .next-page {
        margin-left: 5px;
    }
</style>

<!DOCTYPE html>
<html lang="ru">

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

    <style>
        #searchResults {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 0px;
        }

        #searchResults ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #searchResults li {
            cursor: pointer;
            padding: 5px;
            margin-left: 10px;
        }

        #searchResults li:hover {
            background-color: #eee;
        }

        #searchInstrumentResults {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 0px;
        }

        #searchInstrumentResults ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #searchInstrumentResults li {
            cursor: pointer;
            padding: 5px;
            margin-left: 10px;
        }

        #searchInstrumentResults li:hover {
            background-color: #eee;
        }

        #searchModelResults {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 0px;
        }

        #searchModelResults ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #searchModelResults li {
            cursor: pointer;
            padding: 5px;
            margin-left: 10px;
        }

        #searchModelResults li:hover {
            background-color: #eee;
        }
    </style>

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

    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <?php echo $school_name; ?>
                </h2>
                <ol>
                    <li><a href="school_details.php?school_name=<?php echo $school_name; ?>">Назад</a></li>
                    <li>
                        <?php echo $school_name; ?>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="col-lg-18">
                <div class="portfolio-info">
                    <h3>Обеспеченность музыкальными инструментами</h3>
                    <ul>
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
                                // Извлечение и отображение всех строк
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
                            </table>
                        </div>
                    </ul>
                </div>
            </div>

            <!-- Добавленная секция пагинации -->
            <div class="container mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        if ($page > 1) {
                            echo "<li class='page-item'><a class='page-link' href='school_details_pro.php?school_name=$school_name&page=" . ($page - 1) . "'>Предыдущая</a></li>";
                        }

                        echo "<li class='page-item disabled'>";
                        echo "<span class='page-link'>Текущая страница: ";
                        echo "<input type='number' class='page-input' value='$page' min='1' max='$totalPages' oninput='handlePageInput(event)'>";
                        echo " из $totalPages</span>";
                        echo "</li>";

                        if ($page < $totalPages) {
                            echo "<li class='page-item next-page'><a class='page-link' href='school_details_pro.php?school_name=$school_name&page=" . ($page + 1) . "'>Следующая</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <br><br><br>
            <div class="portfolio-info">
                <h3>Оформить заявку на аренду</h3>
                <section id="contact" class="contact" style="padding: 30px;">
                    <div class="container" data-aos="fade-up">
                        <div class="row mt-0">
                            <div class="col-lg-12 mt-0 mt-lg-0">
                                <form action="logic/send.php" method="post" role="form" class="php-email-form" id="form"
                                    onsubmit="submitForm(event)" action="send.php">


                                    <div class="form-group mt-3"><label for="searchSchool"></label>
                                        <input type="text" id="searchSchool" class="form-control" name="schoolName"
                                            placeholder="Введите название школы" value="<?php echo $school_name; ?>">
                                        <div id="searchResults"></div>
                                    </div>
                                    <br><br>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Имя" required>
                                        </div>
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <input type="email" class="form-control" name="userEmailmy" id="userEmailmy"
                                                placeholder="Почта" required>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="typeInstrument"
                                            id="typeInstrument" placeholder="Выберите тип инструмента" required>
                                    </div> -->
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="typeInstrument"
                                            id="typeInstrument" placeholder="Выберите тип инструмента" required>
                                        <div id="searchInstrumentResults"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="model" id="model"
                                            placeholder="Выберите модель инструмента" required>
                                        <div id="searchModelResults"></div>
                                    </div>
                                    <div class="my-3">
                                        <div class="loading">В процессе</div>
                                        <!-- <div class="error-message"> Ваша заявка была отправлена. Благодарим!</div> -->
                                        <div class="alert alert-success d-none">Ваша заявка была отправлена.
                                            Благодарим!</div>
                                        <div class="alert alert-danger d-none">Ваша заявка не была отправлена. Так
                                            как возникла ошибка!</div>
                                        <div class="text-center"><button type="submit" name="submit">Отправить</button>
                                        </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </section>

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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script src="assets/js/main.js"></script>

    <script>
        document.querySelector('.pagination .disabled').addEventListener('mouseover', function () {
            this.classList.remove('disabled');
        });

        document.querySelector('.pagination .disabled').addEventListener('mouseout', function () {
            this.classList.add('disabled');
        });

        document.querySelector('.page-input').addEventListener('input', function (event) {
            const pageNumber = parseInt(event.target.value);
            if (!isNaN(pageNumber) && pageNumber >= 1 && pageNumber <= <?php echo $totalPages; ?>) {
                document.querySelector('.pagination .disabled .page-link').textContent = 'Текущая страница: ' + pageNumber + ' из <?php echo $totalPages; ?>';
            } else {
                document.querySelector('.pagination .disabled .page-link').textContent = 'Текущая страница: <?php echo $page; ?> из <?php echo $totalPages; ?>';
            }
        });

        document.querySelector('.page-input').addEventListener('change', function (event) {
            const pageNumber = parseInt(event.target.value);
            if (!isNaN(pageNumber) && pageNumber >= 1 && pageNumber <= <?php echo $totalPages; ?>) {
                window.location.href = 'school_details_pro.php?school_name=<?php echo $school_name; ?>&page=' + pageNumber;
            } else {
                alert('Введенная страница недопустима. Пожалуйста, введите корректное значение.');
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Обработка заявки(живой поиск и тд) -->
    <script src="assets/js/application.js"></script>
</body>

</html>