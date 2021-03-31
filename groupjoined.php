<?php
  session_start();
  $pu=$_SESSION['pu'];
  $cid=$_SESSION['id'];
  $dest=$_SESSION['dest'];
  $riderid=$_GET['rid'];
  $time=$_GET['tm_id'];
  require_once  "config.php";
  $q="insert into group_users values(:rider,:cid,:pickup,:dest)";
  $s=oci_parse($c,$q);
  oci_bind_by_name($s,':cid',$cid);
  oci_bind_by_name($s,':pickup',$pu);
  oci_bind_by_name($s,':dest',$dest);
  oci_bind_by_name($s,':rider',$riderid);
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
$q2="insert into ride_users values(:ride,TO_DATE(:ptime,'DD/MM/YYYY HH:MI AM'),:cid)";
$s2=oci_parse($c,$q2);
oci_bind_by_name($s2,':ride',$row['RIDE_ID']);
oci_bind_by_name($s2,':ptime',$time);
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
echo '<script>alert("Joined Group Successfully!")</script>';
}
?>