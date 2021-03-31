<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');
 
require_once "config.php";

$q='select * from login where user_id=:name and password=:pass';
$s=oci_parse($c,$q);
oci_bind_by_name($s,':name',$_POST["your_name"]);
oci_bind_by_name($s,':pass',$_POST["your_pass"]);
if(!$s)
{
	$m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r=oci_execute($s);
if(!$r){
    $m = oci_error($s);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
else{
    if ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
    { $login=$_POST["your_name"];
      $_SESSION["loggedin"]=true;
      $_SESSION["id"]=$login;
      header('location: home.php');}
    else
    {
		$error="Invalid Username or Password";
		$_SESSION["error"] = $error;
    	header("location: signin.php");
	}
}
?>