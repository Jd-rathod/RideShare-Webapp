<?php
    session_start();
    $id=$_SESSION["uid"];
    $imglink=$_SESSION["imglink"];
if(isset($_SESSION["uid"]))
{
    require_once 'config.php';
    global $target_file;
    $q="insert into vehicle values(:no,:cap,:img)";
    $s=oci_parse($c,$q);
    oci_bind_by_name($s,':no',$_POST['num_plate']);
    oci_bind_by_name($s,':cap',$_POST['capacity']);
    oci_bind_by_name($s,':img',$_POST['']);
    if (!$s) {
        $m = oci_error($c);
        trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r = oci_execute($s);
    if(!$r){
        $m = oci_error($s);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    
    /* for drives table */
    $q1="insert into drives values(:no,:id)";
    $s1=oci_parse($c,$q1);
    oci_bind_by_name($s1,':no',$_POST['num_plate']);
    oci_bind_by_name($s1,':id',$id);
    if (!$s1) {
        $m = oci_error($c);
        trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r1= oci_execute($s1);
    if(!$r){
        $m = oci_error($s1);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }

    /* for specifications table */

    for($x = 1; $x <= 5; $x++)
    {
        if(!(isset($_POST["type$x"])))
            {break;}
        else
        {
        $q1="insert into specifications values(:no,:vtype,:va;)";
        $s1=oci_parse($c,$q1);
        oci_bind_by_name($s1,':no',$_POST['num_plate']);
        oci_bind_by_name($s1,':vtype',$_POST["type$x"]);
        oci_bind_by_name($s1,':val',$_POST["value$x"]);
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
    echo '<script>alert("The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.")</script>';
}
else{
    echo "something went wrong please try again!";
}   
?>
