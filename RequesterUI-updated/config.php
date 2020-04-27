<?php
$servername = 'remotemysql.com';
$dBUsername = 'Kvs8AuC78e';
$dBPassword = 'bmMrp4oj2h';
$dBName = 'Kvs8AuC78e';

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>