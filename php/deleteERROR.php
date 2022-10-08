<?php

//połączenie z mssql
require "../mssql_php/config.php";
require "../mssql_php/include/db_connect.php";
require "../mssql_php/include/functions.php";

$user=$_POST['user'];

$dz_kod = $_POST['dz_kod'];
$rr = $_POST['rr'];
$mc = $_POST['mc'];
$nr = $_POST['nr'];

 
$sql_partie="DELETE FROM KWW_partie 
WHERE dz_kod='$dz_kod' AND rr='$rr' AND mc='$mc' AND nr='$nr'";

db_query($sql_partie);


$sql_dokumenty="DELETE FROM KWW_dokument
WHERE  dz_kod='$dz_kod' AND rr='$rr' AND mc='$mc' AND nr='$nr' AND kww_user='$user'";

db_query($sql_dokumenty);


?>