<?php

//połączenie z mssql
require "./mssql/config.php";
require "./mssql/include/db_connect.php";
require "./mssql/include/functions.php";

//dane
$dz_kod = $_POST['dz_kod'];
$rr = $_POST['rr'];
$mc = $_POST['mc'];
$nr = $_POST['nr'];
$mag_kod = $_POST['mag_kod'];
$sww_b = $_POST['sww_b'];
$sww_p = $_POST['sww_p'];
$sww_a = $_POST['sww_a'];
$sww_t = $_POST['sww_t'];
$naw_kod = $_POST['naw_kod'];
$jm = $_POST['jm'];
$ma_partie = $_POST['ma_partie'];
$nr_partii = $_POST['nr_partii'];
$lp = $_POST['lp'];

$sql = "DELETE FROM KWW_partie 
WHERE dz_kod='$dz_kod' AND rr='$rr' AND mc='$mc' AND nr='$nr' AND mag_kod='$mag_kod' AND sww_b='$sww_b' AND sww_p='$sww_p' 
    AND sww_a='$sww_a' AND sww_t='$sww_t' AND naw_kod='$naw_kod' AND jm='$jm' AND lp='$lp' AND ma_partie='$ma_partie' 
    AND nr_partii='$nr_partii';";

db_query($sql);
?>