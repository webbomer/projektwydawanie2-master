<?php
        session_start();
        if (isset($_SESSION['user'])){
            $user=$_SESSION['user'];
        } else header("location:users.php");

    ?>
<!DOCTYPE html>
<html lang="pl">

<head>
<!-- Kompletacja i Weryfikacja Wydań -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Weryfikacji</title>
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <script src="./js/jquery-3.5.1.js"defer></script>
    <script src="./js/loadOrder.js"defer></script>
    <script src="./js/scripts.js"defer></script>
    <script src="./js/update.js"defer></script>
    <script src="./js/search.js"defer></script>
    <script src="./js/zmiany.js"defer></script>

    <script src="./js/materialize.min.js"defer></script>
    <script src="./js/materialize.js"defer></script>

    <script type="text/javascript">
    // $(document).ready(function() {
    //     $(window).keydown(function(event){
    //         if(event.keyCode == 13) {
    //             event.preventDefault();
    //             return false;
    //         }
    //         if(event.keyCode == 176) {
    //             event.preventDefault();
    //             return false;
    //         }
    //     });
    //     $(function() {
    //         $("table").submit(function() { return false; });
    //     });
    // });
    </script>
    
  

        <!-- <script  type = "text/javascript"defer>
            
        Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        
    <link rel="stylesheet" href="./css/style.css">


</head>
    <body>
    <!-- <div id="preloader" style="position: fixed; top:0; left:0; right:0; bottom:0; z-index: 99; background-color:#fff;">Trwa ładowanie strony...</div> -->
        <a id="prelouderoo" >
            <i><img id="klepsydra" src="./img/ikona-205.png"> </img></i> 
        </a>

        <div id ="dataToServerStatus" style="display:none">
            <input id="użytkownik" value='<?php echo $user?>'></input>
            <input id="searchStatusView" value='44'></input>
            <input id="datachange" value='0'></input>
            <input id="anulowanieZamówieniaonoff" value='0'></input>

            <input id="autoScan_AllInOneDIVonoff" value='0'></input>
            <input id="autoScan_AllInOneDataDIVonoff" value='0'></input>
            <input id="daneDoPrzywroceniaDoZamówienia" value=''></input>

        </div>
        <div id="autoScan_AllInOneDataTabelevv" style="display:none">
            <!-- <input id="eanDataKODV" value=''></input>
            <input id="datachange" value=''></input> -->
        </div>

        
        <div  style="background-color:#c7802e; height:60px; border: none; width: 100%;">
            <svg onclick="PokazUkryjTekst()" style=" position: absolute;left:3px;top:2px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-ui-checks-grid" viewBox="0 0 16 16"> <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z" fill="#ffffff"></path> </svg>

            <div id="ustawienia"   onclick=""  style=" display:none position: absolute; top:-5px; left:17%;">  <img style="display:none" src="./img/ikona-123.png" width="70" height="60"> </img>
                </div>

            <svg  id="szukanieWTabeli"   onclick="PokazUkryjSzukanie()"  style=" position: absolute; top:10px; left:59%; color: #f3da35;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" fill="white"></path> </svg>

            <svg id="autoScan_AllInOne" onclick="autoScan_AllInOneonoff()" style=" position: absolute; top:6px; left:65px; display:none;" xmlns="http://www.w3.org/2000/svg" width="45" height="45"  viewBox="0 0 24 24"><path d="M7,3H4v3H2V1h5V3z M22,6V1h-5v2h3v3H22z M7,21H4v-3H2v5h5V21z M20,18v3h-3v2h5v-5H20z M19,18c0,1.1-0.9,2-2,2H7 c-1.1,0-2-0.9-2-2V6c0-1.1,0.9-2,2-2h10c1.1,0,2,0.9,2,2V18z M15,8H9v2h6V8z M15,11H9v2h6V11z M15,14H9v2h6V14z" fill="white"></path></svg>
            
            <div  id="pokazUkryjZrobione"   onclick="pokazUkryjZrobioneF()"  style="position:absolute; display:none; top:8px; right:130px; ">  <img src="./img/ikona-42.png" width="52" height="45"> </img></div> 

            <div  id="zływyburzamówienia"   onclick="zanulowanieZamówieniaonoff()"  style=" position: absolute; top:8px; right:70px; display:none;">  <img src="./img/ikona-196.png" width="45" height="45"> </img></div>
                    
            <a href="wylogowywanie.php">
                <img style=" position: absolute;right:5px;top:5px"  src="./img/ikona-204.png" width="47" height="50"> </img>
            </a>
                        
        </div>
        <div id="seachIconViev" style=display:none>
            <a id=choseData> 
                <svg onclick="schowCalendary()" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16"> <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" fill="#72415d"></path> <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" fill="#555554"></path> </svg>
            </a>
            <svg onclick="searchIn(44,0)" style="color: rgb(33, 148, 242);" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16"> <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" fill="#555554"></path> </svg>                     
            <svg onclick="searchIn(0,0)" style="color: #4caf50" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark-diff" viewBox="0 0 16 16"> <path d="M8 5a.5.5 0 0 1 .5.5V7H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V8H6a.5.5 0 0 1 0-1h1.5V5.5A.5.5 0 0 1 8 5zm-2.5 6.5A.5.5 0 0 1 6 11h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" fill="#72415d"></path> <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" fill="#72415d"></path> </svg>
            <svg onclick="searchIn(1,0)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark-break" viewBox="0 0 16 16"> <path d="M14 4.5V9h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v7H2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13 12h1v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2h1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-2zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z" fill="#c7802e"></path> </svg>                       
            <svg onclick="searchIn(2,0)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16"> <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" fill="#4caf50"></path> <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" fill="#43a047 "></path> </svg>                
            <svg onclick="searchIn(3,0)" style="color: red" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16"> <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" fill="red"></path> <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" fill="red"></path> </svg>

            <div id="calendarySchow" style ="display:none" >
                od <input id="mcP"  type="date" class="datainut_calendary" style="width:140px;"> </input>
                            
                do <input id="mcK" value='' type="date" class="datainut_calendary" style="width:140px;"> </input>
                            
                <input id="dataSearchonoff" value='' type="checkbox" style="width:200px;" value="1"> </input>
                <span>własny zakres</span>
            </div>
        </div>
        <div id="anulowanieZamówienia" style="background-color:#c7802e; display:none">
                Brak ostatnio przeglądanych zamówień
        </div>
    </nav> 
        <div id="autoScan_AllInOneDIV" style="display:none">
            <table>
                <TD style="height:80px; width:70px; padding:0px;">
                    <a >
                        <svg  onclick="autoScan_AllInOneonoff()"  xmlns="http://www.w3.org/2000/svg" width="45" height="45"  viewBox="0 0 24 24"><path d="M7,3H4v3H2V1h5V3z M22,6V1h-5v2h3v3H22z M7,21H4v-3H2v5h5V21z M20,18v3h-3v2h5v-5H20z M19,18c0,1.1-0.9,2-2,2H7 c-1.1,0-2-0.9-2-2V6c0-1.1,0.9-2,2-2h10c1.1,0,2,0.9,2,2V18z M15,8H9v2h6V8z M15,11H9v2h6V11z M15,14H9v2h6V14z" fill="white"></path></svg>

                        <!-- <img style=" right:10px;top:-5px"  src="./img/ikona-203.png" width="80" height="70"> </img> -->
                    </a>
                </TD>
                <td style="padding:2px; height:60px;">
                    <input id="autoScan_AllInOneINPUT" type="" autocomplete="off" placeholder=" ">
                    </imput>
                    
                    <label  for="autoScan_AllInOneINPUT" id="labelautoScan_AllInOneINPUT"> Dodaj <svg style="color: #f3da35; position: : absolute;right:-105px;top:-1px" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16"> <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" fill="#fcddc4"></path> </svg> </label>
                </td>
                <td onclick=autoScanInputData() style="height:80px; width:70px; padding:0px;">
                    <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16"> <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" fill="white"></path> </svg>
                </td>
            </table>
        </div>
         
         
            
        <h4 id=viewOrderList  ><h4>
            
       

        <div id="seachIcon">
            
                <input id="szukaj" name="szukaj" type="" autocomplete="off" placeholder=" "></imput>
                <label for="szukaj" id="labelSzukaj"> szukaj <svg style="color: #f3da35; position: : absolute;right:-105px;top:-1px" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16"> <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" fill="#fcddc4"></path> </svg>
                </label>
                <img id="lupa" for="szukaj" onclick="searchIn(22,1)"   src="./img/ikona-41.png" width="90" height="80"> </img>                           
               
            
        </div>
        
        </h4>
            <table id="orderList">
               
                <tr >    
                    <th style="text-align: center;">Lp</th>
                    <th  style="">Numer</th>
                    <th style="text-align: center;"><svg style=" position: relative; top:4px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-numbers" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M11 6h9" /> <path d="M11 12h9" /> <path d="M12 18h8" /> <path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" /> <path d="M6 10v-6l-2 2" /> </svg>
                        </th>
                    <th style="text-align: center;"> stan </th>
                </tr>

            </table> 
  
            <h3 id="viewOrder" class="header" style ="display:none"> </h3>
            
        <table id="autoEanDataTable" style="display:none">
            <tr>
                <th style="padding:0px; width:70px">Lp</th>
                <th style="width:70px;">usuń</th>
                <th style="padding:0px">nr.partii</th>
                <th style="width:70px">edytuj</th>
                <th style="padding:0px; width:70px">il.op.+</th> 
            </tr>
            <tr>
                <th colspan="5" style=" background-color: #c7802e; color:#eae9ea;">         nazwa </th>
            </tr>        
            <tr class=daneDoskanu4 id="brakDanych">
                <th colspan="5"> brak</th>
            </tr>
        </table>

            <table id="order" style="display:none">

                <thead>
                    <tr>
                        <th style="padding:0px; width:10px">Lp</th>
                        <th style="width: 10%;">mag.</th>
                        <th style="padding:0px">Lokalizacja</th>
                        <th>KOD Tow.</th>
                        <!-- <th style="padding:0px">il.op.</th> -->
                    </tr>
                    <tr>
                        <th colspan="4" style=" background-color: #c7802e; color:#eae9ea;">         nazwa </th>
                    </tr>
                </thead>    
            
            
           
            </table> 
            <a id="fixed-action-btn-viev2" class="fixed_buton_on_auto_raport"  style ="display:none; margin-left:auto;
    margin-right:auto; " onclick="generujraport()">
                 <svg id="OK_raport" style="margin-left:auto;
    margin-right:auto; position:relative; left:110px " xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16"> <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" fill="white"></path> </svg>
        
            </a>
        </div>

        <script type="text/javascript" >
$(window).load(function() {
  $('#prelouderoo').fadeOut();
});
</script>


// <script type="text/javascript">
// $(window).load(function() {
//   $('#preloader').fadeOut();
// }
 </script>

    </body>
</html>