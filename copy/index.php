<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
    var pno=document.getElementById('phno');
    pno.oninvalid = function(event) {
    event.target.setCustomValidity('Phone number must contain 10 digits ex:12345 12345');
    }
    var a=document.getElementById('adhar');
    a.oninvalid = function(event) {
    event.target.setCustomValidity('Adhar number must contain 12 digits ex:1234 1234 1234');
    }
    function Validate() {
        if(document.getElementById("name").value=="")
        {
            alert("Name Should not be empty!");
            document.getElementById("name").focus();
            return false;
        }
        if(document.getElementById("email").value=="")
        {
            alert("Email Should not be empty!");
            document.getElementById("email").focus();
            return false;
        }
        if(document.getElementById("pass").value=="")
        {
            alert("Password Should not be empty!");
            document.getElementById("pass").focus();
            return false;
        }
        if(document.getElementById("re_pass").value=="")
        {
            alert("Please verify your password!");
            document.getElementById("re_pass").focus();
            return false;
        }
        var password = document.getElementById("pass").value;
        var confirmPassword = document.getElementById("re_pass").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            document.getElementById("re_pass").value="";
            document.getElementById("re_pass").focus();
            return false;
        }
        if(document.getElementById("phno").value=="")
        {
            alert("Phone no Should not be empty!");
            document.getElementById("phno").focus();
            return false;
        }
        if(document.getElementById("adhar").value=="")
        {
            alert("Adhar no Should not be empty!");
            document.getElementById("adhar").focus();
            return false;
        }
        if(!(document.getElementById('add').checked))
        {
            alert("Location required!");
            document.getElementById("add").focus();
            return false;
        }
        return true;
    }
    
    var x = document.getElementById("demo");

    function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
    }

    function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
            }
    }

navigator.geolocation.getCurrentPosition(success, error);

    function success(position) {
    var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';
    $.getJSON(GEOCODING).done(function(location) {
    $('#latitude').html(position.coords.latitude);
    $('#longitude').html(position.coords.longitude);    
    $.ajax({
        url: 'yourfile.php',
        method: 'POST', // or GET if you want
        dataType: 'json',
        data: {
            lat: $('#latitude').val(),
            long: $('#longitude').val()
        },
        success: function(result) {}
        });
    });
    }
    function error(err) {
                 console.log(err)
    }

    </script>
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
                        <form method="POST" name="register-form" class="register-form" action="signup.php" onsubmit="return Validate()" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" autofocus/>
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
                            <input type="checkbox" id="add" onclick="getLocation()"><span class="slider round"></span></label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                            <div class="form-group form-button">
                                <p id="demo"></p>
                                <input type="hidden" id="latitude">
                                <input type="hidden" id="longitude">
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

        <!-- Sing in  Form
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link" id="login">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" action="login.php" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="your_name" id="your_name" placeholder="Your Name" 
                                value="<?php echo isset($_POST['your_name']) ? htmlentities($_POST['your_name']) : ''; ?>"
                                <?php if(isset($_SESSION["error"])){
                                        $error = $_SESSION["error"];
                                        if(!empty($error)): ?> autofocus <?php endif;}
                                      if(strlen($_SESSION["msg"])!=0){
                                        $msg=$_SESSION["msg"];
                                        if(!empty($msg)): ?> autofocus <?php endif;}?>/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label><br>
                                <?php
                                if(isset($_SESSION["error"])){
                                $error = $_SESSION["error"];
                                echo "<span>$error</span>";
                                }
                                ?>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
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
    unset($_SESSION["error"]);
?>