<?php
session_start();
$id=$_SESSION["id"];
require_once "config.php";
$q="select rider_id from rider where rider_id='$id'";
$s=oci_parse($c,$q);
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
if($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC))
{
    $q1="insert into long_dist values(:rid,:s_str,:s_ct,:s_st,:d_ct,:d_st,:psn,TO_DATE(:dt,'MM/DD/YYYY HH:MI AM'))";
    $s1=oci_parse($c,$q1);
    $date=$_POST["start_time"];
    oci_bind_by_name($s1,':rid',$id);
    oci_bind_by_name($s1,':s_str',$_POST["s_street"]);
    oci_bind_by_name($s1,':s_ct',$_POST["s_city"]);
    oci_bind_by_name($s1,':s_st',$_POST["s_state"]);
    oci_bind_by_name($s1,':d_ct',$_POST["d_city"]);
    oci_bind_by_name($s1,':d_st',$_POST["d_state"]);
    oci_bind_by_name($s1,':psn',$_POST["capacity"]);
    oci_bind_by_name($s1,':dt',$date);
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
    if($r1)
    {
        $q2="insert into ride(rider_id,status,start_time) values(:rider,:st,TO_DATE(:strt,'MM/DD/YYYY HH:MI AM'))";
        $sq=oci_parse($c,$q2);
        $status="Pending";
        oci_bind_by_name($sq,':rider',$id);
        oci_bind_by_name($sq,':st',$status);
        oci_bind_by_name($sq,':strt',$_POST["start_time"]);
        if(!$sq)
        {
	        $m = oci_error($c);
            trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
        }
        $rq=oci_execute($sq);
        if(!$rq){
            $m = oci_error($sq);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        echo '<script>alert("Posted LongRide successfully!!!")</script>';
        header('location: home.php');        
    }
    else{
        echo '<script>alert("Something Went Wrong:(")</script>';
    }
}
else{
    echo '<script>alert("You need to are not registered as Driver")</script>';
    header('location: user_account.php');
}