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
    $q="insert into usr_grp values(:pu,:dest,:id,:cap)";
    $s=oci_parse($c,$q);
    oci_bind_by_name($s,':pu',$_POST["pu"]);
    oci_bind_by_name($s,':dest',$_POST["dest"]);
    oci_bind_by_name($s,':cap',$_POST["capacity"]);
    oci_bind_by_name($s,':id',$id);
    if(!$s)
    {
        $m = oci_error($c);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $r=oci_execute($s);
    if(!$r)
    {
        $m = oci_error($s);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $lat=$_POST["lat"];
    $longt=$_POST["long"];
    $d_lat=$_POST["d_lat"];
    $d_longt=$_POST["d_long"];

    /* for pickup */
    $q1="insert into routes values(:id,:lat,:longt)";
    $s1=oci_parse($c,$q1);
    oci_bind_by_name($s1,':id',$id);
    oci_bind_by_name($s1,':lat',$lat);
    oci_bind_by_name($s1,':longt',$longt);
    if(!$s1)
    {
        $m = oci_error($c);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $r1=oci_execute($s1);
    if(!$r1)
    {
        $m = oci_error($s1);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }

    /* for dest */
    $q2="insert into routes values(:id,:lat,:longt)";
    $s2=oci_parse($c,$q2);
    oci_bind_by_name($s2,':id',$id);
    oci_bind_by_name($s2,':lat',$d_lat);
    oci_bind_by_name($s2,':longt',$d_longt);
    if(!$s2)
    {
        $m = oci_error($c);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $r2=oci_execute($s2);
    if(!$r2)
    {
        $m = oci_error($s2);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }

    /* for check points */
    for($x = 1; $x <= 5; $x++)
    {
        if(!(isset($_POST["d_lat$x"])))
            {break;}
        else
        {
        $lat=$_POST["d_lat$x"];
        $longt=$_POST["d_long$x"];
        $q1="insert into routes values(:id,:lat,:longt)";
        $s1=oci_parse($c,$q1);
        oci_bind_by_name($s1,':id',$id);
        oci_bind_by_name($s1,':lat',$lat);
        oci_bind_by_name($s1,':longt',$longt);
        if(!$s1)
        {
            $m = oci_error($c);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        $r1=oci_execute($s1);
        if(!$r1)
        {
            $m = oci_error($s1);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        }
    }
    if($r && $r1 && $r2)
    {
        $q3="insert into ride(rider_id,status,start_time) values(:rider,:st,TO_DATE(:strt,'MM/DD/YYYY HH:MI AM'))";
        $sq=oci_parse($c,$q3);
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
        echo '<script>alert("Successfully posted!")</script>';
        header('location: home.php');   
    }
}
else{
    echo '<script>alert("You are not registered as Driver")</script>';
    header('location: user_account.php');
}