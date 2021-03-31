var iframe;
     function getdestinationloc(){
         var loc=document.getElementById('d_add');
         if(loc.checked){
             document.getElementById('frame').style.display='block';
            iframe= document.getElementById('frame');
         }
         else{
             document.getElementById('frame').style.display='none';
             console.log('here');
             geo();
            
             }
     }



    function read_destination(){
        if(iframe){
        document.getElementById('lat').value=iframe.contentDocument.getElementById('lat').value;
        document.getElementById('long').value=iframe.contentDocument.getElementById('long').value;
        }


    }



    
    
    window.onload=function (){
       
     
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
			var latitude = ori_latitude.toFixed(7);
			var longitude =ori_longitude.toFixed(7);
            console.log(latitude);
            console.log(longitude);
			document.getElementById('lat').value = latitude;                                                                                           ;
			document.getElementById('long').value = longitude;	

            
            const myiframe = document.getElementById('frame');
            
            console.log(myiframe.contentWindow);
            myiframe.contentWindow.postMessage([ori_longitude.toFixed(7),ori_latitude.toFixed(7)], '*');
		}
		
		function error_callback(p)
		{
			document.getElementById('result').innerHTML = '<span class="error">' + p.message + '</span>';			
		}
    };

      function geo(){
        
        
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
			var latitude = ori_latitude.toFixed(7);
			var longitude =ori_longitude.toFixed(7);
            console.log(latitude);
            console.log(longitude);
			document.getElementById('lat').value = latitude;                                                                                           ;
			document.getElementById('long').value = longitude;	

            
            
		}
		
		function error_callback(p)
		{
			document.getElementById('result').innerHTML = '<span class="error">' + p.message + '</span>';			
		}
    };
//window.onload=geolocation();


    //map function
    



