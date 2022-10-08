<!-- CREATE TABLE KWW_dokument (
dz_kod       varchar(2),
rr                  varchar(4),
mc                  varchar(2),
nr                  varchar(5),
kww_user     varchar(50),
[status]     integer,
)
 
/*
0 - do zrobienia (lub brak wiersza w ogóle)
1 - w trakcie
2 - zakonczone
*/ -->
<?php

require "./mssql/config.php";
require "./mssql/include/db_connect.php";
require "./mssql/include/functions.php";

$kod = $_GET['kod'];
$rr = $_GET['rr'];
$mc = $_GET['mc'];
$nrr = $_GET['nrr'];

//połączenie z mssql
require "./mssql/config.php";
require "./mssql/include/db_connect.php";
require "./mssql/include/functions.php";

// ini_set("max_execution_time",300)

//komenda
$sql = " SELECT

iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod ID,
nt.nazwa, iw.MAG_SEKCJA Lokalizacja, iw.KOD_TOW, iw.EAN1, sum(tv.ILR) ILR, naw.ILOSC_NAW, sum (tv.ilr * iw.WAGA_N) Waga, jm.NAZWA JednostkaMiary, count(pa.sww_t) Licznik
FROM
gm.DokSPNag z 
JOIN gm.DokSPPoz tv ON tv.dz_kod=z.dz_kod AND tv.rr=z.rr AND tv.mc=z.mc AND tv.nr=z.nr
JOIN gm.ktPoz it ON it.mag_kod=tv.mag_kod AND it.SWW_B=tv.SWW_B AND it.SWW_P=tv.SWW_P AND it.SWW_A=tv.SWW_A AND it.SWW_T=tv.SWW_T AND it.PRZYJ_RR=tv.PRZYJ_RR AND it.PRZYJ_NR=tv.PRZYJ_NR
JOIN gm.ktNag iw ON iw.mag_kod=it.mag_kod AND iw.SWW_B=it.SWW_B AND iw.SWW_P=it.SWW_P AND iw.SWW_A=it.SWW_A AND iw.SWW_T=it.SWW_T AND iw.NAW_KOD=it.NAW_KOD AND iw.JM_KOD=it.JM
JOIN gm.DefNazwaTow nt ON nt.SWW_B=iw.SWW_B AND nt.SWW_P=iw.SWW_P AND nt.SWW_A=iw.SWW_A AND nt.SWW_T=iw.SWW_T
JOIN gm.DefJM jm ON jm.JM_KOD=iw.JM_KOD
JOIN gm.DefNawazka naw ON naw.NAW_KOD=iw.NAW_KOD
LEFT OUTER JOIN KWW_partie pa ON z.DZ_KOD=pa.dz_kod AND z.rr=pa.rr AND z.mc=pa.mc AND z.nr=pa.nr AND iw.mag_kod=pa.mag_kod AND iw.sww_b=pa.sww_b AND iw.sww_p=pa.sww_p AND iw.sww_a=pa.sww_a AND iw.sww_t=pa.sww_t AND iw.naw_kod=pa.naw_kod AND iw.jm_kod=pa.jm

WHERE z.DZ_KOD=$kod AND z.rr=$rr AND z.mc=$mc AND z.nr='$nrr'
group by 
iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod,
nt.nazwa, iw.MAG_SEKCJA , iw.KOD_TOW, iw.EAN1, naw.ILOSC_NAW, jm.NAZWA  
order by  iw.MAG_SEKCJA";

$que = db_query($sql);
$answer["zamowienie"] = [];
$i=0;
while ($result = db_fetch_array($que)) {
    $answer["zamowienie"][$i]['mag_kod'] = toUTF($result["mag_kod"]);
    $answer["zamowienie"][$i]['ID'] = toUTF($result["ID"]);    
    $answer["zamowienie"][$i]['nazwa'] = toUTF($result["nazwa"]);
    $answer["zamowienie"][$i]['Lokalizacja'] = toUTF($result["Lokalizacja"]);
    $answer["zamowienie"][$i]['KOD_TOW'] = toUTF($result["KOD_TOW"]);
    $answer["zamowienie"][$i]['EAN1'] = toUTF($result["EAN1"]);
    $answer["zamowienie"][$i]['ILR'] = toUTF($result["ILR"]);
    $answer["zamowienie"][$i]['ILOSC_NAW'] = toUTF($result["ILOSC_NAW"]);
    $answer["zamowienie"][$i]['Waga'] = toUTF($result["Waga"]);
    $answer["zamowienie"][$i]['JednostkaMiary'] = toUTF($result["JednostkaMiary"]);
    $answer["zamowienie"][$i]['Licznik'] = toUTF($result["Licznik"]);
    $i++;
}

echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);


?>