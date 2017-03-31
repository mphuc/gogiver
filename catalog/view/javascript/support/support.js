$( document ).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).show().css({'width': '100%','height':'200px'});
                
                 $('#old_img').hide();
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('#blah').hide();
        }
    }

    $("#file").on('change' , function (env) {

         
        
        var fileExtension = [ 'jpg', 'png', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            if($("#file").val())
            {
                  
               $('.error-file').show(); 
           }
           else
           {
                $('.error-file').hide(); 
           }
            $('#comfim-pd').resetForm();
        }else
        {
            readURL(this);
            $('.error-file').hide();
            $('#old_img').hide();
        }
    });
    
    
    /*$('#form_support').on('submit', function(event) {
        alert("111111111");
        if ($('#name').val() == ""){
            $('#name').css({'border':'1px solid red'});
            return false;
        }

        if ($('#content').val() == ""){
            $('#content').css({'border':'1px solid red'});
            return false;
        }

        if ($.inArray($('#file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            if(!$("#file").val()){
               $('.error-file').show();
               return false;
           }else{
                $('.error-file').hide(); 
           }
        }else{
            $('.error-file').hide();
        }
       

        return false;

    });*/
});