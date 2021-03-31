<?php
session_start();
$user_id=$_SESSION["id"];
include_once("config.php");
if($_GET["vehicle_id"])
{
    $vehicle_id=$_GET["vehicle_id"];
    //get the logged in user here 
    $q1="update rider set current_veh='$vehicle_id'  where rider_id='$user_id'";

    $s1=oci_parse($c,$q1);
        
    if(!$s1)
    {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r=oci_execute($s1);
    if(!$r){
    $m = oci_error($s1);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }



}
header("Location:user_account.php");
echo '<script>alert("Changed Current Vehicle Successfully!")</script>';
exit();
?>