<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by RideShare</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <script src='signupval.js'></script>
    <script src='instant_ride.js'></script>
    <script src="js/geoPosition.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>
    <style>
        /* The switch - the box around the slider */
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
<body>
    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" name="register-form" class="register-form" action="register.php" onsubmit="return Valid()" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account-circle"></i></label>
                                <input type="text" name="usrid" id="usrid" placeholder="Enter unique userid" autofocus/>
                            </div>
                            <?php
                            if(isset($_SESSION["msg"])){
                                $msg=$_SESSION["msg"];
                                echo "<span>$msg</span>";}
                            ?>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="usrname" id="usrname" placeholder="Your Name" autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div>
                                <h3 class="form-title">Personal Info</h3>
                            </div>
                            <div class="form-group">
                                <label for="phno"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phno" id="phno" pattern="[0-9]{5} [0-9]{5}" placeholder="Your Phone no.">
                            </div>
                            <div class="form-group">
                                <label for="adhar"><i class="zmdi zmdi-star"></i></label>
                                <input type="text" name="adhar" id="adhar" pattern="[0-9]{4} [0-9]{4} [0-9]{4}" placeholder="Your Adhar no.">
                            </div>
                            <div><h3 class="form-title">Use my current location</h3>
                            <label class="switch">
                            <input type="checkbox" name="add" id="add" onclick="geolocation()"><span class="slider round"></span></label>
                            </div>
                            <div class="form-group">
                                <label for="lat"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="lat" id="lat" placeholder="latitude" autofocus/>
                            </div>  
                            <div class="form-group">
                                <label for="long"><i class="zmdi-my-location"></i></label>
                                <input type="decimal" name="long" id="long" placeholder="longitude" autofocus />
                            </div>
                            <div>
                            <input type="radio" name="x" id="driver" value="Driver">Driver
                            <input type="radio" name="x" id="user" value="User">RideUser
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="as" id="as" autofocus/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<?php
    unset($_SESSION["msg"]);
?>