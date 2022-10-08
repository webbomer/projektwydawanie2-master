<?php

//połączenie z mssql
require "../mssql_php/config.php";
require "../mssql_php/include/db_connect.php";
require "../mssql_php/include/functions.php";
require "../gs1parserAuto.php";

$scan=$_GET['scan'];
// $scan=('] C1010590717672424015230324101002054676');
// $scan='4101770873446';

// $nr_partii='działa';
try{

$p = new Tgs1parser;
$p->parse($scan);
// $ean["zamowienie"] ='-1';
$koddy["zamowienie"]["ean"] =$p->ean;
$koddy["zamowienie"]["nr_partii"] =$p->batch;



//   //$nr_partii='dziala';
  
// if(($ean!=-1)&&(!empty($nr_partii))){

// $sql="SELECT
// 	iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod ID,iw.poz_w_mag,
// 	nt.nazwa, iw.MAG_SEKCJA Lokalizacja, iw.KOD_TOW, iw.EAN1, sum(tv.ILR) ILR, naw.ILOSC_NAW, sum (tv.ilr * iw.WAGA_N) Waga, jm.NAZWA JednostkaMiary, count(pa.sww_t) Licznik
// 	FROM
// 	gm.DokSPNag z 
// 	JOIN gm.DokSPPoz tv ON tv.dz_kod=z.dz_kod AND tv.rr=z.rr AND tv.mc=z.mc AND tv.nr=z.nr
// 	JOIN gm.ktPoz it ON it.mag_kod=tv.mag_kod AND it.SWW_B=tv.SWW_B AND it.SWW_P=tv.SWW_P AND it.SWW_A=tv.SWW_A AND it.SWW_T=tv.SWW_T AND it.PRZYJ_RR=tv.PRZYJ_RR AND it.PRZYJ_NR=tv.PRZYJ_NR
// 	JOIN gm.ktNag iw ON iw.mag_kod=it.mag_kod AND iw.SWW_B=it.SWW_B AND iw.SWW_P=it.SWW_P AND iw.SWW_A=it.SWW_A AND iw.SWW_T=it.SWW_T AND iw.NAW_KOD=it.NAW_KOD AND iw.JM_KOD=it.JM
// 	JOIN gm.DefNazwaTow nt ON nt.SWW_B=iw.SWW_B AND nt.SWW_P=iw.SWW_P AND nt.SWW_A=iw.SWW_A AND nt.SWW_T=iw.SWW_T
// 	JOIN gm.DefJM jm ON jm.JM_KOD=iw.JM_KOD
// 	JOIN gm.DefNawazka naw ON naw.NAW_KOD=iw.NAW_KOD
// 	LEFT OUTER JOIN KWW_partie pa ON z.DZ_KOD=pa.dz_kod AND z.rr=pa.rr AND z.mc=pa.mc AND z.nr=pa.nr AND iw.mag_kod=pa.mag_kod AND iw.sww_b=pa.sww_b AND iw.sww_p=pa.sww_p AND iw.sww_a=pa.sww_a AND iw.sww_t=pa.sww_t AND iw.naw_kod=pa.naw_kod AND iw.jm_kod=pa.jm

// 	WHERE z.DZ_KOD='$dz_kod' AND z.rr='$rr' AND z.mc='$mc' AND z.nr='$nr' AND EAN1='$ean'
// 	group by 
// 	iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod,
// 	nt.nazwa, iw.MAG_SEKCJA , iw.KOD_TOW, iw.EAN1, naw.ILOSC_NAW, jm.NAZWA, iw.poz_w_mag ";

// $que = db_query($sql);
// $answer["zamowienie"] = [];
// $i=0;
// while ($result = db_fetch_array($que)) {
//     $answer["zamowienie"][$i]['mag_kod'] = toUTF($result["mag_kod"]);
//     $answer["zamowienie"][$i]['ID'] = toUTF($result["ID"]);    
//     $answer["zamowienie"][$i]['nazwa'] = toUTF($result["nazwa"]);
//     $answer["zamowienie"][$i]['Lokalizacja'] = toUTF($result["Lokalizacja"]);
//     $answer["zamowienie"][$i]['KOD_TOW'] = toUTF($result["KOD_TOW"]);
//     $answer["zamowienie"][$i]['EAN1'] = toUTF($result["EAN1"]);
//     $answer["zamowienie"][$i]['ILR'] = toUTF($result["ILR"]);
//     $answer["zamowienie"][$i]['ILOSC_NAW'] = toUTF($result["ILOSC_NAW"]);
//     $answer["zamowienie"][$i]['Waga'] = toUTF($result["Waga"]);
//     $answer["zamowienie"][$i]['JednostkaMiary'] = toUTF($result["JednostkaMiary"]);
//     $answer["zamowienie"][$i]['Licznik'] = toUTF($result["Licznik"]);
//     $i++;
// }
// $i--;

// $dane = explode("-", $answer["zamowienie"][$i]['ID']);

// // wyświetlenie otrzymanej tablicy
// $mag_kod=$dane[0];
// $sww_b=$dane[1];
// $sww_p=$dane[2];
// $sww_a=$dane[3];
// $sww_t=$dane[4];
// $naw_kod=$dane[5];
// $jm=  $answer["zamowienie"][$i]['JednostkaMiary'];
// $ma_partie='1';

// // echo ( $dz_kod );
// // echo ( $rr );
// // echo ( $mc );
// // echo ( $nr );
// // echo ( $ean );

// // echo ( $sww_b );
// // echo ( $sww_p );
// // echo ( $sww_a );
// // echo ( $sww_t );
// // echo ( $naw_kod );

// $sql_lp = "SELECT
// dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, lp, ma_partie, nr_partii
// FROM
// KWW_partie
// WHERE 
// dz_kod='$dz_kod'AND rr='$rr'AND mc='$mc'AND nr='$nr'AND mag_kod='$mag_kod'AND sww_b='$sww_b'AND sww_p='$sww_p'AND sww_a='$sww_a'AND sww_t='$sww_t'AND naw_kod='$naw_kod' 
// -- dz_kod='0'AND rr='2022'AND mc='5'AND ma_partie='1'--
// ";
// $que_lp = db_query($sql_lp);

// $answer["zamowienie"] = [];
// $i=0;

// while ($result = db_fetch_array($que_lp)) {
//     $answer["zamowienie"][$i]['dz_kod'] = toUTF($result["dz_kod"]);
//     $answer["zamowienie"][$i]['rr'] = toUTF($result["rr"]);    
//     $answer["zamowienie"][$i]['mc'] = toUTF($result["mc"]);
//     $answer["zamowienie"][$i]['nr'] = toUTF($result["nr"]);
//     $answer["zamowienie"][$i]['mag_kod'] = toUTF($result["mag_kod"]);
//     $answer["zamowienie"][$i]['sww_b'] = toUTF($result["sww_b"]);
//     $answer["zamowienie"][$i]['sww_p'] = toUTF($result["sww_p"]);
//     $answer["zamowienie"][$i]['sww_a'] = toUTF($result["sww_a"]);
//     $answer["zamowienie"][$i]['sww_t'] = toUTF($result["sww_t"]);
//     $answer["zamowienie"][$i]['naw_kod'] = toUTF($result["naw_kod"]);
//     $answer["zamowienie"][$i]['jm'] = toUTF($result["jm"]);
//     $answer["zamowienie"][$i]['lp'] = toUTF($result["lp"]);
//     $answer["zamowienie"][$i]['ma_partie'] = toUTF($result["ma_partie"]);
//     $answer["zamowienie"][$i]['nr_partii'] = toUTF($result["nr_partii"]);
//     $i++;
// };
// $i--;
 

// // to do od tego momentu
// if ((($answer["zamowienie"][$i]['lp']==0) || (isset($answer["zamowienie"][$i]['lp'])))  && (empty($nr_partii))){

//      $ma_partie=0;

//      $sql = "INSERT INTO KWW_partie
//      (dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, ma_partie, time_stamp)
//      VALUES 
//      ('$dz_kod', '$rr', '$mc', '$nr', '$mag_kod', '$sww_b', '$sww_p', '$sww_a', '$sww_t', '$naw_kod', '$jm', '$ma_partie', GETDATE());";
//      $que = db_query($sql);
   
// }
// else if ((($answer["zamowienie"][$i]['lp']==0) || ($answer["zamowienie"][$i]['lp']== [""]) || ($answer["zamowienie"][$i]['lp']=='lp'))&& (($nr_partii!=[""]))){
//     $lp=1;
//     $sql = "INSERT INTO KWW_partie
//     (dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, lp, ma_partie, nr_partii, time_stamp)
//     VALUES 
//     ('$dz_kod', '$rr', '$mc', '$nr', '$mag_kod', '$sww_b', '$sww_p', '$sww_a', '$sww_t', '$naw_kod', '$jm', '$lp', '$ma_partie', '$nr_partii', GETDATE());";
//     $que = db_query($sql);

// }
// else{
//     $add_lp=$answer["zamowienie"][$i]['lp'];
//     $xx=0;
//     while ($xx < 1){
//         if(($answer["zamowienie"][$i]['lp']==($add_lp-1))){
//                 $sql = "INSERT INTO KWW_partie
//                 (dz_kod, rr, mc, nr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, lp, ma_partie, nr_partii, time_stamp)
//                 VALUES 
//                 ('$dz_kod', '$rr', '$mc', '$nr', '$mag_kod', '$sww_b', '$sww_p', '$sww_a', '$sww_t', '$naw_kod', '$jm', '$add_lp', '$ma_partie', '$nr_partii', GETDATE());";
//                 $que = db_query($sql);
//                 echo 'i=', $i,'add_lp=', $add_lp;
//                 $xx=2;
//                 // break;
        
//         }else{
//             $add_lp++;
//             $xx=0;
//         };
//     };
// };

//  };
}finally{
echo json_encode($koddy, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

?>