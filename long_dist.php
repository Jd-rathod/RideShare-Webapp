<html>
<head>
    <!--script src="rider_info.js"></script-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="long_dist.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <!--script src="https://code.jquery.com/jquery-2.1.1.min.js"></script-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!--script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" type="text/css">
    <style src="rider_info.css"></style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
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

<body id="body" style='background:url(images/long_dist.jpg);background-repeat:no-repeat'> 


<header class="text-white text-center">
    <h1 class="display-4">long distnace ride</h1>

    <img src="images/305463.svg" alt="" width="150" class="mb-4">
    
</header>
 
            <div class="container" style="width:100%;background:rgb(255,255,255,0.5)">
          

                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Post your journey</h2>
                        <form method="POST" name="register-form" class="register-form" action="longpost.php" onsubmit="return Validate()" id="register-form">
                            <div class="form-group">
                                <label for="s_street"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="s_street" id="s_street" style="background:transparent;" placeholder="from street" autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="s_city"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="s_city" id="s_city" style="background:transparent;" placeholder="from city" />
                            </div>
                            <div class="form-group">    
                                <label for="state"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="s_state" id="s_state" placeholder="from state" style="background:transparent;"/>
                            </div>
                            

                            <div><h3 class="form-title">Your Destination</h3></div>
                            <div class="form-group">
                                <label for="city"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="d_city" id="d_city" style="background:transparent;" placeholder="to city"  />
                            </div>
                            <div class="form-group">    
                                <label for="state"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="d_state" id="d_state" style="background:transparent;" placeholder="to state"/>
                            </div>
                            
                            <div>
                                <h3 class="form-title">Ride Info</h3>
                            </div>
                            <div class="form-group">    
                                <label for="state"><i class="zmdi zmdi-hc-border-circle"></i></label>
                                <input type="number" name="capacity" id="capacity" placeholder="passangers required" style="background:transparent;"/>
                            </div>
                            
                            <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="start_time" id="start_time" class="form-control" placeholder="start timing" style="background:transparent;"/>
                            <span class="input-group-addon" id="my-btn">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
        
                         </div>
                        <div id="spaces" style="display:none ">
                    <br><br><br><br><br><br><br><br><br>
                    <br><br><br><br><br>
                    </div>
                    <br>
                            <div class="form-group" >
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term"  style="color:rgb(0,0,0)"class="label-agree-term"><span><span></span></span><b>I agree all statements in </b> <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                           
                            
          
                            <div class="form-group form-button">
                                <input type="submit" name="long_dist_ride" id="long_dist_ride" class="form-submit" value="Post"/>
                            </div>
                            
                            
                        </form>
                    </div>
                    <!--<div class="signup-image">
                        <figure><img src="images/group-pool3.jfif" widEth=100% height=100% alt="sing up image"></figure>
                    
                    </div>-->
                </div>
            </div>
    
        

            <script>

function Validate() {
       
       if(document.getElementById("s_street").value=="")
       {
           alert("Street cannot not be empty!");
           document.getElementById("s_street").focus();
           return false;
       }
       if(document.getElementById("s_city").value=="")
       {
           alert("city cannot not be empty!");
           document.getElementById("s_city").focus();
           return false;
       }
       if(document.getElementById("s_state").value=="")
       {
           alert("state info required!");
           document.getElementById("s_state").focus();
           return false;
       }
       if(document.getElementById("d_city").value=="")
       {
           alert("Please select destination city");
           document.getElementById("d_city").focus();
           return false;
       }
       if(document.getElementById("d_state").value=="")
       {
           alert("Please select destination state");
           document.getElementById("d_state").focus();
           return false;
       }
       if(document.getElementById("capacity").value=="")  
       {
           alert("Total passangers should be atleast 1");
           document.getElementById("capacity").focus();
           return false;
       }
       if(document.getElementById("start_time").value=="")  
       {
           alert("Select Date and Time of your journey");
           document.getElementById("start_time").focus();
           return false;
       }

       return true;
   }
            
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
  
</body>
</html>
