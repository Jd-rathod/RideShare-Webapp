<?php
session_start();
$_SESSION["pu"]=$_POST['pu'];
$_SESSION["dest"]=$_POST['dest'];
include_once("config.php");
$q1 = "select rider_id,ROUND(dist,2) dist from (select rider_id,distance(:lat,:longt,latitude,longitude,:rad) as dist from routes) where dist<=5 order by dist asc";
$s=oci_parse($c,$q1);
    $radius=6387.7;
    oci_bind_by_name($s,':lat',$_POST["lat"]);
    oci_bind_by_name($s,':longt',$_POST["long"]);
    oci_bind_by_name($s,':rad',$radius);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>View Group</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="card-columns">        
<?php if($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)){ while($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) { $id=$row['RIDER_ID']; ?>

  <?php
    /* from usr_grp */ 
    $q2="select pickup,dest,capacity from usr_grp where rider_id='$id'";
    $s1=oci_parse($c,$q2);
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
    $row1 = oci_fetch_array($s1, OCI_RETURN_NULLS+OCI_ASSOC);

    /* from user_info */
    $q3="select  user_name from user_info where user_id='$id'";
    $s2=oci_parse($c,$q3);
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
    $row2 = oci_fetch_array($s2, OCI_RETURN_NULLS+OCI_ASSOC);

    /* time info */
    $qr="select TO_CHAR(start_time,'DD/MM/YYYY HH:MI AM') as time from ride where rider_id='$id'";
    $sq=oci_parse($c,$qr);
    if(!$s2)
    {
	  $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $rq=oci_execute($sq);
    if(!$rq){
    $m = oci_error($sq);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $row3 = oci_fetch_array($sq, OCI_RETURN_NULLS+OCI_ASSOC);
  ?>
<div class="card m-5" style="width: 22rem;">
<!--Card image-->
<div class="view overlay">
  <img src="uploads/Vehicles/raj@123mycar.png" class="img-fluid" alt="MDB Quick Start">
  <a href="#">
    <div class="mask rgba-white-slight"></div>
  </a>
</div>

<!--Card content-->
<div class="card-body">
  <!--Title-->
  <h4 class="card-title"><?php echo $row2['USER_NAME']; ?><br><?php echo $id; ?></h4>
  <!--Text-->
  <p class="card-text"><b>Pickup:</b> <?php echo $row1['PICKUP'];?></p><p class="card-text"><b>Destination:</b> <?php echo $row1['DEST']; ?></p>
  <p class="card-text"><?php echo "<b>Distance:</b> ",$row['DIST']; ?></p>
  <p class="card-text"><?php echo "<b>Capacity:</b> ",$row1['CAPACITY']; ?></p>
  <p class="card-text" id="dnt"><?php echo "<b>Daily Time: </b>",$row3['TIME']; ?></p>
  <a class="btn btn-primary" id="<?php echo $id ?>" href="groupjoined.php?rid=<?php echo $id;?>&tm_id=<?php echo $row3['TIME']; ?>">Join</a>
</div>
</div>
<!--/.Card-->

<?php }'</div>';}
else { echo "No groups found near you :(";} ?>

<!-- jQuery -->
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
