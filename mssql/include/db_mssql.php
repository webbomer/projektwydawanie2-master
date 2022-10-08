<?PHP

// Trzeba zmieni� nazw� php_pdo_sqlsrv_53_ts_vc9.dll na php_mssql.dll, po tym jak zostanie to zainstalowane
// w katalogu: C:\xampp\bin\php\php5.3.10\ext z instalki: SQLSRV20.EXE
// 2017-08-14 Przepisa�em funkcje na w�a�ciwe SQLServerowi
// error_reporting(E_COMPILE_ERROR);
require "./mssql/config.php";
//require "funkcje.php";

if ($db_server_type != "MSSQL") die("[B��d krytyczny] wybrano z�y sterownik bazy danych");

//$serverName = "adres_serwera_mssql, numer_portu";

//$connectionInfo = array( "Database"=>"nazwa_bazy_danych",
//                         "UID"=>"nazwa_uzytkownika_bazy_danych",
//                         "PWD"=>"haslo");

//$conn = sqlsrv_connect( $serverName, $connectionInfo);


//sybase_min_server_severity(11);
//SQLSRV_ENC_CHAR || UTF-8
$connectionInfo = array("Database" => $db_database_name, "UID" => $db_server_user, "PWD" => $db_server_passwd);
//$connectionInfo = array( "Database"=>$db_database_name, "UID"=>$db_server_user, "PWD"=>$db_server_passwd, "CharacterSet"=>'UTF-8');

//$connectionInfo = array( "Database"=>$db_database_name);

$cnn = sqlsrv_connect($db_server_name, $connectionInfo)
  or die(print_r(sqlsrv_errors(), true));
//("[B��d krytyczny] Nie mo�na nawi�za� po��czenia z serwerem baz danych !");

//sybase_select_db($db_database_name,$cnn);

function db_query($_qry)
{
  require "./mssql/config.php";
  global $cnn;
  $result = sqlsrv_query($cnn, $_qry);
  if ($debug) loguj($_qry);
  //  $message = sybase_get_last_message();
  //  if ($debug) loguj($message);  
  return ($result);
}

function db_fetch_array($_result)
{
  $r = sqlsrv_fetch_array($_result, SQLSRV_FETCH_BOTH);
  return ($r);
}

function db_num_fields($_result)
{
  $r = sqlsrv_num_fields($_result);
  return ($r);
}

function db_num_rows($_result)
{
  // removed in PHP7	
  $r = sqlsrv_num_rows($_result);
  return ($r);
}

function db_begin_tran()
{
  global $cnn;
  $result = sqlsrv_begin_transaction($cnn);
  return ($result);
}

function db_commit()
{
  global $cnn;
  $result = sqlsrv_commit($cnn);
  return ($result);
}

function db_rollback()
{
  global $cnn;
  $result = sqlsrv_rollback($cnn);
  return ($result);
}


function db_close()
{
  global $cnn;
  sqlsrv_close($cnn);
}