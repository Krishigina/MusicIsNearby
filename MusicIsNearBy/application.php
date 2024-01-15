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

    <main id="main"><br><br><br><br>

        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="portfolio-info">
                    <h3>Оформить заявку на аренду</h3>
                    <section id="contact" class="contact" style="padding: 30px;">
                        <div class="container" data-aos="fade-up">
                            <div class="row mt-0">
                                <div class="col-lg-12 mt-0 mt-lg-0">

                                    <form action="logic/send.php" method="post" role="form" class="php-email-form"
                                        id="form" onsubmit="submitForm(event)" action="send.php">


                                        <div class="form-group mt-3"><label for="searchSchool"></label>
                                            <input type="text" id="searchSchool" class="form-control" name="schoolName"
                                                placeholder="Введите название школы">
                                            <div id="searchResults"></div>
                                        </div>
                                        <br><br>

                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Имя" required>
                                            </div>
                                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                                <input type="email" class="form-control" name="userEmailmy"
                                                    id="userEmailmy" placeholder="Почта" required>
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
                                            <div class="text-center"><button type="submit"
                                                    name="submit">Отправить</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
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
                            <li><i class="bx bx-chevron-right"></i> <a href="https://data.mos.ru/opendata/1037?isDynamic=false">Ссылка на источник данных</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Наши сервисы</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="mapschools.php">Просмотреть школы на
                                    карте</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Сравнить школы</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="application.php">Заявка на аренду
                                    инструмента</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Подробная информация о
                                    школе</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="searchfilters.php">Поиск с фильтрацией</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="article.php">Статьи о музыкальном образовании</a>
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
            searchSchool(); // Функция для обработки поиска
        });

        // Обрабатываем поиск при фокусе на поле ввода
        $('#searchSchool').on('focus', function () {
            searchSchool(); // Функция для обработки поиска
        });

        // Функция для обработки поиска
        function searchSchool() {
            let query = $('#searchSchool').val();

            // Выполнение Ajax-запроса
            $.ajax({
                url: 'search_school.php', // Создайте отдельный файл для обработки поиска
                method: 'GET',
                data: { query: query, school_name: query }, // Используйте значение из поля ввода в качестве school_name
                succss: function (data) {
                    $('#searchResults').html(data);
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchSchool");
            const searchResults = document.getElementById("searchResults");
            const searchInstrumentInput = document.getElementById("typeInstrument");
            const searchInstrumentResults = document.getElementById("searchInstrumentResults");
            const searchModelInput = document.getElementById("model");
            const searchModelResults = document.getElementById("searchModelResults");

            function fillField(input, results, value) {
                input.value = value;
                results.innerHTML = "";
            }

            function clearInstrumentAndModelFields() {
                searchInstrumentInput.value = "";
                searchModelInput.value = "";
                searchInstrumentResults.innerHTML = "";
                searchModelResults.innerHTML = "";
            }

            function handleResults(results, callback) {
                results.addEventListener("click", function (e) {
                    if (e.target.tagName === "LI") {
                        callback(e.target.textContent);
                    }
                });

            }



            handleResults(searchResults, function (value) {
                fillField(searchInput, searchResults, value);
                clearInstrumentAndModelFields();
            });

            function updateResults(input, results, url) {
                const query = input.value;

                // Отправить запрос на сервер для получения подсказок
                // (вы можете использовать AJAX или другие методы для этого)

                // В данном примере, давайте сделаем простой запрос с использованием fetch
                fetch(url + `?query=${query}&school_name=${searchInput.value}&type=${searchInstrumentInput.value}`)
                    .then(response => response.text())
                    .then(data => {
                        results.innerHTML = data;
                    })
                    .catch(error => {
                        console.error("Ошибка при выполнении запроса:", error);
                    });
            }

            function handleInput(input, results, url) {
                function updateResultsDebounced() {
                    updateResults(input, results, url);
                }

                input.addEventListener("focus", updateResultsDebounced);
                input.addEventListener("input", updateResultsDebounced);
                input.addEventListener("change", updateResultsDebounced);
                input.addEventListener("click", updateResultsDebounced);
            }


            handleResults(searchResults, function (value) {
                fillField(searchInput, searchResults, value);
            });

            handleResults(searchInstrumentResults, function (value) {
                fillField(searchInstrumentInput, searchInstrumentResults, value);
            });

            handleResults(searchModelResults, function (value) {
                fillField(searchModelInput, searchModelResults, value);
            });

            handleInput(searchInput, searchResults, 'search_school.php');
            handleInput(searchInstrumentInput, searchInstrumentResults, 'search_instrument.php');
            handleInput(searchModelInput, searchModelResults, 'search_model.php');
        });

        async function submitForm(event) {
            event.preventDefault(); // отключаем перезагрузку/перенаправление страницы
            try {
                // Формируем запрос
                const response = await fetch(event.target.action, {
                    method: 'POST',
                    body: new FormData(event.target)
                });
                // проверяем, что ответ есть
                if (!response.ok) throw (`Ошибка при обращении к серверу: ${response.status}`);
                // проверяем, что ответ действительно JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw ('Ошибка. Ответ не JSON');
                }
                // обрабатываем запрос
                const json = await response.json();
                if (json.result === "success") {
                    // в случае успеха
                    // alert(json.info);
                    document.querySelector('.loading').classList.add('d-none');
                    document.querySelector('.alert-success').classList.remove('d-none');
                    setTimeout(function () {
                        document.querySelector('.alert-success').classList.add('d-none');
                        document.getElementById("searchSchool").value = "";
                        document.getElementById("typeInstrument").value = "";
                        document.getElementById("model").value = "";
                    }, 5000);

                } else {
                    // в случае ошибки
                    console.log(json.desc);
                    throw (json.info);
                    document.querySelector('.loading').classList.add('d-none');
                    document.querySelector('.alert-danger').classList.remove('d-none');
                    setTimeout(function () {
                        document.querySelector('.alert-danger').classList.add('d-none');
                    }, 5000);
                }
            } catch (error) { // обработка ошибки
                alert(error);
            }
        }
    </script>
</body>

</html>