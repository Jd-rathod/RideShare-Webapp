<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Group</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="long_dist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=fetch,requestAnimationFrame,Element.prototype.classList,URL"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" type="text/css">
     <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
    <script src='index.js'></script>
    <script src='post_group.js'></script>
    <script src="js/geoPosition.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <style>
    #frame{
        display:none;
        margin-top:200px;
        }
        .switch {
        position: relative;
        display:inline-block;
        width: 60px;
        height: 30px;
        }

        /* Hide default HTML checkbox */
        .switch input {
        opacity: 0;
        width: 0;
        height: 0;
        }
        .slider.round {
        border-radius: 20px;
        }

        .slider.round:before {
        border-radius: 50%;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0px;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: rgb(0, 140, 255);
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(30px);
        -ms-transform: translateX(30px);
        transform: translateX(30px);
        }
      
      </style>

    
</head>
<body  id="body">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Post Group</h2>
                        <form method="POST" name="register-form" class="register-form" action="group_post.php" onsubmit="return Validate()" id="register-form">

                            <div><h3 class="form-title">pickup location</h3></div>
                            <div class="form-group">
                                <label for="lat"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="lat" id="lat" placeholder="latitude" autofocus/>
                            </div>  
                            <div class="form-group">
                                <label for="long"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="long" id="long" placeholder="longitude" autofocus/>
                            </div>
                            <div><h3 class="form-title">Use my current location</h3>
                            <label class="switch">
                            <input type="checkbox" id="add" onclick="geolocation()"><span class="slider round"></span></label>
                            </div>
                           
                            <div><h3 class="form-title">Your Destination</h3></div>
                            <div class="form-group">
                                <label for="city"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="pu" id="pu" placeholder="Pickup address" autofocus/>
                            </div>
                            <div class="form-group">    
                                <label for="state"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="dest" id="dest" placeholder="Destination address"/>
                            </div>
                            <div><h3 class="form-title">Use map</h3>
                            <label class="switch">
                            <input type="checkbox" id="d_add" onclick="getdestinationloc()"><span class="slider round"></span></label>
                            </div>
                            <div class="form-group">
                                <label for="d_lat"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="d_lat" id="d_lat" placeholder="destination latitude" autofocus/>
                            </div>  
                            <div class="form-group">
                           
                                <label for="d_long"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="d_long" id="d_long" placeholder="destination longitude" autofocus/>
                            </div>

                            <div><h3 class="form-title">Date & Time info</h3></div>
                            <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="start_time" class="form-control" placeholder="start timing"/>
                            <span class="input-group-addon" id="my-btn">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
            
                            </div>
                            <div id="spaces" style="display:none ">
                            <br><br><br><br><br><br><br><br><br>
                            <br><br><br><br><br>
                            </div>
                            <br>
                
                            <div id="routes">
                            <h3 class="form-title">The places which you come across while ride</h3>
                            </div>
                            <div class="form-group"> 
                
                            <input type="button" id="r"  onclick="add_route()" value="Add the places "/>
                            </div>
                            <div>
                                <h3 class="form-title">Ride Info</h3>
                            </div>
                            <div class="form-group">    
                                <label class="sr-only" for="state"><i class="zmdi zmdi-hc-border-circle"></i></label>
                                <input type="number" min=1 max=4 name="capacity" id="capacity" placeholder="Number of passangers required"/>
                            </div>
                            <div>
                            <p id='geo-loc'></p>
                            </div>                   
                            
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit"  name="long_dist_ride" id="long_dist_ride" class="form-submit" value="Post"/>
                            </div>
                            
                        </form>
                    </div>

                    <iframe src="index.html" id="frame" width="100%" height="600px"></iframe>

                    <!--div class="signup-image">
                        <figure><img src="images/group-pool3.jfif" widEth=100% height=100% alt="sing up image"></figure>
                    
                    </div-->
                            
                    
                </div>
            </div>
        </section>
    </div>
    <script src="js/main.js"></script>
    <script>
            
            var open=false;
        
             document.getElementById("body").addEventListener("click", function(e){
                
                   console.log("here");
                document.getElementById('spaces').style.display='none';
                open=false;
                 
                });

                document.getElementById("my-btn").addEventListener("click", function(e){
                    
                    if (!open){
                         document.getElementById('spaces').style.display='block';
                    
                         open=true;
                    }
                    else{
                        document.getElementById('spaces').style.display='none';
                        open=false;
        
                            }
                            event.stopPropagation()
                });
                
                    $(function() {
                    $('#datetimepicker1').datetimepicker();
                    });</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
