<?php

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "arisa";
$port = 4307;

mysqli_report(MYSQLI_REPORT_OFF);
$connection = mysqli_connect($hostname, $username, $password, $database, $port);
if (!$connection) {
    die ("ไม่ได้ เพราะ" . mysqli_connect_error());
}