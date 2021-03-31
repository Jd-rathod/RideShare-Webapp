

function readURL(input) {
     var edit=document.getElementById('edit');
    edit.style.display='none';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_display')
                .attr('src', e.target.result);
            
        };
    
         
        
        reader.readAsDataURL(input.files[0]);
    
       
    }
    submit_form();
}


 function submit_form(){
   
    document.getElementById('profile_submit_form').submit();
}


