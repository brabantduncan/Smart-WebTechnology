<?php
include_once "DBConnect.php";
session_start();

$conn = OpenCon();

$result = mysqli_query($conn, "SELECT temp FROM logs ORDER BY id DESC LIMIT 0, 1");

$list = array();
while(($row = mysqli_fetch_assoc($result))) {
    $list[] = $row;
}

foreach($list as $key => $value){
    $_SESSION["temp_Not"] = $value['temp'];
}

$result2 = mysqli_query($conn, "SELECT moist FROM logs ORDER BY id DESC LIMIT 0, 1");

$list2 = array();
while(($row2 = mysqli_fetch_assoc($result2))) {
    $list2[] = $row2;
}

foreach($list2 as $key => $value){
    $_SESSION["moist_Not"] = $value['moist'];
}

CloseCon($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/3022cf58cbc1c5a01de004e504d16ad8-128x128.png" type="image/x-icon">
    <meta name="description" content="Reminders page">

    <title>Reminders</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="manifest" href="/manifest.json">


</head>
<body>
<section class="menu cid-rlhaFGtUFp" once="menu" id="menu1-1">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                         <img src="assets/images/3022cf58cbc1c5a01de004e504d16ad8-130x130.png" alt="Home Page" title=""
                              style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap">
                    <a class="navbar-caption text-white display-4" href="index.php">ROSES &amp; CO.</a>
                </span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="process.php">
                        <span class="mbri-refresh mbr-iconfont mbr-iconfont-btn"></span>Process</a>
                </li>
                <li class="nav-item"><a class="nav-link link text-white display-4" href="recommendations.php">
                    <span class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>Recommendations</a>
                </li>
            </ul>
        </div>
    </nav>
</section>

<section class="counters6 counters cid-rlhCjVSrQc" id="counters6-c">
    <div class="container pt-4 mt-2">
        <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">Recommendations</h2>
        <h3 class="mbr-section-subtitle pb-5 align-center mbr-fonts-style display-5">
            Below you can follow up on the status of the roses. When a status changes to an alert, you can take the recommended actions.</h3>
        <div>
            <div class="cards-container">
                <div class="card col-12 col-md-6 col-lg-4 pb-md-4">
                    <div class="panel-item align-center">
                        <div class="card-img pb-3">
                            <h3 class="img-text mbr-fonts-style display-1">
                                <?php
                                if($_SESSION['temp_Not']<25 && $_SESSION['temp_Not']>15){
                                   echo "Perfect";
                                } else {
                                    echo "<strong>ALERT</strong>";
                                }
                                ?>
                            </h3>
                        </div>
                        <div class="card-text">
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Temperature</h4>
                            <p class="mbr-content-text mbr-fonts-style display-7">
                                <?php
                                if($_SESSION['temp_Not']<25 && $_SESSION['temp_Not']>15){
                                    echo "The temperature is between 15 and 25 degrees Celcius. No further actions need to be taken. When the
                                temperature gets too high or too cold, you will get notified.";
                                } else {
                                    echo "<strong>Take a look at the temperature and use airco when it's too warm or turn up the heat when it's too cold.</strong>";
                                }
                                ?>
                                </p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-md-6 col-lg-4 pb-md-4">
                    <div class="panel-item align-center">
                        <div class="card-img pb-3">
                            <h3 class="img-text mbr-fonts-style display-1">
                                <?php
                                if($_SESSION['moist_Not']<90 && $_SESSION['moist_Not']>10){
                                    echo "Perfect";
                                } else {
                                    echo "<strong>ALERT</strong>";
                                }
                                ?>
                            </h3>
                        </div>
                        <div class="card-text">
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Soil Moisture</h4>
                            <p class="mbr-content-text mbr-fonts-style display-7">
                                <?php
                                if($_SESSION['moist_Not']<90 && $_SESSION['moist_Not']>10){
                                    echo "The soil has a good moisture level. The roses are very thankful. ";
                                } else {
                                    echo "Check if the plants have enough water or if they have too much, try to move them to a dryer soil.";
                                }
                                ?>
                                </p>
                        </div>
                    </div>
                </div>
                <!--<div class="card col-12 col-md-6 col-lg-4 last-child">
                    <div class="panel-item align-center">
                        <div class="card-img pb-3">
                            <h3 class="img-text mbr-fonts-style display-1">Fine</h3>
                        </div>
                        <div class="card-text">
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Sunlight</h4>
                            <p class="mbr-content-text mbr-fonts-style display-7">The roses haven't gotten enough
                                sunlight yet. When they get over 6 hours of sunlight you will get notified.</p>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</section>

<section once="" class="cid-rlhvx6VTmU" id="footer6-8">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="col-12">
                <p class="mbr-text mb-0 mbr-fonts-style display-7"><em>
                    Made by Duncan Brabant - Howest</em></p>
            </div>
        </div>
    </div>
</section>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/theme/js/script.js"></script>

<script>
    setTimeout(function(){
        window.location.reload(1);
    }, 10000);
</script>

</body>
</html>