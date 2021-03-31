function Validate() {
        if(document.getElementById("lat").value=="")
        {
            alert("Location required!Either paste it from google map or select current loation");
            document.getElementById("lat").focus();
            return false;
        }
        if(document.getElementById("long").value=="")
        {
            alert("Location required!Either paste it from google map or select current loation");
            document.getElementById("long").focus();
            return false;
        }
        if(document.getElementById("pu").value=="")
        {
            alert("Select pickup");
            document.getElementById("pu").focus();
            return false;
        }
        if(document.getElementById("dest").value=="")
        {
            alert("Select destination");
            document.getElementById("dest").focus();
            return false;
        }
        if(document.getElementById("d_lat").value=="")
        {
            alert("Location required!Either paste it from google map or select current loation");
            document.getElementById("d_lat").focus();
            return false;
        }
        if(document.getElementById("d_long").value=="")
        {
            alert("Location required!Either paste it from google map or select current loation");
            document.getElementById("long").focus();
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
            alert("Choose Date & Time info");
            document.getElementById("start_time").focus();
            return false;
        }
        return true;
    }
     
     var iframe;
     function getdestinationloc(){
         var loc=document.getElementById('d_add');
         if(loc.checked){
             document.getElementById('frame').style.display='block';
            iframe= document.getElementById('frame');
         }
         else{
             document.getElementById('frame').style.display='none';
             document.getElementById('d_lat').value='';
             document.getElementById('d_long').value='';
            
             }
     }



    function read_destination(){
        if(iframe){
        document.getElementById('d_lat'+r).value=iframe.contentDocument.getElementById('lat').value;
        document.getElementById('d_long'+r).value=iframe.contentDocument.getElementById('long').value;
        }
       

    }

 var r='';
    /*function add_route(){
        routes=document.getElementById('routes');
        routes.innerHTML=routes.innerHTML+"<h1>Hello World!</h1>";
    }*/


    function add_route(){
         if(r==''){
            r=1;
        }
        else{
            r+=1;}

        
        var div = document.createElement("div");
        var label = document.createElement("H3");
        label.className ="form-title";
        div.className = "form-group";
        parent=document.getElementById('routes');
        inner=parent.appendChild(label);
        inner.innerHTML="place"+r;
        
        inner=parent.appendChild(div);
       
        
        inner.innerHTML="<label for='d_lat"+r+"'><i class='zmdi-my-location'></i></label><input type='decimal' name='d_lat"+r+"' id='d_lat"+r+"' placeholder='destination latitude' autofocus/>";    
        
        var div = document.createElement("div");

        div.className = "form-group";
        parent=document.getElementById('routes');
        inner=parent.appendChild(div);
        inner.innerHTML="<label for='d_long"+r+"'><i class='zmdi-my-location'></i></label><input type='decimal' name='d_long"+r+"' id='d_long"+r+"'placeholder='destination longitude' autofocus/>"
        
    }



 


    

    function geolocation(){
        var loc=document.getElementById('add');
        if(loc.checked){
        
        
    if(geoPosition.init()){
			geoPosition.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
		}
		else{
			document.getElementById('result').innerHTML = '<span class="error">Functionality not available</span>';
		}

		function success_callback(p)
		{   
            console.log(p.coords)
            var ori_latitude=parseFloat( p.coords.latitude );
            var ori_longitude=parseFloat( p.coords.longitude );
			var latitude = ori_latitude.toFixed(9);
			var longitude =ori_longitude.toFixed(9);
            console.log(latitude);
            console.log(longitude);
			document.getElementById('lat').value = latitude;                                                                                           ;
			document.getElementById('long').value = longitude;	

            
            const myiframe = document.getElementById('frame');
            
            console.log(myiframe.contentWindow);
            myiframe.contentWindow.postMessage([ori_longitude.toFixed(9),ori_latitude.toFixed(9)], '*');
		}
		
		function error_callback(p)
		{
			document.getElementById('result').innerHTML = '<span class="error">' + p.message + '</span>';			
		}}
    }


    //map function