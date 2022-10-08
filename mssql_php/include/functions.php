<?PHP


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
  echo "<!DOCTYPE html>\n";
  echo "<html lang=\"pl-PL\">\n";
  echo "<head>\n";
  echo "<meta charset=\"UTF-8\">\n";
  echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />\n";
  echo "<link rel=\"stylesheet\" href=\"help.css\" type=\"text/css\" />";  
  echo "</head>\n";
}

function polskaData($text)
{
  for ($i=0; $i<strlen($text);$i++)
  {
    if ($text[$i]==".") {$text[$i]="-";}  
  }
  return($text);
}

function simpleDate ($DateObj){
//    echo "<BR><BR>";
//    var_dump($DateObj);
//    print_r($DateObj);
//    echo $DateObj->format('c');
//    echo "<BR><BR>";
    $smplDate = new DateTime();
 //   $smplDate = $DateObj->date;
    $smplDate = $DateObj->format('c');
//    echo "<BR><BR>";
//    echo $smplDate;
//    echo "<BR><BR>";
    $smplDate=substr($smplDate,0,10); 
    return ($smplDate);
}

function simpleDateTime ($DateObj){
  //    echo "<BR><BR>";
  //    var_dump($DateObj);
  //    print_r($DateObj);
  //    echo $DateObj->format('c');
  //    echo "<BR><BR>";
      $smplDate = new DateTime();
   //   $smplDate = $DateObj->date;
      $smplDate = $DateObj->format('Y-m-d H:i:s');
  //    echo "<BR><BR>";
  //    echo $smplDate;
  //    echo "<BR><BR>";
  //    $smplDate=substr($smplDate,0,10); 
      return ($smplDate);
  }
  
function usunZleZnaki($text) {
	
//$text = htmlentities($text, ENT_QUOTES, "UTF-8");
	
$text=str_replace('"', '&quot;', $text);
$text=str_replace("'", '&apos;', $text);
$text=str_replace("<", '&lt;', $text);
$text=str_replace("'", '&gt;', $text);

return($text);
}

function usunZleZnakiUTF($text) {
	
$text = htmlentities($text, ENT_QUOTES, "UTF-8");
	
//$text=str_replace('"', '&quot;', $text);
//$text=str_replace("'", '&apos;', $text);
//$text=str_replace("<", '&lt;', $text);
//$text=str_replace("'", '&gt;', $text);

return($text);
}


function loguj($tekst)
{
require "../mssql/config.php";
if ( isset ($_GET["login"]) ) { $login=$_GET["login"]; } else {$login='';}
$koniecLinii=chr(13).chr(10);
$f = fopen($path."log.txt", "a");
date_default_timezone_set('Europe/Warsaw');
$today = date("Y-m-d H:i:s");
fwrite($f, $login." ".$today." ".$tekst.$koniecLinii);
fclose($f);
}