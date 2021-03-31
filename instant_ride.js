
    

   /* var mousePositionControl = new ol.control.MousePosition({
  coordinateFormat:ol.coordinate.createStringXY(4),
  projection: 'EPSG:4326',
  // comment the following two lines to have the mouse position
  // be placed within the map.
  className:'custom-mouse-position',
  target: document.getElementById('mouse-position'),
  undefinedHTML: ''
});

var map = new ol.Map({
  controls: ol.control.defaults().extend([mousePositionControl]),
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    })
  ],
  target: 'map',
  view: new ol.View({
    center: [0, 0],
    zoom: 2
  })
});



map.on('dblclick',function(evt){
     var coords=ol.proj.toLonLat(evt.coordinate);
      var lat=document.getElementById('d_lat');
       var long=document.getElementById('d_long');
       lat.value=coords[1].toFixed(7);
       long.value=coords[0].toFixed(7)

})*/


    function Validate() {
       
        if(document.getElementById("d_city").value=="")
        {
            alert("to city cannot not be empty!");
            document.getElementById("d_city").focus();
            return false;
        }
        if(document.getElementById("d_state").value=="")
        {
            alert("to state cannot not be empty!");
            document.getElementById("d_state").focus();
            return false;
        }
         if(document.getElementById("d_state").value=="")
        {
            alert("to state cannot not be empty!");
            document.getElementById("d_state").focus();
            return false;
        }
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
         if(document.getElementById("capacity").value=="")  
        {
            alert("Total passangers should be atleast 1");
            document.getElementById("capacity").focus();
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
        document.getElementById('d_lat').value=iframe.contentDocument.getElementById('lat').value;
        document.getElementById('d_long').value=iframe.contentDocument.getElementById('long').value;
        }


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
    



