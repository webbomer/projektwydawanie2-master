<?PHP
/*
**   W wersji PHP 5.3 dzia³a z Anywhere >= 11
**   W wersji PHP 5.1 i 4 dzia³a z Anywhere >= 10
*/

require "config.php";
//require "funkcje.php";

if ($db_server_type!="ASA") die ("[B³¹d krytyczny] wybrano z³y sterownik bazy danych");

$cnn = sasql_connect( "UID=DBA;PWD=sql" )
or die("[B³¹d krytyczny] Nie mo¿na nawi¹zaæ po³¹czenia z serwerem baz danych !");

sasql_set_option( $cnn, "auto_commit", "off" );

function db_query ($_qry)
{
  require "config.php";  
  global $cnn;
  $result = sasql_query ($cnn, $_qry);
  if ($debug) loguj($_qry);
//  $message = sybase_get_last_message();
//  if ($debug) loguj($message);  
  return ($result); 
}

function db_fetch_array ($_result)
{
  $r =  sasql_fetch_array ($_result);
  return ($r);
}

function db_num_fields ($_result)
{
  $r = sasql_num_fields ($_result);
  return($r);
}

function db_num_rows ($_result)
{
  $r = sasql_num_rows ($_result);
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
sasql_close($cnn);
}

?>