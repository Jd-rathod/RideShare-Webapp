<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script  src="user_account.js"></script></head>
  
<body>
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2"><div class="tab-pane" id="ride">
                <h1>Available Drives</h1>
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">x</a> This is an <strong>Alert</strong>. Use this to show ongoing rides to the user.
                    </div>
                    
                    <table class="table table-hover table-striped">
                        <tbody> 
                        <tr>
                                <td>
                                   Rider_id
                                </td>
                                <td>
                                   Name
                                </td>
                                <td>
                                   Distance
                                </td>
                                <td>
                                   Cost
                                </td>
                                <td>
                                   Join it
                                </td>
                        </tr>
                        </tbody>

<?php
 session_start();
 if(isset($_POST["searchride"]))
 {
        require_once "config.php";
        $id=$_SESSION["id"];
        $_SESSION["lat"]=$_POST["lat"];
        $_SESSION["longt"]=$_POST["long"];
        $_SESSION["d_lat"]=$_POST["d_lat"];
        $_SESSION["d_longt"]=$_POST["d_long"];
        $_SESSION["inst_pu"]=$_POST["pickup"];
        $_SESSION["inst_dest"]=$_POST["dest"];
        $radius=6373.7;
        $q1 = "select user_id,user_name,ROUND((dist*3),-1) cost,ROUND(dist,2) dist from (select user_id,user_name,distance(:lat,:longt,latitude,longitude,:rad) as dist from (select * from user_info natural join address)) where dist<=10 order by dist asc";
        $s1=oci_parse($c,$q1);
        oci_bind_by_name($s1,':lat',$_POST["lat"]);
        oci_bind_by_name($s1,':longt',$_POST["long"]);
        oci_bind_by_name($s1,':rad',$radius);
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
        if($row = oci_fetch_array($s1, OCI_RETURN_NULLS+OCI_ASSOC)){
        
        while($row = oci_fetch_array($s1, OCI_RETURN_NULLS+OCI_ASSOC)) { ?>
        <tbody> 
            <tr>
                <td>
                    <?php echo $row['USER_ID'];?>
                </td>
                <td>
                    <?php echo $row['USER_NAME'];?>
                </td>
                <td>
                    <?php echo $row['DIST'];?>
                </td>
                <td>
                    <?php echo $row['COST'];?>
                </td>
                <td>
                    <a href="instjoin.php?rid=<?php echo $row['USER_ID'];?>&cost=<?php echo $row['COST'];?>">Join</a>
                </td>
            </tr>
        </tbody>

<?php
        }       
    }
    else{
    echo "No rides near you :( ";}
}
?>