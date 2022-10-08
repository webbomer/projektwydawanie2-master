<?PHP


class Guigen
{
public static $number;


public $uid_len = 14;

  public function get()
  {
	  self::$number++;
	  $defstring = "abcdefghijklmnopqrstuvwxyzABSDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	  $str = base_convert( microtime(true)*10000 + self::$number, 10, 36 );
	  $string2="";

      for ($i=0; $i<=10; $i++) {
        $string2=$string2 . $defstring[rand(0, strlen($defstring)-1)];
      }
//	  return $str.$string2;
	  $tmpstr = strtoupper($str . $string2);
//	  $wynik = $tmpstr. "___" . substr ($tmpstr, 0, 5) . "-" .  substr($tmpstr, 5, 5) . "-" . substr($tmpstr, 10, 4);
	  $wynik = substr($tmpstr, 0, 5) . "-" .  substr($tmpstr, 5, 5) . "-" . substr($tmpstr, 10, 4);

	  return ($wynik);
	  
  }

}

// testy
//$guid = new Guigen();

//for ($q=0; $q<=20; $q++)
//{
//echo $guid->get();
//echo "<br>";
//}


?>