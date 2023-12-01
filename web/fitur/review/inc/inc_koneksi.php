<?php 
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "easytaskeasylife1";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("Gagal terkoneksi");
}