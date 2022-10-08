<?php
         session_start();
         if (isset($_SESSION['user'])){

         } else header("location:users.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./js/search.js"defer></script>
    <link rel="stylesheet" href="./css/style.css">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

</head>
<body>
    
        <table style="width: 350px; margin-left: auto; margin-right: auto; border: 1px solid #000;">    
            <td colspan="3"><img id="iconLogin" src="./img/cl_agart-220x140.webp" alt=""></td>
            
            <tr>
                <td><svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16"> <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" fill="blue"></path> <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" fill="blue"></path> </svg></td>
                <td>miesiąc</td>
                <td>rok</td>
            </tr>
            <tr>
                <td>od</td>
                <td><input id="$mc.p" type="number" name="mc.p"></input></td>
                <td><input id="$rr.p" type="number" name="mc.p"></input></td>
            </tr>
            <tr>
                <td>do</td>
                <td><input id="$mc.k" type="number" name="mc.p" ></input></td>
                <td><input id="$rr.k" type="number" name="mc.p" ></input></td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" value="zmień" onclick="dataSchereSpectrum ()" action="index.php";></imput></td>
            </tr>
        </table>
    
</body>
</html>