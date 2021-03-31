/*  ==========================================
    ADD specification 
* ========================================== */

var r='';
function add_specification (){
         if(r==''){
            r=1;
        }
        else{
            r+=1;}

        
        var div = document.createElement("div");
        var label = document.createElement("H3");
        label.className ="form-title";
        div.className = "form-group";
        parent=document.getElementById('specifications');
        inner=parent.appendChild(label);
        inner.innerHTML="feature"+r;
        
        inner=parent.appendChild(div);
       
        
        inner.innerHTML="<label for='type"+r+"'><i class='zmdi-my-location'></i></label><input type='text' list='specification_types' name='type"+r+"' id='type"+r+"'  placeholder='type of specification' autofocus/>";    
    
        var div = document.createElement("div");

        div.className = "form-group";
        parent=document.getElementById('specifications');
        inner=parent.appendChild(div);
        inner.innerHTML="<label for='value"+r+"'><i class='zmdi-my-location'></i></label><input type='text' name='value"+r+"' id='value"+r+"'  placeholder='value' autofocus/>"
        
    }





/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        console.log('here');
        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
            
        };
        reader.readAsDataURL(input.files[0]);
    }
}
/*function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult1')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}*/

/*$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});*/

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
window.onload=function(){
var input = document.getElementById( 'upload' );
console.log(input);
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
    console.log("here");
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}};
    