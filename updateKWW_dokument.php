
<?php

//połączenie z mssql
require "./mssql/config.php";
require "./mssql/include/db_connect.php";
require "./mssql/include/functions.php";

$dz_kod = $_GET['dz_kod'];
$rr = $_GET['rr'];
$mc = $_GET['mc'];
$nr = $_GET['nr'];
$kww_user = $_SESSION['user'];
$status = $_GET['status'];

/*
0 - do zrobienia (lub brak wiersza w ogóle)
1 - w trakcie
2 - zakonczone
3 - error
*/ 

//komenda

$sql = "SELECT dz_kod, rr, mc, nr, kww_user, [status]  
FROM KWW_dokument";

$que = db_query($sql);

$answer["KWW_dokument"] = [];

$i=0;
while ($result = db_fetch_array($que)) {
    $answer["KWW_dokument"][$i]['dz_kod'] = toUTF($result["dz_kod"]);
    $answer["KWW_dokument"][$i]['rr'] = toUTF($result["rr"]);    
    $answer["KWW_dokument"][$i]['mc'] = toUTF($result["mc"]);
    $answer["KWW_dokument"][$i]['nr'] = toUTF($result["nr"]);
    $answer["KWW_dokument"][$i]['kww_user'] = toUTF($result["kww_user"]);
    $answer["KWW_dokument"][$i]['[status]'] = toUTF($result["[status]"]);
}
if ((($answer["KWW_dokument"][$i]['kww_user'])==$kww_user) && (!empty $answer["KWW_dokument"][$i]['[status]']))

// echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>