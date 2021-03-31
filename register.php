<?php
 
session_start();
$_SESSION["loggedin"]=false;
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "config.php";

$query = "select * from user_info where user_id=:name";
 
$s = oci_parse($c, $query);
oci_bind_by_name($s,':name',$_POST["usrid"]);
if (!$s) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r = oci_execute($s);
if(!$r){
    $m = oci_error($s);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
else{
    if ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
    {   $msg= "User_Id already exists!";
        $_SESSION["msg"]=$msg;
        header('location: signup.php');}
    else
    {
        $q1="insert into user_info(user_id,phone_number,user_name,user_email,latitude,longitude,adhar_no) values(:urnm,:phno,:name,:email,:lat,:longitude,:adhar)";
        $q="insert into address(latitude,longitude) values(:lat,:longitude)";
        $q2="insert into login values(:usrid,:name,:pass,:role)";
        $s1=oci_parse($c, $q1);
        oci_bind_by_name($s1,':urnm',$_POST["usrid"]);
        oci_bind_by_name($s1,':email',$_POST["email"]);
        oci_bind_by_name($s1,':name',$_POST["usrname"]);
        oci_bind_by_name($s1,':phno',$_POST["phno"]);
        oci_bind_by_name($s1,':adhar',$_POST["adhar"]);
        oci_bind_by_name($s1,':lat',$_POST["lat"]);
        oci_bind_by_name($s1,':longitude',$_POST["long"]);

        $s2=oci_parse($c,$q);
        
        oci_bind_by_name($s2,':lat',$_POST["lat"]);
        oci_bind_by_name($s2,':longitude',$_POST["long"]);

        $s3=oci_parse($c,$q2);

        oci_bind_by_name($s3, ':usrid',$_POST["usrid"]);
        oci_bind_by_name($s3, ':pass',$_POST["pass"]);
        oci_bind_by_name($s3, ':name',$_POST["usrname"]);
        oci_bind_by_name($s3, ':role',$_POST["as"]);

        if (!$s1 || !$s2 || !$s3) {
            $m = oci_error($c);
            trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
        }
        $r2=oci_execute($s2);
        $r1=oci_execute($s1);
        $r3=oci_execute($s3);
        if(!$r1){
            $m = oci_error($s1);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        if(!$r2){
            $m = oci_error($s2);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        if(!$r3){
            $m = oci_error($s3);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        if($_POST["as"]=="Driver")
        {
            $_SESSION["uid"]=$_POST["usrid"];
            include_once 'rider_info.php';
        }
        if($_POST["as"]=="User")
        {
            $_SESSION["name"]=$_POST["usrid"];
            header("location: address.php");
        }
    }
}
?>