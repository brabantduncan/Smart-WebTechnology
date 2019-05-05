<?php
include_once 'DBConnect.php';

$conn = OpenCon();

if (isset($_POST['temp']) && $_POST['light']) {
    $temp = $_POST['temp'];
    $light = $_POST['light'];
    $moist = $_POST['moist'];

    $sql = "INSERT INTO logs (light, temp, moist) VALUES ('" . $light . "', '" . $temp . "', '" .$moist ."')";

    if (mysqli_query($conn, $sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

CloseCon($conn);
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Gets data from NodeMCU</h1>
</body>
</html>