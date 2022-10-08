<?PHP

function resultToTableFormat ($result, $fieldNamesArray, $buttonsArray)
{
  require "config.php";
  $outputstr="";
  class typyPol {
    var $name;
    var $type;
    }

    $numFields=db_num_fields($result);
    $field_names = Array($numFields);
    $field_type = Array ($numFields);   
    
    if (($db_server_type=="MSSQL"))
    {
          $f=0;
      foreach( sqlsrv_field_metadata( $result ) as $fieldMetadata ) {
  /*
  Datetime 93
  Binary -2
  Decimal 3
  Float 6
  Int 4
  Real 7
  Text -1
  Time -154
  Varchar 12
  */
  
        $info = new typyPol();
        $info -> name = $fieldMetadata["Name"];
        if ($fieldMetadata["Type"]==93) $info -> type = 'datetime';
        else if ($fieldMetadata["Type"]==3) $info -> type = 'decimal';
        else if ($fieldMetadata["Type"]==6) $info -> type = 'float';
        else if ($fieldMetadata["Type"]==4) $info -> type = 'int';
        else if ($fieldMetadata["Type"]==7) $info -> type = 'real';
          else if ($fieldMetadata["Type"]==12) $info -> type = 'varchar';
        else $info -> type = 'unknown';
        $field_names[$f] = $info -> name;
        $field_types[$f] = $info -> type;
        $f++;
      } 
    } 

    if (is_array($fieldNamesArray))
    {
      $i=0;
      foreach ($fieldNamesArray as $value)
      {
        $field_names[$i] = $value;
        $i++;
      }
    }
    
echo "<Table class='striped' id='".$buttonsArray[0]["tableid"]."'>\n";
echo "<tr>\n";

foreach ($field_names as $value)
{
    echo "<th>".$value."</th>\n";
}
echo "</tr><tr>\n";


while ($r = db_fetch_array($result)) {
    for ($i=0; $i<=$numFields-1; $i++)
    {
      echo "<td>";
      if ($field_types[$i]!='datetime')
      {echo "$r[$i]";}
      else 
      {echo date_format($r[$i], 'Y-m-d');}
      foreach ($buttonsArray as $buttons)
      {
        if ($buttons["index"]==$i)
        {
          //echo "<input type = ".$buttons["type"]." value='".$buttons["value"]."'>";
          echo "<a class='btn-floating btn-large waves-effect waves-light blue' id='".$r[$buttons["id"]]."' onclick='".$buttons["onclick"].$r[$buttons["id"]]."\")' ><i class='material-icons'>edit</i></a>";
        }
      } 
      echo "</td>";
    }
    echo "</tr><tr>";
    
   // print_r($r);
}
echo "</tr>";
echo "</Table>\n";
} // resultToTableFormat


function resultToTable ($result)
{
  require "config.php";
  $outputstr="";
  class typyPol {
    var $name;
    var $type;
    }

    $numFields=db_num_fields($result);
    $field_names = Array($numFields);
    $field_type = Array ($numFields);   
    
    if (($db_server_type=="MSSQL"))
    {
          $f=0;
      foreach( sqlsrv_field_metadata( $result ) as $fieldMetadata ) {

  
        $info = new typyPol();
        $info -> name = $fieldMetadata["Name"];
        if ($fieldMetadata["Type"]==93) $info -> type = 'datetime';
        else if ($fieldMetadata["Type"]==3) $info -> type = 'decimal';
        else if ($fieldMetadata["Type"]==6) $info -> type = 'float';
        else if ($fieldMetadata["Type"]==4) $info -> type = 'int';
        else if ($fieldMetadata["Type"]==7) $info -> type = 'real';
          else if ($fieldMetadata["Type"]==12) $info -> type = 'varchar';
        else $info -> type = 'unknown';
        $field_names[$f] = $info -> name;
        $field_types[$f] = $info -> type;
        $f++;
      } 
    } 

echo "<Table>\n";
echo "<tr>\n";

foreach ($field_names as $value)
{
    echo "<th>".$value."</th>\n";
}
echo "</tr><tr>\n";

while ($r = db_fetch_array($result)) {
    for ($i=0; $i<=$numFields-1; $i++)
    {
      echo "<td>";
      if ($field_types[$i]!='datetime')
      {echo "$r[$i]";}
      else 
      {echo date_format($r[$i], 'Y-m-d');}
      echo "</td>";
    }
    echo "</tr><tr>";
    
   // print_r($r);
}
echo "</tr>";
echo "</Table>\n";
} // resultToTable


function toUTF($text)
{
  $trans = iconv ("cp1250//TRANSLIT//IGNORE","utf-8",$text);
  return ($trans);
}

function toCP1250($text)
{
  $trans = iconv ("utf-8","cp1250//TRANSLIT//IGNORE",$text);
  return ($trans);
}

function pl_number_int ($zmienna)
{
	return (number_format ($zmienna,0,',',' '));
}

function naglowkiUTF ()
{
  $CRLF = "\r\n";
  echo '<head>'.$CRLF;
  echo '<meta charset="utf-8">'.$CRLF;
  echo '<!--Import Google Icon Font-->'.$CRLF;
  echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">'.$CRLF;
  echo '<!--Import materialize.css-->'.$CRLF;
  echo '<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>'.$CRLF;
  echo '<!--Let browser know website is optimized for mobile-->'.$CRLF;
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>'.$CRLF;
  echo '<link type="text/css" rel="stylesheet" href="css/style.css">'.$CRLF;
  echo '<!--Import jQuery before materialize.js-->'.$CRLF;

  echo '<link rel="stylesheet" type="text/css" href="css/dataTables.min.css">'.$CRLF;
//  echo '<link rel="stylesheet" type="text/css" href="css/jquery.treetable.css" />'.$CRLF;
//  echo '<link rel="stylesheet" type="text/css" href="css/treeTable.dataTables.css">'.$CRLF;

  echo '<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>'.$CRLF;

  
  echo '  <script type="text/javascript" language="javascript" src="js/dataTables.min.js"></script>'.$CRLF;
//  echo '<script type="text/javascript" language="javascript" src="js/jquery.treetable.js"></script>'.$CRLF;
//  echo '      <script type="text/javascript" language="javascript" src="js/dataTables.treeTable.js"></script> '.$CRLF;

  echo '      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>'.$CRLF;

  echo '</head>'.$CRLF;
}

function polskaData($text)
{
  for ($i=0; $i<strlen($text);$i++)
  {
    if ($text[$i]==".") {$text[$i]="-";}  
  }
  return($text);
}


// function loguj($tekst)
// {
// require "config.php";
// if ( isset ($_GET["login"]) ) { $login=$_GET["login"]; } else {$login='';}
// $koniecLinii=chr(13).chr(10);
// $f = fopen($path."log.txt", "a");
// $today = date("Y-m-d H:i:s");
// fwrite($f, $login." ".$today." ".$tekst.$koniecLinii);
// fclose($f);
// }


?>