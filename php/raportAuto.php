<?php

//połączenie z mssql
require "../mssql_php/config.php";
require "../mssql_php/include/db_connect.php";
require "../mssql_php/include/functions.php";

$user=$_GET['user'];

$dz_kod = $_GET['dz_kod'];
$rr = $_GET['rr'];
$mc = $_GET['mc'];
$nr = $_GET['nr'];

// $user='pawel.zywert@dawnfoods.com';

// $dz_kod = '00';
// $rr = '2022';
// $mc = '06';
// $nr = '08886';

 $sqll = "SELECT dz_kod, rr, mc, nr, kww_user, [status]  
 FROM KWW_dokument WHERE dz_kod='$dz_kod' AND rr='$rr' AND mc='$mc' AND nr='$nr';";

//$sqll="SELECT * FROM KWW_dokument;";

//echo $sqll;

$queb = db_query($sqll);

//print_r($queb);

$answer["KWW_dokument"] = [];
$status=-1;

$i=0;
if ($result = db_fetch_array($queb)) {
    $status=($result["status"]);  
};

//echo $status;

//$que = db_query($sqll);

 if ($status==-1){
     $sql="INSERT INTO KWW_dokument
     (dz_kod, rr, mc, nr, kww_user, [status] )
     VALUES 
     ('$dz_kod', '$rr', '$mc', '$nr', '$user', '1');";
     $que = db_query($sql);


 }else{
    $sql="UPDATE KWW_dokument
    SET [status]  = '1'
    WHERE dz_kod='$dz_kod' AND rr='$rr' AND mc='$mc' AND nr='$nr' AND kww_user='$user';";
    $que = db_query($sql);
   
 };

?>