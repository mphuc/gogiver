<?php
   $self -> document -> setTitle('DANH SÁCH PH');
   echo $self -> load -> controller('common/header');
   echo $self -> load -> controller('common/column_left');
   ?>
<!-- Form-validation -->
<div class="main-content">
<!-- Start .content -->
  <div class="content" style="">
     <div class="row">
        <!-- .row start -->
        <div class="col-md-12">
           <!-- col-md-12 start here -->
           <div class="panel panel-default" id="dash_0">
              <!-- Start .panel -->
              <div class="panel-heading">
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>Danh Sách PH</h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                       <div class="input-group input-icon file-upload">
                        <div class="widget-content" style="padding:10px">
                             <div style="margin-bottom: 20px; float:right;" class="col-md-12">
                                <a class="pull-right btn-register btn btn-primary" href="index.php?route=account/pd/create">Tạo PH</a>
                             </div>
                             <div class="clearfix"></div>
                             <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php $num = 1; foreach ($pds as $value => $key){ ?>
                                <div class="list_ph" style="padding-bottom: 20px;">
                                   <div class="Head" role="tab" id="headingOne<?php echo $key['pd_number'] ?>">
                                      
                                      <h4>PH : <strong>PH<?php echo $key['pd_number'] ?></strong></h4>
                                      <table  class="table">
                                        <tbody>
                                          <tr>
                                            <td>Ngày tạo</td>
                                            <td>UserID PH</td>
                                            <td>Số tiền</td>
                                            <td>Lợi nhuận</td>
                                            <td>Thời gian chờ </td>
                                            <td>Trạng thái</td>
                                            <td rowspan="2">
                                            <a class="pull-right btn btn-primary" style="margin-top:15px;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key['pd_number'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $key['pd_number'] ?>">
                                            <i class="short-full fa  fa-list glyphicon-plus glyphicon-minus"></i>
                                            Chi tiết
                                            </a></td>
                                          </tr>
                                          <tr>
                                            <td><strong><?php echo date("d/m/Y", strtotime($key['date_added'])); ?></strong></td>
                                            <td><strong><?php echo $key['username'] ?></strong></td>
                                            <td><strong><?php echo number_format($key['filled']); ?> <?php echo $lang['VND'] ?></strong></td>
                                            <td><strong><?php echo number_format($key['max_profit']); ?> <?php echo $lang['VND'] ?></strong></td>
                                            <td><strong><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo intval($key['status']) == 0 ? $key['date_finish_forAdmin'] : $key['date_finish']; ?>">
                                         </span> </strong></td>
                                            <td><strong><span class=""><?php switch ($key['status']) {
                                         case 0:
                                             echo '<span class="label label-inverse">Đang chờ</span>';
                                             break;
                                         case 1:
                                             echo '<span class="label label-info">Khớp lệnh</span>';
                                             break;
                                         case 2:
                                             echo '<span class="label label-success">Kết thúc</span>';
                                             break;
                                         case 3:
                                             echo '<span class="label label-danger">Báo cáo</span>';
                                             break;
                                         } ?></span></strong></td>
                                         
                                          </tr>
                                         
                                            
                                         
                                        </tbody>
                                      </table>  
                                   </div>
                                   <div id="collapseOne<?php echo $key['pd_number'] ?>" class="ph_collapse panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $key['pd_number'] ?>">
                                      <div class="_detail_ph">
                                         <?php 
                                            $show_transfer = $self -> show_transfer($key['id']); 
                                            if (!$show_transfer) {
                                              echo '<p class="text-warning"> Please waiting!!!!';
                                            }else {
                                              echo $show_transfer;
                                            }
                                        
                                            ?>
                                      </div>
                                   </div>
                                </div>
                                <?php $num++; } ?>
                             </div>
                             <!-- panel-group -->
                             <script>
                                function toggleIcon(e) {
                                    $(e.target)
                                        .prev('.Head')
                                        .find(".short-full")
                                        .toggleClass('glyphicon-plus glyphicon-minus');
                                }
                                $('.panel-group').on('hidden.bs.collapse', toggleIcon);
                                $('.panel-group').on('shown.bs.collapse', toggleIcon);
                             </script>
                             
                             <!-- panel-body -->
                          </div>
                       </div>
                    </div>
                 </div>
              </div>

           </div>
           <div class="clearfix" style="margin-top:80px;"></div>
        </div>
        <!-- col-md-12 end here -->
     </div>
     <!-- / .row -->
  </div>
</div>
<!-- End row -->
<div class="content_upload" style="display:none">
   <form id="comfim-pd" action="<?php echo $confim_action; ?>" method="POST"  enctype="multipart/form-data">
      <input class="file" type="file" name="avatar" value="" required="" placeholder="Chọn file">
      <input type="hidden" name="id_tranfer" class="id_tranfer" value="" placeholder="">
      <img src="" class="blah" alt="">
      <div class="error-file"  style="display:none">Không phải file ảnh</div>
      <div class="clearfix"></div>
      <input type="submit" value="OK" style="">
   </form>
</div>
</div>
<style type="text/css" media="screen">
   .ajs-primary.ajs-buttons{
   display: none;
   }
   #comfim-pd{
   text-align: center;
   }
   .ajs-content{
   text-align: center;
   }
   form input[type="submit"]{
   width: 120px;
   height: 40px;
   float: left;
   margin-top: 15px;
   color: #fff;
   background: #087DBA;
   border-radius: 5px;
   clear: both;
   }
   .blah{
   max-height: 350px;
   max-width:350px;
   margin-top: 10px;
   clear: both;
   }
</style>
<script type="text/javascript">
   function viewImage (image) {
     alertify.confirm('Hóa đơn của bạn', '<img style="width:100%" src="'+image+'"/>', function(){  }, function(){ });
   }
   
   if(location.hash){
     var image = location.hash.replace('#','');
     viewImage(image);
   }
   
   function upload(id){
     $('.id_tranfer').val(id);
   
     $('.ajs-button.ajs-ok').hide();
     alertify.confirm('Tìm hóa đơn', $('.content_upload').html(), function(){  }, function(){ });
     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
   
             reader.onload = function (e) {
                 $('.blah').attr('src', e.target.result).show().css({'width': '100%'});
             }
   
             reader.readAsDataURL(input.files[0]);
         }else{
             $('.blah').hide();
         }
     }
     $(".file").on('change' , function (env) {
         readURL(this);
         var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
         if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
             if($(".file").val()){
                $('.error-file').show();
            }else{
                 $('.error-file').hide();
            }
             $('#comfim-pd').resetForm();
             $(".blah").css({'display':'none'});
             $(".file").val('');
             $('.error-file').show();
         }else{
             $('.error-file').hide();
         }
     });
   }
   $('.show_image').click(function(){
   
      var id = $(this).data('id');
       $('.id_tranfer').val(id);
   
       $.ajax({
         url : '<?php echo $show_image;?>',
         type : 'POST',
         data : {'id_tranfer' : id},
         success:function(data) {
           alertify.confirm('',data, function(){  }, function(){ });
         }
       });
   
   })
</script>
<?php echo $self->load->controller('common/footer') ?>