<?php
session_start();
if($_SESSION["loggedin"])
{
$rid=$_SESSION["id"];
}
else{
    $rid=$_SESSION["uid"];
}
$target_dir = "uploads/vehicles/";
$target_file = $target_dir. $rid . basename($_FILES["upload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["upload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
/*if ($_FILES["upload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        
    require_once 'config.php';
    $q="insert into vehicle values(:no,:cap,:img)";
    $s=oci_parse($c,$q);
    oci_bind_by_name($s,':no',$_POST['num_plate']);
    oci_bind_by_name($s,':cap',$_POST['capacity']);
    oci_bind_by_name($s,':img',$target_file);
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
    oci_bind_by_name($s1,':id',$rid);
    if (!$s1) {
        $m = oci_error($c);
        trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r1= oci_execute($s1);
    if(!$r){
        $m = oci_error($s1);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }

    if(!$_SESSION["loggedin"])
    {
    $qr="insert into rider(rider_id,current_veh) values(:id,:no)";
    $sr=oci_parse($c,$qr);
    oci_bind_by_name($sr,':no',$_POST['num_plate']);
    oci_bind_by_name($sr,':id',$rid);
    if (!$sr) {
        $m = oci_error($c);
        trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r2=oci_execute($sr);
    if(!$r2){
        $m = oci_error($sr);
        trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    }

    /* for specifications table */

    for($x = 1; $x <= 5; $x++)
    {
        if(!(isset($_POST["type$x"])))
            {break;}
        else
        {
            $ty=$_POST["type$x"];
            $va=$_POST["value$x"];
        $q1="insert into specifications values(:no,:vtype,:val)";
        $s1=oci_parse($c,$q1);
        oci_bind_by_name($s1,':no',$_POST['num_plate']);
        oci_bind_by_name($s1,':vtype',$ty);
        oci_bind_by_name($s1,':val',$va);
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
    if(!$_SESSION["loggedin"])
    {
    include_once 'address.php';
    }
    else{
        header('location: rider_info.php');
    }

    } else {
        if(!$_SESSION["loggedin"])
        {
            $msg="Sorry, there was an error uploading your file.";
            $_SESSION["imgerr"]=$msg;
            header('lovation: rider_info.php');
        }
        else
        {
            echo '<script>alert("Sorry, there was an error uploading your file")</script>';
        }
    }
}
?>  