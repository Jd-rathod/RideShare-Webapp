function Valid() {
        if(document.getElementById("usrid").value=="")
        {
            alert("User_Id Should not be empty!");
            document.getElementById("userid").focus();
            return false;
        }
        if(document.getElementById("usrname").value=="")
        {
            alert("Name Should not be empty!");
            document.getElementById("usrname").focus();
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
        if(!(document.getElementById("add").checked))
        {
            alert("Location required!");
            document.getElementById("add").focus();
            return false;
        }
        if(document.getElementById("driver").checked) { 
            document.getElementById("as").value 
                = document.getElementById("driver").value;
        }
        if(document.getElementById("user").checked) { 
            document.getElementById("as").value 
                = document.getElementById("user").value;
        }
        if(!(document.getElementById("driver").checked) && !(document.getElementById("user").checked))  {
            alert("select your login role");
            return false;
        } 
        return true;
    }