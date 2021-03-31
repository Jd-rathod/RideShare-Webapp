<?php
  session_start();
  $pu=$_SESSION['inst_pu'];
  $cid=$_SESSION['id'];
  $dest=$_SESSION['inst_dest'];
  $riderid=$_GET['rid'];
  $cost=$_GET['cost'];
  require_once  "config.php";
  $q="insert into ride(rider_id,status,start_time,pickup,dest) values(:rider,:stat,TO_DATE(sysdate,'DD/MM/YYYY HH:MI AM'),:pickup,:dest)";
  $s=oci_parse($c,$q);
  $status="Pending";
  oci_bind_by_name($s,':rider',$riderid);
  oci_bind_by_name($s,':stat',$status);
  oci_bind_by_name($s,':pickup',$pu);
  oci_bind_by_name($s,':dest',$dest);
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
if($r)
{
$q1="select ride_id from ride where rider_id='$riderid'";
$s1=oci_parse($c,$q1);
if(!$s1)
{
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r1=oci_execute($s1);
if(!$r1){
    $m = oci_error($s1);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
$row = oci_fetch_array($s1, OCI_RETURN_NULLS+OCI_ASSOC);
$q3='insert into instant_ride values(:cst,:rider,:lat,:longt,:d_lat,:d_long,:cost,:psngr)';
$s3=oci_parse($c,$q3);
oci_bind_by_name($s3,':cst',$id);
oci_bind_by_name($s3,':lat',$_SESSION["lat"]);
oci_bind_by_name($s3,':longt',$_SESSION["longt"]);
oci_bind_by_name($s3,':d_lat',$_SESSION["d_lat"]);
oci_bind_by_name($s3,':d_long',$_SESSION["d_longt"]);
oci_bind_by_name($s3,':psngr',$_POST["users"]);
oci_bind_by_name($s3,':rider',$riderid);
oci_bind_by_name($s3,':cost',$cost);
if(!$s3)
{
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r3=oci_execute($s3);
if(!$r3){
    $m = oci_error($s3);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}

$q2="insert into ride_users values(:ride,TO_DATE(sysdate,'DD/MM/YYYY HH:MI AM'),:cid)";
$s2=oci_parse($c,$q2);
oci_bind_by_name($s2,':ride',$row['RIDE_ID']);
oci_bind_by_name($s2,':cid',$cid);
if(!$s2)
{
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r2=oci_execute($s2);
if(!$r2){
    $m = oci_error($s2);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
if($r3)
{
session_destroy($_SESSION["inst_pu"]);
session_destroy($_SESSION["inst_dest"]);
session_destroy($_SESSION["lat"]);
session_destroy($_SESSION["longt"]);
session_destroy($_SESSION["d_lat"]);
session_destroy($_SESSION["d_longt"]);
}
echo '<script>alert("Joined Ride Successfully!")</script>';
header('location: home.php');
}
?>