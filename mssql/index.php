<?php

ini_set ("max_execution_time", 100);
error_reporting(E_ALL);

require "config.php";
require "include/db_connect.php";
require "include/functions.php";


/*echo "cos tam";

$query = "SELECT * from kierowcy";

$result=db_query($query);

while ($r=db_fetch_array($result)) {
  echo $r["imie"]." ";
}
*/
///////DODANIE MSSQL////////////
$drivers["reports"] = [];
$i=0;

$query = ("SELECT * FROM kierowcy");
$que=db_query($query);
//$sql = $polaczenie->query($querry);

while($result = db_fetch_array($que))
{
  //iconv ( string $from_encoding , string $to_encoding , string $string ) : string|false
  //$drivers["reports"][$i]['id'] = toUTF($result["id"]); 
  //$drivers["reports"][$i]['nazwisko'] = toUTF($result["nazwisko"]);
  //$drivers["reports"][$i]['imie'] = toUTF($result["imie"]);

  
    $drivers["reports"][$i]['id'] = toUTF($result["id"]); 
    $drivers["reports"][$i]['nazwisko'] = toUTF($result["nazwisko"]);
    $drivers["reports"][$i]['imie'] = toUTF($result["imie"]);
    $drivers["reports"][$i]['nr'] = toUTF($result["nr"]);
    $drivers["reports"][$i]['lokalizacja'] = toUTF($result["lokalizacja"]);
 
    $i=$i+1;
}
//var_dump($drivers);
//$drivers=["kąpać","grać"];
//$a[0]="kąpać";
//$a[1]="łapą";
/////$slowo="Edwąrd";
//$a = strtr($slowo, 'ą', 'a');
///echo $slowo."</br>";
//echo $a;
//$tablica[0]="Prędk";
//$tablica[1]='bągęzł';
//echo($tablica[1]);
//var_dump($drivers);
//echo json_encode($tablica);
//var_dump($drivers);
//echo $drivers["reports"][4]['id'];
echo json_encode($drivers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
////////////KONIEC MSSQL/////////////

?>