
<?php

require "./mssql/config.php";
require "./mssql/include/db_connect.php";
require "./mssql/include/functions.php";
require "./gs1parserAuto.php";


//wysyłane dane
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


try{
$p = new Tgs1parser;
// $p->parse("] C1" .$nr_partii);
$p->parse($nr_partii);
$batch='-1';
$batch=$p->batch;

echo $nr_partii;
    if(($batch !=('-1')) && (!empty($batch))){
        $nr_partii=$batch;
    };
echo "<br>";
    echo $nr_partii;
    
}finally{


// echo $dz_kod, $rr, $mc, $nr, $mag_kod, $sww_b, $sww_p, $sww_a, $sww_t, $naw_kod,$jm, $ma_partie, $nr_partii;

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
$i--;
//   echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// to do od tego momentu
if ((($answer["zamowienie"][$i]['lp']==0) || (isset($answer["zamowienie"][$i]['lp'])))  && (empty($nr_partii))){

     $ma_partie=0;

     $sql = "INSERT INTO KWW_partie
     (dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, ma_partie, time_stamp)
     VALUES 
     ('$dz_kod', '$rr', '$mc', '$nr', '$mag_kod', '$sww_b', '$sww_p', '$sww_a', '$sww_t', '$naw_kod', '$jm', '$ma_partie', GETDATE());";
     $que = db_query($sql);
   
}
else if ((($answer["zamowienie"][$i]['lp']==0) || ($answer["zamowienie"][$i]['lp']== [""]) || ($answer["zamowienie"][$i]['lp']=='lp'))&& (($nr_partii!=[""]))){
    $lp=1;
    $sql = "INSERT INTO KWW_partie
    (dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, lp, ma_partie, nr_partii, time_stamp)
    VALUES 
    ('$dz_kod', '$rr', '$mc', '$nr', '$mag_kod', '$sww_b', '$sww_p', '$sww_a', '$sww_t', '$naw_kod', '$jm', '$lp', '$ma_partie', '$nr_partii', GETDATE());";
    $que = db_query($sql);

}
else{
    $add_lp=$answer["zamowienie"][$i]['lp'];
    $xx=0;
    while ($xx < 1){
        if(($answer["zamowienie"][$i]['lp']==($add_lp-1))){
                $sql = "INSERT INTO KWW_partie
                (dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, lp, ma_partie, nr_partii, time_stamp)
                VALUES 
                ('$dz_kod', '$rr', '$mc', '$nr', '$mag_kod', '$sww_b', '$sww_p', '$sww_a', '$sww_t', '$naw_kod', '$jm', '$add_lp', '$ma_partie', '$nr_partii', GETDATE());";
                $que = db_query($sql);
                echo 'i=', $i,'add_lp=', $add_lp;
                $xx=2;
                // break;
        
        }else{
            $add_lp++;
            $xx=0;
        };
    };
};


}

//echo" $dz_kod,$rr,$mc, $nr, $mag_kod, $sww_b, $sww_p, $sww_a, $sww_t, $naw_kod, $jm, $lp, $ma_partie, $nr_partii" ;

// //WSZYSTKIE ERRORY
// echo sqlsrv_configure("WarningsReturnAsErrors",true );  
// print_r( sqlsrv_errors(), true);
//  sqlsrv_errors() ;
//  sqlsrv_errors( SQLSRV_ERR_ALL )  ;
//  printf(sqlsrv_errors (  ));
//  sqlsrv_server_info();

?>