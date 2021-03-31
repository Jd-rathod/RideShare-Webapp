
var mousePositionControl = new ol.control.MousePosition({
  coordinateFormat:ol.coordinate.createStringXY(4),
  projection: 'EPSG:4326',
  // comment the following two lines to have the mouse position
  // be placed within the map.
  className: 'custom-mouse-position',
  target: document.getElementById('mouse-position'),
  undefinedHTML: ''
});

//var CENTER=[71.1923805, 22.258652];

var map;


function btn_click(){
 
  doc=window.top.contentDocument();
  console.log(doc);}


function load_map(CENTER){

 map = new ol.Map({
  controls: ol.control.defaults().extend([mousePositionControl]),
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    })
  ],
  target: 'map',
  view: new ol.View({
    center: ol.proj.fromLonLat(CENTER),
    zoom: 15
  })
});


map.on('dblclick',function(evt){
     var coords=ol.proj.toLonLat(evt.coordinate);
      var lat=document.getElementById('lat');
       var long=document.getElementById('long');
       lat.value=coords[0].toFixed(7);
       long.value=coords[1].toFixed(7);
      
      console.log(window.frames);
}); 

}
window.onmessage = function(e){
  console.log(e.data);
  CENTER=[parseFloat(e.data[1]),parseFloat(e.data[0])];
  console.log(CENTER);
  load_map(CENTER); 
    };