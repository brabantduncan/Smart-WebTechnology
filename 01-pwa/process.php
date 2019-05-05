<!DOCTYPE html>
<?php
include 'DBConnect.php';
session_start();
$conn = OpenCon();

$result = mysqli_query($conn, "SELECT Datum FROM startDatum WHERE id = '1'");

$list = array();
while(($row = mysqli_fetch_assoc($result))) {
    $list[] = $row;
}

foreach($list as $key => $value){
    $_SESSION["startDate"] = $value['Datum'];
    $date1 = new DateTime($value['Datum']);
    $new_date_format = $date1->format('Y-m-d H:i:s');

    $date2 = date("Y-m-d H:i:s");
    $start_date = strtotime($new_date_format);
    $end_date = strtotime($date2);
    $_SESSION['datumVerschil'] = ceil(abs((($end_date - $start_date)/60/60/24))/42*100);
}


if(isset($_POST['date']) && $_POST['name']){
    $res = mysqli_query($conn,"UPDATE startDatum SET Datum ='".$_POST['date']."' where ID= '".$_POST['name']."'");
}
else{
    //echo "AJAX call failed to send post variables";
}

$result2 = mysqli_query($conn, "SELECT temp FROM logs ORDER BY id DESC LIMIT 0, 1");

$list2 = array();
while(($row2 = mysqli_fetch_assoc($result2))) {
    $list2[] = $row2;
}

foreach($list2 as $key => $value){
    $_SESSION["temp"] = $value['temp'];
}

$result3 = mysqli_query($conn, "SELECT light FROM logs ORDER BY id DESC LIMIT 0, 1");

$list3 = array();
while(($row3 = mysqli_fetch_assoc($result3))) {
    $list3[] = $row3;
}

foreach($list3 as $key => $value){
    $_SESSION["light"] = $value['light'];
}

$result4 = mysqli_query($conn, "SELECT moist FROM logs ORDER BY id DESC LIMIT 0, 1");

$list4 = array();
while(($row4 = mysqli_fetch_assoc($result4))) {
    $list4[] = $row4;
}

foreach($list4 as $key => $value){
    $_SESSION["moist"] = $value['moist'];
}

CloseCon($conn);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/3022cf58cbc1c5a01de004e504d16ad8-128x128.png" type="image/x-icon">
    <meta name="description" content="Process Cycle page">

    <title>Process</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/as-pie-progress/css/progress.min.css">
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
                <li class="nav-item"><a class="nav-link link text-white display-4" href="recommendations.php"><span
                        class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>Recommendations</a></li>
            </ul>

        </div>
    </nav>
</section>

<section class="progress-bars1 cid-rlhtZvrrk3" id="progress-bars1-7">
    <div class="container">
        <h2 class="mbr-section-title pb-2 align-center mbr-fonts-style display-2">Process Cycle</h2>

        <h3 class="mbr-section-subtitle pb-5 mbr-fonts-style display-5"><p><strong>Start Date:</strong>&nbsp; &nbsp;
            <?php echo $_SESSION['startDate'] ?></p></h3>

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-10 align-center">



                    <div class="mbr-section-btn"><a class="btn btn-md btn-black-outline display-4" onclick="update('1')">Renew Process Date</a>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

        <div class="progress_elements">
            <div class="progress1 pb-5">
                <div class="title-wrap">
                    <div class="progressbar-title mbr-fonts-style display-7">
                        <p><strong>Process Completion (<?php echo ceil($_SESSION['datumVerschil']/100*42) ?> of 42 Days)</strong></p>
                    </div>
                    <div class="progress_value mbr-fonts-style display-7">

                        <span><?php echo $_SESSION['datumVerschil'] ?>%</span>
                    </div>
                </div>
                <progress class="progress progress-primary" max="100" value="<?php echo $_SESSION['datumVerschil'] ?>"></progress>
            </div>
        </div>
    </div>
</section>

<section class="counters1 counters cid-rpm9QZecQM" id="counters1-e">





    <div class="container">
        <h2 class="mbr-section-title pb-2 align-center mbr-fonts-style display-2">Status</h2>


        <div class="container pt-4 mt-2">
            <div class="media-container-row">
                <div class="card p-3 align-center col-12 col-md-6 col-lg-4">
                    <div class="panel-item p-3">
                        <div class="card-img pb-3">
                            <span class="mbr-iconfont mobi-mbri-sun mobi-mbri"></span>
                        </div>

                        <div class="card-text">
                            <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                <?php echo $_SESSION['temp'] ?>°C
                            </h3>
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
                                Temperature</h4>

                        </div>
                    </div>
                </div>


                <div class="card p-3 align-center col-12 col-md-6 col-lg-4">
                    <div class="panel-item p-3">
                        <div class="card-img pb-3">
                            <span class="mbr-iconfont mbri-quote-left"></span>
                        </div>
                        <div class="card-text">
                            <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                <?php echo $_SESSION['moist'] ?>%
                            </h3>
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">Soil Moisture</h4>

                        </div>
                    </div>
                </div>

                <div class="card p-3 align-center col-12 col-md-6 col-lg-4">
                    <div class="panel-item p-3">
                        <div class="card-img pb-3">
                            <span class="mbr-iconfont mbri-idea"></span>
                        </div>
                        <div class="card-text">
                            <h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
                                <?php echo $_SESSION['light'] ?> lux
                            </h3>
                            <h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
                                Light</h4>

                        </div>
                    </div>
                </div>



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
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/as-pie-progress/jquery-as-pie-progress.min.js"></script>
<script src="assets/theme/js/script.js"></script>
<script>
    function update(name){
        // Simulates PHP's date function
        Date.prototype.format=function(e){var t="";var n=Date.replaceChars;for(var r=0;r<e.length;r++){var i=e.charAt(r);if(r-1>=0&&e.charAt(r-1)=="\\"){t+=i}else if(n[i]){t+=n[i].call(this)}else if(i!="\\"){t+=i}}return t};Date.replaceChars={shortMonths:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],longMonths:["January","February","March","April","May","June","July","August","September","October","November","December"],shortDays:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],longDays:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],d:function(){return(this.getDate()<10?"0":"")+this.getDate()},D:function(){return Date.replaceChars.shortDays[this.getDay()]},j:function(){return this.getDate()},l:function(){return Date.replaceChars.longDays[this.getDay()]},N:function(){return this.getDay()+1},S:function(){return this.getDate()%10==1&&this.getDate()!=11?"st":this.getDate()%10==2&&this.getDate()!=12?"nd":this.getDate()%10==3&&this.getDate()!=13?"rd":"th"},w:function(){return this.getDay()},z:function(){var e=new Date(this.getFullYear(),0,1);return Math.ceil((this-e)/864e5)},W:function(){var e=new Date(this.getFullYear(),0,1);return Math.ceil(((this-e)/864e5+e.getDay()+1)/7)},F:function(){return Date.replaceChars.longMonths[this.getMonth()]},m:function(){return(this.getMonth()<9?"0":"")+(this.getMonth()+1)},M:function(){return Date.replaceChars.shortMonths[this.getMonth()]},n:function(){return this.getMonth()+1},t:function(){var e=new Date;return(new Date(e.getFullYear(),e.getMonth(),0)).getDate()},L:function(){var e=this.getFullYear();return e%400==0||e%100!=0&&e%4==0},o:function(){var e=new Date(this.valueOf());e.setDate(e.getDate()-(this.getDay()+6)%7+3);return e.getFullYear()},Y:function(){return this.getFullYear()},y:function(){return(""+this.getFullYear()).substr(2)},a:function(){return this.getHours()<12?"am":"pm"},A:function(){return this.getHours()<12?"AM":"PM"},B:function(){return Math.floor(((this.getUTCHours()+1)%24+this.getUTCMinutes()/60+this.getUTCSeconds()/3600)*1e3/24)},g:function(){return this.getHours()%12||12},G:function(){return this.getHours()},h:function(){return((this.getHours()%12||12)<10?"0":"")+(this.getHours()%12||12)},H:function(){return(this.getHours()<10?"0":"")+this.getHours()},i:function(){return(this.getMinutes()<10?"0":"")+this.getMinutes()},s:function(){return(this.getSeconds()<10?"0":"")+this.getSeconds()},u:function(){var e=this.getMilliseconds();return(e<10?"00":e<100?"0":"")+e},e:function(){return"Not Yet Supported"},I:function(){var e=null;for(var t=0;t<12;++t){var n=new Date(this.getFullYear(),t,1);var r=n.getTimezoneOffset();if(e===null)e=r;else if(r<e){e=r;break}else if(r>e)break}return this.getTimezoneOffset()==e|0},O:function(){return(-this.getTimezoneOffset()<0?"-":"+")+(Math.abs(this.getTimezoneOffset()/60)<10?"0":"")+Math.abs(this.getTimezoneOffset()/60)+"00"},P:function(){return(-this.getTimezoneOffset()<0?"-":"+")+(Math.abs(this.getTimezoneOffset()/60)<10?"0":"")+Math.abs(this.getTimezoneOffset()/60)+":00"},T:function(){var e=this.getMonth();this.setMonth(0);var t=this.toTimeString().replace(/^.+ \(?([^\)]+)\)?$/,"$1");this.setMonth(e);return t},Z:function(){return-this.getTimezoneOffset()*60},c:function(){return this.format("Y-m-d\\TH:i:sP")},r:function(){return this.toString()},U:function(){return this.getTime()/1e3}}
        var now = new Date();
        var dateToInsert = now.format("Y-m-d");

        $.ajax({
            type: "POST",
            url: "process.php",
            data: { date: dateToInsert, name: name}
        })
            .done(function( msg ) {
                console.log( "Data Saved Correctly: "+name+" "+dateToInsert);
            });
    }

    setTimeout(function(){
        window.location.reload(1);
    }, 10000);
</script>

</body>
</html>