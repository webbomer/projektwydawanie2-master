<?php
session_start();
// using ldap bind
$ldaprdn  = $_POST["ldaprdn"];     // ldap rdn or dn
$ldappass = $_POST["ldappass"];  // associated password

//$ldaprdn='pzywert';
// $ldappass = 'Az0459-xs'; 

// $_SESSION['user']=$ldaprdn;
// header("location:index.php");

if (!empty($ldaprdn)){
    $ldaprdn ="dawnfoods\ " . $ldaprdn;
    $ldaprdn = str_replace(' ' , '', $ldaprdn);
}else{
    $ldaprdn ="fdgggggdfgfdgfd";
}
if (empty($ldappass)){
    $ldappass = 'Az04ddddddd59-xs';
}

$ldapconn = ldap_connect("ldap://pozdstdc02")
    or die("Could not connect to LDAP server.");
if ($ldapconn) {
        // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
        // verify binding
    if (($ldapbind)&&((!empty($ldaprdn))||(!empty($ldappass)))) {
        echo "LDAP bind successful :)";
        $_SESSION['user']=$ldaprdn;
         header("location:index.php");
    } else {
        echo "LDAP bind failed :(";
         header("location:users.php");
    }
}  


?>
   
