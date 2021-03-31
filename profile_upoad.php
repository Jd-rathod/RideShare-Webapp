<?php
session_start();
$rid=$_SESSION['id'];
$target_dir = "uploads/profile_img/";
$target_file = $target_dir. $rid . basename($_FILES["profile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profile"]["tmp_name"]);
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
    if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
        require_once "config.php";
        $q="update user_info set profile_img='$target_file' where user_id='$rid'";
        $s=oci_parse($c,$q);
        if($s)
        {
            $r=oci_execute($s);
            if($r){
            echo '<script>alert("The file "'. basename( $_FILES["profile"]["name"]) .'" has been uploaded.")</script>';
            header('location:user_account.php');}
        }
    } else {
        echo '<script>alert("Sorry, there was an error uploading your file")</script>';
        header('location:user_account.php');
    }
    
}

/*
include_once("config.php");
$user_id=//get here the user_id of the logged in user
$q1 = "update  user_info set profile_iamge=:path where user_id='$user_id';";
oci_bind_by_name($s,':path',$target_dir);
$s=oci_parse($c,$q1);
    
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
    $row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC);*/
    //this row contains user_id,status,street,city,pincode,state ,username etc
    
//write your code to  do rest of the work

//the image path that you need to store in the database   $target_file 
//I have not included the license and front and rare image as it will be redundant in this form
//it should be included in the driver table
?>  