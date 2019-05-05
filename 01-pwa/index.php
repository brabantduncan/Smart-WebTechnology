<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/3022cf58cbc1c5a01de004e504d16ad8-128x128.png" type="image/x-icon">
    <meta name="description" content="Roses & Co">

    <title>Home</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="manifest" href="/manifest.json">

    <script src="serviceworker.js"></script>

</head>
<body>
<section class="header1 cid-rlh4cQkbp7 mbr-fullscreen mbr-parallax-background" id="header16-0">


    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(79, 4, 36);">
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10 align-center">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    Roses &amp; Co.</h1>
                <div class="mbr-section-btn">
                    <a class="btn btn-md btn-white-outline display-4" href="process.php">
                        <span class="mbri-refresh mbr-iconfont mbr-iconfont-btn"></span>PROCESS</a>
                    <a class="btn btn-md btn-white-outline display-4" href="recommendations.php">
                        <span class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>RECOMMENDATIONS</a>
                </div>
            </div>
        </div>
    </div>

</section>


<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/theme/js/script.js"></script>

<script>
    if ('serviceWorker' in navigator) {
        console.log('CLIENT: service worker registration in progress.');
        navigator.serviceWorker.register('/serviceworker.js').then(function() {
            console.log('CLIENT: service worker registration complete.');
        }, function() {
            console.log('CLIENT: service worker registration failure.');
        });
    } else {
        console.log('CLIENT: service worker is not supported.');
    }

</script>

</body>
</html>