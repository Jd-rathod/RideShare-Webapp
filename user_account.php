<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script  src="user_account.js"></script></head>
  
<body>

<?php
session_start();
if(isset($_SESSION["loggedin"]))
{
require_once "config.php";
$user_id=$_SESSION["id"]; //get here the user_id of the logged in user

//getting all the details
    $q1 = "select * from user_info natural join login natural join address where user_id='$user_id'";
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
    $row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC);
    $profile=$row["PROFILE_IMG"];
    //this row contains user_id,status,street,city,pincode,state ,username etc
    
    //finding that user is driver or not
    $is_driver=false;
    if($row){
        if(($row['ROLE'])=='Driver'){
            $is_driver=true;
        }

    }

    //finding if the user is grp_admin
    $q2 = "select * from usr_grp where rider_id='$user_id'";
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

    //finding the rating and vehicle id of the driver

    $q4 = "select * from rider where rider_id='$user_id'";
    $s3=oci_parse($c,$q4);
    
    if(!$s3)
    {
	$m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r3=oci_execute($s3);
    if(!$r3){
    $m = oci_error($s3);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $row3 = oci_fetch_array($s3, OCI_RETURN_NULLS+OCI_ASSOC);
    $rating;
    if($row3){
        $rating=$row3['RATING'];
        }   
    $vehicle_id=$row3['CURRENT_VEH'];

    //counting how many rides driver has completed.
    $q5 = "select COUNT(ride_id) rides from ride where rider_id='$user_id' and status='Done'";
    $s4=oci_parse($c,$q5);
    
    if(!$s4)
    {
	$m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
    }
    $r4=oci_execute($s4);
    if(!$r4){
    $m = oci_error($s4);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
    }
    $row4 = oci_fetch_array($s4, OCI_RETURN_NULLS+OCI_ASSOC);
?>
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#ride" data-toggle="tab" class="nav-link">rides</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit Vehicle Info</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h1><?php echo 'jdrathod';?></h1>
                        </div>
                        <div class="col-md-6">
                            <h6>You are</h6>
                            <a href="#" class="badge badge-dark badge-pill">User</a>
                            <a href="#" class="badge badge-dark badge-pill"><?php 
                            if($is_driver){
                                echo "driver";
                            }
                            
                            ?></a>
                            <a href="#" class="badge badge-dark badge-pill"><?php 
                            if($row1){
                                echo "Group admin";
                            }
                            ?></a>
                           
                            <hr>
                            <span class="badge badge-primary"><i class="fa fa-user"></i>Rides : <span id="rides"><?php echo $row4['RIDES']; ?></span></span>
                            <span class="badge badge-success"><i class="fa fa-cog"></i>Rating : <span id="rating"><?php echo $rating; ?></span></span>
                        
                        </div>
                        <div class="col-md-6">
                        <h5>Account details:</h5>
                        <table class="table table-sm table-hover">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>User name</h6>
                                        </td>
                                        
                                        <td>
                                           <span id="user_name"><?php echo 'Jay Rathod'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Phone number</h6>
                                        </td>
                                        
                                        <td>
                                            <em><span id="phone_number"><?php echo $row['PHONE_NUMBER']; ?></span></em>
                                        </td>
                                    </tr>                                   
                                    
                                    <tr>
                                        <td>
                                            <h6>Email Id</h6> 
                                        </td>
                                        
                                        <td>
                                             <em><span id="email"><?php echo $row['USER_EMAIL'];?></span></em> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Address</h6> 
                                        </td>
                                        
                                        <td>
                                             <em><span id="address"><?php echo ''.$row['STREET'].', '.$row['CITY'].', '.$row['PINCODE'].', '.$row['STATE'].', '.$row['COUNTRY']; ?></em> 
                                        </td>
                                    </tr>
                                   
                                </tbody>
                        </table>
                        <a class="btn btn-primary" href="my_user_account.php">Edit Info</a>
                        
                        
                        </div>
                        
                        <!--<div class="col-md-12">
                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>-->
                    </div>
                    </div>
                    <?php
               
                    $q1 = "select ride_id,pickup,dest,TO_CHAR(start_time,'DD/MM/YYYY HH:MI AM'),status from ride where rider_id='$user_id' order by start_time DESC";
                    $s_rideDetails=oci_parse($c,$q1);
                    
                    if(!$s_rideDetails)
                    {
                    $m = oci_error($c);
                    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
                    }
                    $r=oci_execute($s_rideDetails);
                    if(!$r){
                    $m = oci_error($s_rideDetails);
                    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
                    }
                    ?>
                    <!--/row-->
                
                <div class="tab-pane" id="ride">
                <h1>Recent Rides</h1>
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">x</a> This is an <strong>.alert</strong>. Use this to show ongoing rides to the user.
                    </div>
                    
                    <table class="table table-hover table-striped">
                        <tbody> 
                        <tr>
                            <td><b>
                                Ride_id
                            </td></b>
                            <td><b>
                                From
                            </td></b>
                            <td><b>
                                To
                            </td></b>
                            <td><b>
                                Start_time
                            </td></b>
                            <td><b>
                                Status
                            </td></b>
                        </tr>
                    <?php
                    while ($row = oci_fetch_array($s_rideDetails, OCI_RETURN_NULLS+OCI_ASSOC)) {
                    echo '<tr>';
                        foreach ($row as $item) {
                            print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
                        }
                    echo '</tr>';}?>                            
                            <!--tr>
                                <td>
                                   <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus. 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus. 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros. 
                                </td>
                            </tr-->
                        </tbody> 
                    </table>
                </div>
            
                <div class="tab-pane" id="edit">
                <?php 
                function includeWithVariables($filePath, $variables = array(), $print = true)
                {
                    $output = NULL;
                    if(file_exists($filePath)){
                        // Extract the variables to a local namespace
                        extract($variables);
                
                        // Start output buffering
                        ob_start();
                
                        // Include the template file
                        include $filePath;
                
                        // End buffering and return its contents
                        $output = ob_get_clean();
                    }
                    if ($print) {
                        print $output;
                    }
                    return $output;
                
                }?>
                <?php  includeWithVariables('vehicle_user_account.php', array('current_vehicle' => $vehicle_id));?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <img src='<?php echo $profile?>' id="profile_display"  style="width:220px;height:220px;border-radius:50%;"class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <form method="POST" name="register-form" id="profile_submit_form" enctype="multipart/form-data" class="register-form" action="profile_upoad.php">
            <label class="custom-file" id="edit">
                <input type="file" name="profile" id="file" onchange="readURL(this);" class="custom-file-input">
                <span class="custom-file-control"><img src="images/edit.png" class="mx-auto  img-circle d-block" alt="avatar" width="30px" height="30px" style="margin-right:30px;">Edit profile</span>
                
    
            </label>
            
            </form> 
        </div>
    </div>
</div>
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
<html>
<?php }
else{
    echo '<script>alert("You need to Login to view your profile!")</script>';
    include_once 'home.php';}
?>