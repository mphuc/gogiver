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
        <div class="col-md-6" style="float: left;">
          <div style="padding: 15px;background: #D78D00; margin-bottom: 35px; margin: 15px; margin-top: 0">
          <h3 class="text-center" style="text-align: center;margin-bottom: 25px; color: #fff">Tỷ giá quy đổi</h3>
           <p class="text-center" style="font-size: 13px;    text-align: center; color: #fff; margin-top: -15px;">(Áp dụng tại Hội sở chính NHTMCP Ngoại thương Việt Nam)</p>
           <form>
              <div class="col-md-6" style="float: left;">
                   <div class="form-group input1">
                     <input type="text" class="form-control" id="amount" placeholder="Số tiền muốn quy đổi" >
                     <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                   </div>  
                   <div class="form-group input2">
                     
                     <input type="text" placeholder="Số tiền quy đổi" class="form-control" id="amount_qd">
                     <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                   </div>
              </div>

             <div class="col-md-6" style="float: left;">
                   <div class="form-group">
                    <select class="form-control" id="curent_1">
                       <option value="VND" selected="selected">Vietnamese Dong</option>
                     </select>
                     
                   </div>
                   <div class="form-group">
                       <select class="form-control" id="curent_2">
                       <option value="USD" selected="selected">USD</option>
                        <option value="AUD">AUD</option>
                        <option value="CAD">CAD</option>
                        <option value="CHF">CHF</option>
                        
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="HKD">HKD</option>
                        
                        <option value="JPY">JPY</option>
                        <option value="KRW">KRW</option>
                        
                        <option value="SGD">SGD</option>
                        <option value="THB">THB</option>
                        
                     </select>
                   </div>
              </div>
           </form>
           <div style="clear: both;margin-bottom: 15px"></div>
          </div>

           <div class="col-md-12">
             <!--  <script type="text/javascript" src="http://giavangvn.org/TyGiaScript/short/Widgets"> </script> -->
              <iframe id="fr51" style="border: none;" src="//www.tygia.com/api.php?column=1&amp;title=0&amp;chart=0&amp;gold=1&amp;rate=1&amp;expa
nd=0&amp;color=eeeeee&amp;titlecolor=111111&amp;bgcolor=ffffff&amp;upcolor=00aa00&amp;downcolor=bb0000&amp;textcolor=333333&amp;ngan
hang=VIETCOM&amp;fontsize=80&amp;ngoaite=usd,jpy,chf,eur,gbp,aud,cad,hkd,krw,sgd,thb,dkk,inr,sek,sar,rub,nok,myr,kwd&amp;change=1&amp;column=2&amp;css=%23SJC_N_ng{display:%20table-row%20!important;}" width="100%" height="535"></iframe>
           </div>
        </div>
        <div class="col-md-6" style="float: left;">
            <!-- <script type="text/javascript" src="http://giavangvn.org/GiavangFullScript/dat-gia-vang/Widgets"> </script> -->
            <iframe id="fr4" style="border: none; width: 100%;" src="//www.tygia.com/api.php?column=1&amp;title=0&amp;chart=0&amp;gold=1&amp;rat
e=0&amp;expand=2&amp;color=284C84&amp;nganhang=VIETCOM&amp;fontsize=80&amp;change=0" width="100%" height="680"></iframe>
        </div>
        <div class="" style="clear: both;"></div>
      <?php } ?>
     </div>
  </div>
</div>

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