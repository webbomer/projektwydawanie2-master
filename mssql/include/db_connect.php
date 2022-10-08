<?PHP

require "./mssql/config.php";
//require "funkcje.php";

if ($db_server_type=="ASE") include ("db_ase.php");
else if ($db_server_type=="MSSQL") include ("db_mssql.php");
else if ($db_server_type=="ASA") include ("db_asa.php");
else if ($db_server_type=="ODBCASA") include ("db_odbcasa.php");
else
die ("[B��d krytyczny] wybrano z�y sterownik bazy danych");