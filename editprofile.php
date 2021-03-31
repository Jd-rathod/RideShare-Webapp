<?php
session_start();
require_once "config.php";
$id=$_SESSION["id"];
echo $id;
echo $_POST["name"];
$q="update user_info set user_name=:name,user_email=:email,phone_number=:phno where user_id='$id'";
$s=oci_parse($c,$q);
oci_bind_by_name($s,':name',$_POST["name"]);
oci_bind_by_name($s,':email',$_POST["email"]);
oci_bind_by_name($s,':phno',$_POST["phno"]);
if (!$s) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r = oci_execute($s);
if(!$r){
    $m = oci_error($s);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
if($r)
{
$q1="update address set pincode=:pin,street=:st,city=:ct,state=:state where latitude=(select latitude from user_info where user_id='$id') and longitude=(select longitude from user_info where user_id='$id')";
$s1=oci_parse($c,$q1);
oci_bind_by_name($s1,':pin',$_POST["pin"]);
oci_bind_by_name($s1,':st',$_POST["st"]);
oci_bind_by_name($s1,':ct',$_POST["city"]);
oci_bind_by_name($s1,':state',$_POST["state"]);
if (!$s1) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r1 = oci_execute($s1);
if(!$r1){
    $m = oci_error($s1);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
$q2="update login set user_name=:name,password=:pass where user_id='$id'";
$s2=oci_parse($c,$q2);
oci_bind_by_name($s2,':name',$_POST["name"]);
oci_bind_by_name($s2,':pass',$_POST["pass"]);
if (!$s2) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r2 = oci_execute($s2);
if(!$r2){
    $m = oci_error($s2);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
if($r1 && $r2)
{
    echo '<script>alert(""Details Modified Successfully!")<script>';
    header('location: my_user_account.php');
}
}
?>