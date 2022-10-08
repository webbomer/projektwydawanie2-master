<?PHP

//$kod = $_GET['kod'];

class Tgs1parser
{
// what we are expecting
/*
] C1010590717672424015230324101002054676
5907176721768
] C1010590717672176815230515101002066057
] C1010590717671441815230404101002057014
] C1010590764335687515221027102704224614
] C10105907643357841152302201020052219
C101059076433578411523022010200522192
2114102931990
] C1906881362411473125230131200310105688136
] C101040086718119381115110010L847151100
] C101040086718119381115110010L847151100
] C110W0033891
] C1010410177073100515230614
*/

// available use id's
//01 - 14 char lenght id
//15 - short shelf date
//10 - batch number - variable lenght; read only if is as last in string

private $sourcestring;
public $ean;
public $bestbefore;
public $batch;
public $netweight;

public function check_ean (string $kod)
{
    /*
    Referring to: https://www.gs1.org/services/how-calculate-check-digit-manually
    T.Ł. I've been testing only for GTIN13.
    */
    $eanmultiplier[8] = array ( 3, 1, 3, 1, 3, 1, 3 );
    $eanmultiplier[12] = array ( 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3 );
    $eanmultiplier[13] = array ( 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3 );


    $total = 0;
    $source_kod=substr($kod, 0, strlen($kod) - 1);
    
    /*
    echo "<BR>";
    echo "source: $source_kod";
    */
    $len = strlen($kod);
    $len_source_kod = strlen($source_kod);

    for ($i=0; $i<$len_source_kod; $i++)
    {
        $char = $source_kod[$i]+1-1;
        $multiplier = $eanmultiplier[$len][$i];
        $result = $char * $multiplier;
        $total = $total + $result;
    }
    // find nearest equal or greatrer multiple of ten...
    
    $nearest=0;


    $i=0;
    do {
      $nearest = $total +$i;
      if ($nearest % 10 ==0) break;
      $i++;

    } while (true);
    /*
    echo "<BR>";
    echo "nearest: $nearest";
    echo "<BR>";
    echo "total: $total";
    */
    $check_sum = $nearest - $total;

    $new_ean = $source_kod . $check_sum;
    /*
    echo "<br>";
    echo "new_ean: $new_ean";
    echo "<br>";
    if ($kod == $new_ean) 
     echo "Success provided code is valid GTIN";
     else echo "Privided code is not valid GTIN";
    */
    if ($kod == $new_ean) 
    return true;
    else return false;
}

public function clean_ean(string $kod)
{
    $clean = '';
    for ($i=0; $i<strlen($kod); $i++)
    {
        if ($kod[$i]!='0')
        {
            $clean = substr ($kod, $i, strlen($kod)-$i);
            break;
        }
    }
    return ($clean);
}

public function parse(string $kod)
{
    
    $ean128 = false;
    $this->ean="";
    $this->batch="";
    $this->bestbefore="";

    if ( (substr($kod, 0, 4) == '] C1') || (substr($kod, 0, 2)=='01') ) $ean128 = true;

    if (!$ean128) {
        if ($this->check_ean($kod)) 
        $this->ean = $kod; else throw new Exception('Invalid EAN code');
        return;
    }

    if  (substr($kod, 0, 4) == '] C1')
    $tmp_code = substr($kod, 4, strlen($kod)-4 );
    else $tmp_code = $kod;
    
   // echo $tmp_code;
    

   $l=0;
    
    do
    {
        $prefix = substr($tmp_code, 0, 2);
        
            //echo "<br>";
            //echo $prefix;
            //echo "<br>";
    
            
        if ($prefix == '01') {
            
            //echo "<br>";
            //echo "tmp_code". $tmp_code;
            //echo "<br>";

            $tmp_ean = substr ($tmp_code, 2, 14);
            $tmp_code = substr ($tmp_code, 16, strlen($tmp_code)-16);
            
            //echo "<br>";
            //echo "tmp_code". $tmp_code;
            //echo "<br>";
            
        
            //echo "tmp_ean".$tmp_ean;
            //echo "<br>";

            $clean = $this->clean_ean($tmp_ean);
            /*
            echo "<br>";
            echo $clean;
            */
            if ($this->check_ean ($clean)) $this->ean = $clean; else throw new Exception('Invalid EAN code');
        }
        /*
        So, we parsed just first purpose id
        */
        if ($prefix == '15') {
            $tmp_ean = substr ($tmp_code, 2, 6);
            $tmp_code = substr ($tmp_code, 8, strlen($tmp_code)-8);
            /*
            echo "<br>";
            echo $tmp_code;
            echo "<br>";
            
        
            echo $tmp_ean;
            */
            
            /*
            echo "<br>";
            echo $clean;
            */
            $this->bestbefore = $tmp_ean;
        }
        if ($prefix == '31') {
            $tmp_ean = substr ($tmp_code, 4, 6);
            $tmp_code = substr ($tmp_code, 10, strlen($tmp_code)-10);
            /*
            echo "<br>";
            echo $tmp_code;
            echo "<br>";
            
        
            echo $tmp_ean;
            */
            
            /*
            echo "<br>";
            echo $clean;
            */
            $this->netweight = $tmp_ean;
        }

        if ($prefix == '10') {
            $tmp_ean = substr ($tmp_code, 2, strlen($tmp_code)-2);
            $tmp_code = "";
            /*
            echo "<br>";
            echo $tmp_code;
            echo "<br>";
            
        
            echo $tmp_ean;
            */
            
            /*
            echo "<br>";
            echo $clean;
            */
            $this->batch = $tmp_ean;
        }
        $l++;
        if ($l > 4) break;
    } while ($tmp_code!="");
    }

}

$p = new Tgs1parser;
// $p->parse('] C1010590717672424015230324101002054676');

// echo $p->ean;
// echo "<br>";
// echo $p->bestbefore;
// echo "<br>";
// echo $p->batch;
// echo "<br>";
         //  C1010590717672424015230324101002054676
// $p->parse('] C1010731905385030631020020001523050710327038');

// echo $p->ean;
// echo "<br>";
// echo $p->bestbefore;
// echo "<br>";
// echo $p->batch;
// echo "<br>";

$p->parse('010590717671490615230915101002091247');


// 3102

// echo $p->ean;
// echo "<br>";
// echo $p->bestbefore;
// echo "<br>";
// echo $p->batch;
// echo "<br>";

// $p->parse('] C1010731905325114131020012501523061310322285');

// echo $p->ean;
// echo "<br>";
// echo $p->bestbefore;
// echo "<br>";
// echo $p->batch;
// echo "<br>";



//$p->parse($kod); 

// $p->parse('5900490000311');
// echo $p->ean;
// echo "<br>";
// echo $p->batch;
// echo "<br>";
// WRONG ONE !!! comment if you want to suppress error.
//$p->parse('1122334455668');
//echo $p->ean;
$answer["zamowienia"]=[];
$answer["zamowienia"]=$p;

echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
