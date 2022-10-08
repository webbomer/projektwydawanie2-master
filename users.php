<?php
        session_start();
        if (isset($_SESSION['user'])) {
            header("location:index.php");
        };
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/stylelogin.css">
    <script src="./js/materialize.min.js"defer></script>
    <script src="./js/materialize.js"defer></script> 
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <script type="text/javascript">
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;

            }
            if(event.keyCode == 176) {
                event.preventDefault();
                return false;

            }
        });
        $(function() {
            //$("table").submit(function() { return false; });
        });
    });
    </script>
</head>
<body>
    <form method="post" action="logowanie.php">
        <div id="logowanieTabela" style="  align-items: center;  ">    
            <div id="centrowanie">
            <div><img id="iconLogin" src="./img/Obraz5.gif" alt="">
            </div>
            <div id="dataIntabelaLogin">
            <div id="ldaprdndiv">
                <svg id="ldaprdnicon" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="25" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"> <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill="#72415d"></path> </svg>
                <div>
                    <input id="ldaprdn" type="text" name="ldaprdn" autocomplete="off" placeholder=" "></imput>
                    <label for="ldaprdn" id="labelLogin"> login</label>
                </div>
            </div>

            <div>
                <div id="ldappassdiv">
                    <svg id="ldappassicon"style="color: blue" xmlns="http://www.w3.org/2000/svg" width="25" height="40" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M17,9V7c0-2.8-2.2-5-5-5S7,4.2,7,7v2c-1.7,0-3,1.3-3,3v7c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3v-7C20,10.3,18.7,9,17,9z M9,7c0-1.7,1.3-3,3-3s3,1.3,3,3v2H9V7z M13.1,15.5c0,0-0.1,0.1-0.1,0.1V17c0,0.6-0.4,1-1,1s-1-0.4-1-1v-1.4c-0.6-0.6-0.7-1.5-0.1-2.1c0.6-0.6,1.5-0.7,2.1-0.1C13.6,13.9,13.7,14.9,13.1,15.5z" fill="#72415d"></path></svg>
                    <input id="ldappass" type="password" name="ldappass" autocomplete="off" placeholder=" ">
                    </imput>
                    <label for="ldappass" id="labelHasło"> hasło</label>
                </div>
            </div>
    </div>
            </div>          
                <input id="zalogujTabela" type="submit" value="zaloguj"></input>
        </div>
    </form>

</body>
</html>