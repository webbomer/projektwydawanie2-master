<?php

require "./mssql/config.php";
require "./mssql/include/db_connect.php";
require "./mssql/include/functions.php";

//wysyłane dane
$dz_kod = $_GET['dz_kod'];
$rr = $_GET['rr'];
$mc = $_GET['mc'];
$nr = $_GET['nr'];
$mag_kod = $_GET['mag_kod'];
$sww_b = $_GET['sww_b'];
$sww_p = $_GET['sww_p'];
$sww_a = $_GET['sww_a'];
$sww_t = $_GET['sww_t'];
$naw_kod = $_GET['naw_kod'];
$jm = $_GET['jm'];
$ma_partie = $_GET['ma_partie'];
$nr_partii = $_GET['nr_partii'];

$sql_lp = "SELECT
dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, lp, ma_partie, nr_partii
FROM
KWW_partie
WHERE 
dz_kod='$dz_kod'AND rr='$rr'AND mc='$mc'AND nr='$nr'AND mag_kod='$mag_kod'AND sww_b='$sww_b'AND sww_p='$sww_p'AND sww_a='$sww_a'AND sww_t='$sww_t'AND naw_kod='$naw_kod' AND jm='$jm' AND ma_partie='$ma_partie'
-- dz_kod='0'AND rr='2022'AND mc='5'AND ma_partie='1'--
";
$que_lp = db_query($sql_lp);

$answer["zamowienie"] = [];
$i=0;

while ($result = db_fetch_array($que_lp)) {
    $answer["zamowienie"][$i]['dz_kod'] = toUTF($result["dz_kod"]);
    $answer["zamowienie"][$i]['rr'] = toUTF($result["rr"]);    
    $answer["zamowienie"][$i]['mc'] = toUTF($result["mc"]);
    $answer["zamowienie"][$i]['nr'] = toUTF($result["nr"]);
    $answer["zamowienie"][$i]['mag_kod'] = toUTF($result["mag_kod"]);
    $answer["zamowienie"][$i]['sww_b'] = toUTF($result["sww_b"]);
    $answer["zamowienie"][$i]['sww_p'] = toUTF($result["sww_p"]);
    $answer["zamowienie"][$i]['sww_a'] = toUTF($result["sww_a"]);
    $answer["zamowienie"][$i]['sww_t'] = toUTF($result["sww_t"]);
    $answer["zamowienie"][$i]['naw_kod'] = toUTF($result["naw_kod"]);
    $answer["zamowienie"][$i]['jm'] = toUTF($result["jm"]);
    $answer["zamowienie"][$i]['lp'] = toUTF($result["lp"]);
    $answer["zamowienie"][$i]['ma_partie'] = toUTF($result["ma_partie"]);
    $answer["zamowienie"][$i]['nr_partii'] = toUTF($result["nr_partii"]);
    $i++;
};

  echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);


?>