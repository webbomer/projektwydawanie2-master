<?PHP

require "config.php";
//require "funkcje.php";

if ($db_server_type!="ODBCASA") die ("[B³¹d krytyczny] wybrano z³y sterownik bazy danych");

  $connect_string = "Driver={Adaptive Server Anywhere 9.0};".
                    "CommLinks=tcpip(Host=$db_host);".
                    "ServerName=$db_server_name;".
                    "DatabaseName=$db_database_name;".
                    "DatabaseFile=$db_file;".
                    "ConnectionName=$db_conn_name;".
					"CharSet=$db_code_page;".
                    "uid=$db_server_user;pwd=$db_server_passwd";
					
//echo $connect_string;

$cnn=odbc_connect($connect_string,'','')
or die("[B³¹d krytyczny] Nie mo¿na nawi¹zaæ po³¹czenia z serwerem baz danych !");

//odbc_autocommit($cnn, FALSE);

function db_query ($_qry)
{
  require "config.php";  
  global $cnn;
  $result = odbc_exec ($cnn ,$_qry);
  if ($debug) loguj($_qry);
//  $message = sybase_get_last_message();
//  if ($debug) loguj($message);  
  return ($result); 
}

function db_fetch_array ($_result)
{
  $r = odbc_fetch_array ($_result);
  if ($r)
  {
    $num = odbc_num_fields ( $_result );
    for ($i=1; $i<= $num; $i++)
    {
      $name = odbc_field_name ($_result, $i);
  	  $type = odbc_field_type ($_result, $i);
	  if (($type=="numeric" || $type=="decimal") && !is_null($r[$name]) ) $r[$name] = $r[$name]+1-1;
	  if ($type=="timestamp" && !is_null($r[$name]) ) $r[$name] = substr($r[$name], 0, 19);
//	  if ($type="varchar") {
//	  echo "name=$name";
//	  echo "type=$type";
//	  $val=toUTF($r[$name]);
//	  echo "val=$val";
//	  echo "<BR>";
//	  }
    }
  }

  return ($r);
}

function db_num_fields ($_result)
{
  $r = odbc_num_fields ($_result);
  return($r);
}

function db_num_rows ($_result)
{
	//mo¿e zwracaæ -1, wówczas nale¿y pos³u¿yæ siê count
  $r = odbc_num_rows ($_result);
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
odbc_close($cnn);
}

?>