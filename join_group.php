<html>
<head>
    
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=fetch,requestAnimationFrame,Element.prototype.classList,URL"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" type="text/css">
     <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
    <link rel="stylesheet" href="css/style.css" >
    <link rel="stylesheet" href="long_dist.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" type="text/css">
    <script src="js/geoPosition.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>
    <style src="rider_info.css"></style>
    <script src="join_group.js"></script>

    <style >.container {
  width: 900px;
  background: rgb(255,255,255,0.5);
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
<link rel="stylesheet" href="rider_info.css">

<body>


<header class="text-white text-center">
    <h1 class="display-4">Join Group</h1>

    <div class="container" style="width:200px;padding-top:20px;background:rgb(0,0,0,0.1);border-radius:50% ;margin-bottom:20px;" ><img src="images/pool.png" alt="" width="150" class="mb-4"></div>
</header>
    
<div class="container" style="width:100%">
    <div class="signup-content">
        <div class="signup-form">
            
            <form method="POST" name="register-form" action="viewgroup.php" class="register-form" id="register-form">

                 <div><h3 class="form-title">pickup location</h3></div>
                            <div class="form-group">
                                <label for="lat"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="lat" id="lat" placeholder="latitude" style="background: transparent;" autofocus/>
                            </div>  
                            <div class="form-group">
                                <label for="long"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="long" id="long" placeholder="longitude" style="background: transparent;"  autofocus/>
                            </div>
                            <div><h3 class="form-title">Use map</h3>
                            <label class="switch">
                            <input type="checkbox" id="d_add" onclick="getdestinationloc()"><span class="slider round"></span></label>
                            </div>
                            <div><h3 class="form-title">Ride details</h3></div>
                            <div class="form-group">
                                <label for="city"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="pu" id="pu" style="background: transparent;" placeholder="pickup address" autofocus/>
                            </div>
                            <div class="form-group">    
                                <label for="state"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="dest" id="dest" style="background: transparent;" placeholder="destination address"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit"  name="search" id="search" class="form-submit" value="Search"/>
                            </div>
            </form>
            
        </div>
            <iframe src="index.html" id="frame" width="100%" height="600px" style="margin-top:0px;"></iframe>
    </div>
    
    
</div>
        

            
            
</body>
</html>
