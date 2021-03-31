<?php
session_start();
?>
<html>
<head>
    <script src="rider_info.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" type="text/css">
    <style src="rider_info.css"></style>

    <style >.container {
  width: 900px;
  background: rgb(255,255,255,0.9);
  margin: 0 auto;
  box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
  -webkit-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
  -o-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
  -ms-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
  border-radius: 20px;
  -moz-border-radius: 20px;
  -webkit-border-radius: 20px;
  -o-border-radius: 20px;
  -ms-border-radius: 20px; }

option,select{
  width: 100%;
  display: block;
  border: none;
  border-bottom: 1px solid #999;
  padding: 6px 30px;
  font-family: Poppins;
  box-sizing: border-box; }

 
  </style>
    
</head>
<link rel="stylesheet" href="rider_info.css">

<body>


<header class="text-white text-center">
    <h1 class="display-4">Vehicle info</h1>

    <img src="images/305463.svg" alt="" width="150" class="mb-4">
</header>
    
<div class="container">
    <div class="signup-content">
        <div class="signup-form">
            
            <form method="POST" name="register-form" enctype="multipart/form-data" class="register-form" action="upload.php" onsubmit="return Validate()" id="register-form">

                <div><h3 class="form-title">Car details</h3></div>
                <div class="form-group">
                    <label for="num_plate"><i class="zmdi zmdi-car"></i></label>
                    <input type="text" name="num_plate" id="num_plate" pattern="[A-Z]{2}-[0-9]{2}-[A-Z]{2}-[0-9]{4}" style="background: transparent;" placeholder="Registration Number..(ex:GJ-05-JR-1234)" autofocus/>
                </div> 
                <div class="form-group">
                    <label for="name"><i class="zmdi zmdi-car-taxi"></i></label>
                    <input type="name" name="name" id="name" style="background: transparent;" placeholder="name of car/bike" autofocus/>
                </div>
                <div class="form-group">
                    <label for="capacity"><i class="zmdi zmdi-hc-border-circle"></i></label>
                    <input type="number" name="capacity" id="capacity" style="background: transparent;" placeholder="maximum capacity" autofocus/>
                </div>

                <datalist id="specification_types" >
                    <option value="air bags">"like yes or no "</option>
                    <option value="car type">like [Hatchbacks,Sedan,SUV,MPV] if car</option>
                    <option value="how old?">Approx age of vehicle</option>
                
                </datalist >
                <div id="specifications">
                <h3 class="form-title">Add specification of your vehicle</h3>
                </div>
                <div class="form-group"> 
                
                <input type="button" id="r"  onclick="add_specification()" value="Add the specification "/>
                </div>
                <div class="form-group"> 
                                 
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input id="upload" name="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose car image</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                    </div>

                </div>
                <?php  if(!$_SESSION["loggedin"]){
                            if(isset($_SESSION["imgerr"])){
                                $msg=$_SESSION["imgerr"];
                                echo "<span>$msg</span>";}
                            }?>

                <p class="font-italic text-black text-center">The image uploaded will be rendered inside the box below.</p>
                <div class="image-area mt-4" style="background:rgb(0,0,0,0.1);"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                        
                         
                           
                        
                <div class="form-group">
                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                    <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                </div>
                <div class="form-group form-button">
                    <input type="submit"  name="long_dist_ride" id="long_dist_ride" class="form-submit" value="Add Vehicle"/>
                <div>
                            
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
if(!$_SESSION["loggedin"]){
    unset($_SESSION["imgerr"]);}
?>
