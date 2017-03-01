/*$(function() {
	$('.xemthem_load').on('click',function(){
		$(this).button('loading');
		num = $(this).attr('number');
		base_url = $(this).data('base_url');
		$.post(base_url+'main/xemthem_load',{"number":num}).done(
	        function(data){ 
	        	if (data != "hetsp")
	        	{
	        		$('.themsanpham_item').append(data);
		            $('.xemthem_load').attr('number',parseInt(num)+8);
		            $('.xemthem_load').removeClass('disabled');
		            $('.xemthem_load').html('Xem thêm...');	
	        	}
	        	else
	        	{
	        		$('.xemthem_load').hide();
	        	}
	            
	        });    
		});
	$(window).scroll(function(){

		
    })
});*/