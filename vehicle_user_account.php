<?php
$user_id=$_SESSION["id"];
//require_once "config.php";
error_reporting(E_ALL);
ini_set('display_errors', 'On');
 
$dbaname = "system";                  // Use your username
$dbapassword = "jdr1308";             // and your password
$database = "orcl";   // and the connect string to connect to your database

//$query = "select password from users where username = '$name'";

$c = oci_connect($dbaname, $dbapassword, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}

$qr = "select * from vehicle where no_plate='$current_vehicle'";
$sr=oci_parse($c,$qr);
if(!$sr)
{
	$m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r=oci_execute($sr);
if(!$r){
    $m = oci_error($sr);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
$row = oci_fetch_array($sr, OCI_RETURN_NULLS+OCI_ASSOC);
$car_image=$row["CAR_IMG"];
$capacity=$row["CAPACITY"];

$q1="select type,value from specifications  where no_plate='$current_vehicle'";

$s1=oci_parse($c,$q1);
    
if(!$s1)
{
$m = oci_error($c);
trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r=oci_execute($s1);
if(!$r){
$m = oci_error($s1);
trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}

//to get the other vehicle info
    $q2 = "select * from (drives inner join vehicle on drives.vehicle_id=vehicle.no_plate) where rider_id='$user_id' and '$current_vehicle' not in no_plate";
    $s2=oci_parse($c,$q2);
    if(!$s2)
    {
	$m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r1=oci_execute($s2);
    if(!$r1){
    $m = oci_error($s2);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }

?>
<html>
<body>
<h2>Current Vehicle</h2>
<div class="card m-5" style="width: 22rem;">
<div class="view overlay">
<img src='<?php echo $car_image?>' class="img-fluid" alt="MDB Quick Start">
  <a href="#">
    <div class="mask rgba-white-slight"></div>
  </a>
</div>
<div class="card-body">
<h4 class="card-title"><br><?php echo $current_vehicle; ?></h4>
    <!--Text-->
    <p class="card-text">CAPACITY:<?php echo $capacity ?></p>
    <p class="card-text"><b>SPECIFICATIONS:</b>


<?php 
while($row1 = oci_fetch_array($s1, OCI_RETURN_NULLS+OCI_ASSOC)){
?>
<p class="card-text"><?php echo $row1['TYPE'];?> : <em><?php echo $row1['VALUE'];?> </em> </p>
<?php 
}?>
</div>
</div>
<br>
<br>
<h2>Other Vehicles</h2>
<div clas="card-column">
<?php

while($row = oci_fetch_array($s2, OCI_RETURN_NULLS+OCI_ASSOC)){

?>
<div class="card m-5" style="width: 22rem;">
<div class="card-body">
    <!--Title-->
    <div class="view overlay">
        <img src="<?php echo $row["CAR_IMG"]?>" class="img-fluid" alt="MDB Quick Start">
        <a href="#">
            <div class="mask rgba-white-slight"></div>
        </a>
    </div>
    <h4 class="card-title"><!--?php echo $row2['NO_PLATE']; ?--><br><?php echo $row["NO_PLATE"]; ?></h4>
                <!--Text-->
                
    <a class="btn btn-primary" id="vehicle" href="set_as_current.php?vehicle_id=<?php echo  $row["NO_PLATE"];?>">Drive with this</a>
    </div>
<?php 
}
?>           
</div>
<br>
<a class="btn btn-primary"  href="rider_info.php">Add vehicle</a>
<script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
</body>
</html>



