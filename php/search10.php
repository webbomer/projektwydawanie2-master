<?php

//połączenie z mssql
require "../mssql_php/config.php";
require "../mssql_php/include/db_connect.php";
require "../mssql_php/include/functions.php";

$search = $_GET['szukaj'];
$sta=$_GET['sta'];
$user=$_GET['user'];


if ($sta==44){
    $sql="SELECT TOP 30 sub.oznaczenie AS Numer, COUNT(sub.kod) AS ilosc, sub.st AS sta
    FROM (
    SELECT
    iw.mag_kod AS kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod ID,
    nt.nazwa, iw.MAG_SEKCJA Lokalizacja, iw.KOD_TOW, iw.EAN1,
    jm.NAZWA JednostkaMiary, 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr AS oznaczenie, dd.[status] AS st,  dd.kww_user AS usser,
    sum (tv.ILR) ILR, naw.ILOSC_NAW, Sum(tv.ilr * iw.WAGA_N) Waga
    FROM
    gm.DokSPNag z 
    JOIN gm.DokSPPoz tv ON tv.dz_kod=z.dz_kod AND tv.rr=z.rr AND tv.mc=z.mc AND tv.nr=z.nr
    JOIN gm.ktPoz it ON it.mag_kod=tv.mag_kod AND it.SWW_B=tv.SWW_B AND it.SWW_P=tv.SWW_P AND it.SWW_A=tv.SWW_A AND it.SWW_T=tv.SWW_T AND it.PRZYJ_RR=tv.PRZYJ_RR AND it.PRZYJ_NR=tv.PRZYJ_NR
    JOIN gm.ktNag iw ON iw.mag_kod=it.mag_kod AND iw.SWW_B=it.SWW_B AND iw.SWW_P=it.SWW_P AND iw.SWW_A=it.SWW_A AND iw.SWW_T=it.SWW_T AND iw.NAW_KOD=it.NAW_KOD AND iw.JM_KOD=it.JM
    JOIN gm.DefNazwaTow nt ON nt.SWW_B=iw.SWW_B AND nt.SWW_P=iw.SWW_P AND nt.SWW_A=iw.SWW_A AND nt.SWW_T=iw.SWW_T
    JOIN gm.DefJM jm ON jm.JM_KOD=iw.JM_KOD
    JOIN gm.DefNawazka naw ON naw.NAW_KOD=iw.NAW_KOD
    LEFT JOIN KWW_dokument dd ON dd.dz_kod=z.dz_kod AND dd.rr=z.rr AND dd.mc=z.mc AND dd.nr=z.nr

    WHERE
    -- ((z.USRA_KOD is null) or (z.USRA_KOD='')) AND 
    (z.DATAWYST BETWEEN dateadd(day, -10, GETDATE()) AND GETDATE()) AND 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr LIKE '%'+'$search'+'%'
    AND (( dd.kww_user='$user') OR ( dd.kww_user is null))
    GROUP BY
    iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod,
    nt.nazwa, iw.MAG_SEKCJA, iw.KOD_TOW, iw.EAN1,
    jm.NAZWA, 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr, dd.[status], naw.ILOSC_NAW, dd.kww_user
    ) 
    sub
    GROUP BY sub.oznaczenie, sub.st, sub.usser;";

}else if ($sta==0){
    $sql="SELECT  sub.oznaczenie AS Numer, COUNT(sub.kod) AS ilosc, sub.st AS sta
    FROM (
    SELECT
    iw.mag_kod AS kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod ID,
    nt.nazwa, iw.MAG_SEKCJA Lokalizacja, iw.KOD_TOW, iw.EAN1,
    jm.NAZWA JednostkaMiary, 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr AS oznaczenie, dd.[status] AS st,  dd.kww_user AS usser,
    sum (tv.ILR) ILR, naw.ILOSC_NAW, Sum(tv.ilr * iw.WAGA_N) Waga
    FROM
    gm.DokSPNag z 
    JOIN gm.DokSPPoz tv ON tv.dz_kod=z.dz_kod AND tv.rr=z.rr AND tv.mc=z.mc AND tv.nr=z.nr
    JOIN gm.ktPoz it ON it.mag_kod=tv.mag_kod AND it.SWW_B=tv.SWW_B AND it.SWW_P=tv.SWW_P AND it.SWW_A=tv.SWW_A AND it.SWW_T=tv.SWW_T AND it.PRZYJ_RR=tv.PRZYJ_RR AND it.PRZYJ_NR=tv.PRZYJ_NR
    JOIN gm.ktNag iw ON iw.mag_kod=it.mag_kod AND iw.SWW_B=it.SWW_B AND iw.SWW_P=it.SWW_P AND iw.SWW_A=it.SWW_A AND iw.SWW_T=it.SWW_T AND iw.NAW_KOD=it.NAW_KOD AND iw.JM_KOD=it.JM
    JOIN gm.DefNazwaTow nt ON nt.SWW_B=iw.SWW_B AND nt.SWW_P=iw.SWW_P AND nt.SWW_A=iw.SWW_A AND nt.SWW_T=iw.SWW_T
    JOIN gm.DefJM jm ON jm.JM_KOD=iw.JM_KOD
    JOIN gm.DefNawazka naw ON naw.NAW_KOD=iw.NAW_KOD
    LEFT JOIN KWW_dokument dd ON dd.dz_kod=z.dz_kod AND dd.rr=z.rr AND dd.mc=z.mc AND dd.nr=z.nr

    WHERE
    -- ((z.USRA_KOD is null) or (z.USRA_KOD='')) AND 
    (z.DATAWYST BETWEEN dateadd(day, -10, GETDATE()) AND GETDATE())AND 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr LIKE '%'+'$search'+'%'
    AND (( dd.kww_user='$user') OR ( dd.kww_user is null)) AND ((dd.[status] ='$sta') OR (dd.[status] is null))
    GROUP BY
    iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod,
    nt.nazwa, iw.MAG_SEKCJA, iw.KOD_TOW, iw.EAN1,
    jm.NAZWA, 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr, dd.[status], naw.ILOSC_NAW, dd.kww_user
    ) 
    sub
    GROUP BY sub.oznaczenie, sub.st, sub.usser;";

}else{
    $sql="SELECT sub.oznaczenie AS Numer, COUNT(sub.kod) AS ilosc, sub.st AS sta
    FROM (
    SELECT
    iw.mag_kod AS kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod ID,
    nt.nazwa, iw.MAG_SEKCJA Lokalizacja, iw.KOD_TOW, iw.EAN1,
    jm.NAZWA JednostkaMiary, 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr AS oznaczenie, dd.[status] AS st,  dd.kww_user AS usser,
    sum (tv.ILR) ILR, naw.ILOSC_NAW, Sum(tv.ilr * iw.WAGA_N) Waga
    FROM
    gm.DokSPNag z 
    JOIN gm.DokSPPoz tv ON tv.dz_kod=z.dz_kod AND tv.rr=z.rr AND tv.mc=z.mc AND tv.nr=z.nr
    JOIN gm.ktPoz it ON it.mag_kod=tv.mag_kod AND it.SWW_B=tv.SWW_B AND it.SWW_P=tv.SWW_P AND it.SWW_A=tv.SWW_A AND it.SWW_T=tv.SWW_T AND it.PRZYJ_RR=tv.PRZYJ_RR AND it.PRZYJ_NR=tv.PRZYJ_NR
    JOIN gm.ktNag iw ON iw.mag_kod=it.mag_kod AND iw.SWW_B=it.SWW_B AND iw.SWW_P=it.SWW_P AND iw.SWW_A=it.SWW_A AND iw.SWW_T=it.SWW_T AND iw.NAW_KOD=it.NAW_KOD AND iw.JM_KOD=it.JM
    JOIN gm.DefNazwaTow nt ON nt.SWW_B=iw.SWW_B AND nt.SWW_P=iw.SWW_P AND nt.SWW_A=iw.SWW_A AND nt.SWW_T=iw.SWW_T
    JOIN gm.DefJM jm ON jm.JM_KOD=iw.JM_KOD
    JOIN gm.DefNawazka naw ON naw.NAW_KOD=iw.NAW_KOD
    LEFT JOIN KWW_dokument dd ON dd.dz_kod=z.dz_kod AND dd.rr=z.rr AND dd.mc=z.mc AND dd.nr=z.nr

    WHERE 
    --((z.USRA_KOD is null) or (z.USRA_KOD='')) AND
     (z.DATAWYST BETWEEN dateadd(day, -10, GETDATE()) AND GETDATE())AND 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr LIKE '%'+'$search'+'%'
    AND (( dd.kww_user='$user') OR ( dd.kww_user is null)) AND (dd.[status] ='$sta') 
    GROUP BY
    iw.mag_kod, iw.mag_kod+'-'+iw.sww_b+'-'+iw.sww_p+'-'+iw.sww_a+'-'+iw.sww_t+'-'+iw.naw_kod+'-'+iw.jm_kod,
    nt.nazwa, iw.MAG_SEKCJA, iw.KOD_TOW, iw.EAN1,
    jm.NAZWA, 'SP ' + z.dz_kod + '/' + z.nr + '/' + z.mc + '/' + z.rr, dd.[status], naw.ILOSC_NAW, dd.kww_user
    ) 
    sub
    GROUP BY sub.oznaczenie, sub.st, sub.usser;";
};

$que = db_query($sql);
$answer["zamowienia"] = [];

$i = 0;
while ($result = db_fetch_array($que)) {
    $answer["zamowienia"][$i]['Numer'] = toUTF($result["Numer"]);
    $answer["zamowienia"][$i]['ilosc'] = toUTF($result["ilosc"]);
    if   (toUTF($result["sta"])==0){
        $answer["zamowienia"][$i]['sta'] =  '<svg onclick="searchIn (0,0)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-file-earmark-diff" viewBox="0 0 16 16"> <path d="M8 5a.5.5 0 0 1 .5.5V7H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V8H6a.5.5 0 0 1 0-1h1.5V5.5A.5.5 0 0 1 8 5zm-2.5 6.5A.5.5 0 0 1 6 11h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" fill="#673ab7"></path> <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" fill="#673ab7"></path> </svg>';
        $i++; 
    }
    else if   (toUTF($result["sta"])==1){
        $answer["zamowienia"][$i]['sta'] =  '<svg onclick="searchIn (1,0)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-file-earmark-break" viewBox="0 0 16 16"> <path d="M14 4.5V9h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v7H2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13 12h1v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2h1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-2zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z" fill="#ff9800"></path> </svg>';
        $i++; 
    }
    else if   (toUTF($result["sta"])==2){
        $answer["zamowienia"][$i]['sta'] =  '<svg onclick="searchIn (2,0)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16"> <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" fill="#43a047"></path> <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" fill="#43a047"></path> </svg>';
        $i++; 
    }
    else   {
        $answer["zamowienia"][$i]['sta'] =  '<svg onclick="searchIn (3,0)" style="color: red" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16"> <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" fill="red"></path> <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" fill="red"></path> </svg>';
        $i++; 
    }
};

echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>
