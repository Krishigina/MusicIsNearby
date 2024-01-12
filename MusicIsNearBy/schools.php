<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Музыка рядом - ваш помощник по выбору музыкальной школы</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/music-svgrepo-com.svg" rel="icon">

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

  <link href="assets/css/style.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <style>
    #header {
      background-color: #333;
      color: #fff;
      transition: all 0.5s;
      z-index: 997;
      padding: 15px 0;
    }

    .school-card {
      background-color: #fff;
      padding: 20px;
      margin: 20px 0;
      border: 1px solid #ddd;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    .school-card:hover {
      background-color: #a2bfcc;
      color: #fff;
    }
  </style>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Музыка рядом<span>.</span></a></h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.html">Главная</a></li>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </ul>
      </nav>

      <a href="#about" class="get-started-btn scrollto">Get Started</a>

    </div>
  </header>
  <main id="main">
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <?php
        require 'db_connect.php';
        if (!$conn) {
          die("Ошибка подключения к базе данных: " . $db->getConnectionError());
        }
        $sql = "SELECT DISTINCT EduOrganization FROM output";
        $result = $conn->query($sql);
        $output = '';
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $school_name = $row['EduOrganization'];
            $output .= "<div class='school-card'>$school_name</div>";
          }
        } else {
          $output = 'Нет доступных школ';
        }
        $conn->close();
        ?>
        <div class="content">
          <div class="card mt-5">
            <div class="card-body">
              <label>Поиск по названию :</label>
              <input type="text" name="user" id="user" class="form-control mt-2" placeholder="Введите название школы" />
              <div id="userList"></div>
            </div>
          </div>
          <div id="schoolCards">
            <?php echo $output; ?>
          </div>
        </div>
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
                </p>
              </div>
            </div>

            <div class="col-lg-2 col-md-6 footer-links">
              <h4>Полезные ссылки</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="index.html">Главная</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Наши сервисы</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="mapschools.php">Просмотреть школы на карте</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Сравнить школы</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Заявка на аренду инструмента</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="schools.php">Подробная информация о школе</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Поиск с фильтрацией</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Статьи о музыкальном образовании</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <div id="preloader"></div>
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
  </main>

  <script>
    $(document).ready(function () {
      function loadSchoolCards(query) {
        $.ajax({
          url: "search.php",
          method: "POST",
          data: { query: query },
          success: function (data) {
            $('#schoolCards').html(data);
          }
        });
      }

      $('#user').keyup(function () {
        var query = $(this).val();
        if (query != '') {
          $('#userList').fadeIn();
          loadSchoolCards(query);
        } else {
          $('#userList').fadeOut();
          loadSchoolCards('');
        }
      });

      $(document).on('mouseover', '.school-card', function () {
        $(this).css('background-color', '#a2bfcc');
      });

      $(document).on('mouseout', '.school-card', function () {
        $(this).css('background-color', '');
      });

      $(document).on('click', '.school-card', function () {
        var schoolName = $(this).text();
        window.location.href = 'school_details.php?school_name=' + encodeURIComponent(schoolName);
      });
    });
  </script>

</body>

</html>