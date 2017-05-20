<?php echo $self->load->controller('home/page/header'); ?>
    <style type="text/css">
     .input1,.input2{
        position: relative;
     }
     .input1 i,.input2 i{
        position: absolute;
        right: 4px;
         top: 5px;
         font-size: 26px;
         display: none;
     }
  </style>
<div id="content" class="site-content" style="background: #5472BA !important;">
  
  <div class="container" style="color: #fff">
     <div class="" style="padding-top: 50px; padding-bottom: 100px; clear: both;">
     <?php if ($_SESSION['language_id'] == "vietnamese") { ?>
        <h3 style="color: #fff">Lời ngỏ,</h3>
        <ul class="content_p">
          <li>Trong cuộc sống, dù ở bất kỳ lĩnh vực nào, muốn thành công chúng ta đều phải trả một cái giá nhất định nào đó, phải mài mò, và tìm kiếm. Không phải ai cũng có may mắn được ở trong một gia đình tốt, một môi trường hoặc một người thầy tốt để phát huy khả năng của mình.</li>
          <li>Muốn thành công, chúng ta cần nỗ lực hết mình, luôn tiếp thu những kiến thức mới và hoàn thiện bản thân. </li>
          <li>Iontach mong muốn đem  những giá trị bổ ích và thiết thực từ những gương điển hình,  bài học thành công của những người  đi trước chia sẽ lại đến với thành viên Iontach và cộng đồng người Việt.</li>
        </ul>

        <div class="img_book text-center" style="margin-top: 50px;">
          <div>
            <a target="_blank" href="http://www.hoclamgiau.vn/">
              <img src="catalog/view/theme/default/images/gttc2.png">
            </a>
            <a target="_blank" href="http://lamgiau.edu.vn/">
              <img src="catalog/view/theme/default/images/gttc3.png">
            </a>
            <a target="_blank" href="http://www.clbdayconlamgiau.com/">
              <img src="catalog/view/theme/default/images/gttc4.png">
            </a>
            <a target="_blank" href="http://chiasethanhcong.net">
              <img src="catalog/view/theme/default/images/gttc5.png">
            </a>
            <a target="_blank" href="http://lamgiau247.com/">
              <img src="catalog/view/theme/default/images/gttc6.png">
            </a>
            <a target="_blank" href="http://phamngocanh.com/blog/">
              <img src="catalog/view/theme/default/images/gttc7.png">
            </a>
            
            </div>
        </div>

        <div class="" style="clear: both;"></div>
      <?php } ?>
     </div>
  </div>
</div>
<style type="text/css">
  .img_book img{
    width: 250px;
    height: 140px;
    margin-bottom: 20px;
  }
  ul.content_p{
        font-size: 20px;
  }
</style>
<script type="text/javascript">
   jQuery(document).ready(function(){
      var delay = (function(){
        var timer = 0;
        return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
      })();
      jQuery("#amount").on('input propertychange', function() {
         jQuery('.input2 i').show();
         delay(function(){
             jQuery.ajax({
                 url : "index.php?route=home/page/conver_buy",
                 type : "post",
                 dateType:"text",
                 data : {
                     'amount' : jQuery('#amount').val(),
                     'curent_1' : jQuery('#curent_1').val(),
                     'curent_2' : jQuery('#curent_2').val()
                 },
                 success : function (result){
                     jQuery('.input2 i').hide();
                     jQuery('#amount_qd').val(result);
                 }
             });
          }, 800 );
       });

      jQuery("#amount_qd").on('input propertychange', function() {
         jQuery('.input1 i').show();
         delay(function(){
             jQuery.ajax({
                 url : "index.php?route=home/page/conver_buy",
                 type : "post",
                 dateType:"text",
                 data : {
                     'amount' : jQuery('#amount_qd').val(),
                     'curent_2' : jQuery('#curent_1').val(),
                     'curent_1' : jQuery('#curent_2').val()
                 },
                 success : function (result){
                     jQuery('.input1 i').hide();
                     jQuery('#amount').val(result);
                 }
             });
         }, 800 );
       });
      jQuery("#curent_2").on('change', function() {
          jQuery('#amount').val('');
          jQuery('#amount_qd').val('');
       });

   });
</script>
         <!-- #content -->
<?php echo $self->load->controller('home/page/footer'); ?>  