<?php
session_start();
require_once "config.php";
$q="select rider_id,s_street,s_city,s_state,d_city,d_state,psngrs,TO_CHAR(timeinfo,'DD/MM/YYYY HH:MI AM') as time from long_dist";
$s=oci_parse($c,$q);
if(!$s)
{
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r=oci_execute($s);
if(!$r)
{
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
            
<?php while($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) { $rid=$row['RIDER_ID'];?>
    <?php $sq="select user_name from user_info where user_id='$rid'";
          $s1=oci_parse($c,$sq);
          if(!$s1){$m = oci_error($c);trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);}
          $rq=oci_execute($s1);
          if(!$rq){$m = oci_error($s1);trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);}
          $row1=oci_fetch_array($s1, OCI_RETURN_NULLS+OCI_ASSOC);?>
    <div class="card m-5" style="width: 22rem;">
<!--Card image-->
<div class="view overlay">
  <img src="uploads/Vehicles/raj@123group-pool3.jpg" class="img-fluid" alt="MDB Quick Start">
  <a href="#">
    <div class="mask rgba-white-slight"></div>
  </a>
</div>

<!--Card content-->
<div class="card-body">
  <!--Title-->
  <h4 class="card-title"><?php echo $row1['USER_NAME']; ?><br><?php echo $rid; ?></h4>
  <!--Text-->
  <p class="card-text"><b>Pickup:</b> <?php echo ''.$row['S_STREET'].', '.$row['S_CITY'].', '.$row['S_STATE'];?></p>
  <p class="card-text"><b>Destination:</b> <?php echo ''.$row['D_CITY'].', '.$row['D_STATE'];?></p>
  <p class="card-text"><?php echo "<b>Total Passengers: </b> ",$row['PSNGRS']; ?></p>
  <p class="card-text" id="dnt"><?php echo "<b>Date & Time: </b>",$row['TIME']; ?></p>
  <a class="btn btn-primary" id="<?php echo $rid?>" href="longjoin.php?rid=<?php echo $rid;?>&tm_id=<?php echo $row['TIME']; ?>">Join</a>
</div>

</div>
<!--/.Card-->

<?php } ?>

<!--<script>
$(".btn btn-primary").click(function(){

var rid= element.attr("id");

$.ajax({
	      type: "POST",
        url: "groupjoined.php",
        data: rid,
        success: function(){}
      });//ajax

//return false;
});
</script> -->

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