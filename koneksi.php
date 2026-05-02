<?php
$host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: 'FqLPLKoaDIwZhodqmxRQxiGeQMgdnyCX';
$db   = getenv('MYSQLDATABASE') ?: 'railway';
$port = (int)(getenv('MYSQLPORT') ?: 3306);

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die(json_encode(["error" => mysqli_connect_error()]));
}
?>