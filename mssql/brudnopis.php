<?php

$tablica["reports"]=[]; 
$tablica["reports"][0]['id']="0";
$tablica["reports"][1]['id']="1";
$tablica["reports"][0]['imie']="Adam";
$tablica["reports"][1]['imie']="Kamil";
$tablica["reports"][0]['nazwisko']="Kalimewicz";
$tablica["reports"][1]['nazwisko']="Adamski";

echo json_encode($tablica);
 
?>