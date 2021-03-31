<?php
    session_start();
    $cid=$_SESSION["id"];
    require_once "config.php";
    $riderid=$_GET['rid'];
    $strt=$_GET['tm_id'];
    echo $strt;
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
    oci_bind_by_name($s2,':ptime',$strt);
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
    /*
    else{
        echo '<script>alert("Something went wrong!Please try again:(")</script>';
    }*/
?>