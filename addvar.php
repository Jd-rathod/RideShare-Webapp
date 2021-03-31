<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$c = oci_connect("system", "jdr1308", "orcl");
if (!$c) {
	$m = oci_error();
	trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}

$q="update address set street=:st,pincode=:pin,city=:ct,state=:state,country=:country where city is null";
$s1=oci_parse($c, $q);
oci_bind_by_name($s1,':st',$_POST["street"]);
oci_bind_by_name($s1,':pin',$_POST["pin"]);
oci_bind_by_name($s1,':ct',$_POST["city"]);
oci_bind_by_name($s1,':state',$_POST["state"]);
oci_bind_by_name($s1,':country',$_POST["country"]);
if (!$s1) {
		$m = oci_error($c);
		trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
	}
$r1=oci_execute($s1);
if(!$r1){
		$m = oci_error($s1);
		trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
	}
$msg="Registered Successfully!";
$_SESSION["msg"] = $msg;
header("location: signin.php"); 
?>