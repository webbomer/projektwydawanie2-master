<?PHP

require "config.php";
//require "funkcje.php";

if ($db_server_type!="ASE") die ("[B³¹d krytyczny] wybrano z³y sterownik bazy danych");

sybase_min_server_severity(11);

$cnn=sybase_connect($db_server_name,$db_server_user,$db_server_passwd,$db_code_page,$db_conn_name,false)
or die("[B³¹d krytyczny] Nie mo¿na nawi¹zaæ po³¹czenia z serwerem baz danych !");

//connection_safe (TRUE, $cnn);

sybase_select_db($db_database_name,$cnn);

function connection_safe ($set_connection, $connection) {
static $conn_safe;
if ($set_connection) {
	$conn_safe = $connection;
}
return $conn_safe;
}

function db_query ($_qry)
{
  require "config.php";  
  $result = sybase_query ($_qry);
  if ($debug) loguj($_qry);
//  $message = sybase_get_last_message();
//  if ($debug) loguj($message);  
  return ($result); 
}

function db_fetch_array ($_result)
{
  $r = sybase_fetch_array ($_result);
  return ($r);
}

function db_num_fields ($_result)
{
  $r = sybase_num_fields ($_result);
  return($r);
}

function db_num_rows ($_result)
{
// removed in PHP7	
  $r = sybase_num_rows ($_result);
  return($r);
}

function db_begin_tran()
{
  $result = db_query ("begin tran");
  return ($result);
}

function db_commit()
{
  $result = db_query ("commit");
  return ($result);
}

function db_rollback()
{
  $result = db_query ("rollback");
  return ($result);
}


function db_close ()
{
global $cnn;
//$cnn = connection_safe (false, null);
sybase_close($cnn);
}

?>