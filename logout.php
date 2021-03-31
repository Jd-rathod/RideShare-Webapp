<?php
session_start();
if($_SESSION["loggedin"])
{
    $id=$_SESSION['id'];
    require_once "config.php";
    $q="update rider set stat='off' where rider_id='$id'";
    $s=oci_parse($c,$q);
    if($s)
    {
        $r=oci_execute($s);
        if(!$r)
        {
            echo "error occured!";
        }
    }
}
$_SESSION["loggedin"]=false;
session_destroy($_SESSION["id"]);
header('location: home.php');
?>