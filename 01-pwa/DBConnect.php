<?php

function OpenCon()
{
    $dbhost = "ID285595_pwadb.db.webhosting.be";
    $dbuser = "ID285595_pwadb";
    $dbpass = "anderlecht1334";
    $db = "ID285595_pwadb";


    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);


    return $conn;
}


function CloseCon($conn)
{
    $conn -> close();
}

?>