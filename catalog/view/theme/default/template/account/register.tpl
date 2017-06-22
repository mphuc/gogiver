<?php
   $self -> document -> setTitle($lang['heading_title']);
   echo $self -> load -> controller('common/header');
   echo $self -> load -> controller('common/column_left');
   ?>
<div class="clearfix"></div>
<div class="main-content">
<!-- Start .content -->

  <div class="content" style="">
   <?php 
        $pin = $self -> check_pin(); 
    ?>
    <?php if ($pin < 3) { ?>
      <h2><?php echo $lang['buy_more_pin'] ?></h2>
            
  <?php die(); }  ?>
     <div class="row">
        <!-- .row start -->
        <div class="col-md-12">
           <!-- col-md-12 start here -->
           <div class="panel panel-default" id="dash_0">
              <!-- Start .panel -->
              <div class="panel-heading">
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['heading_title'] ?></h4>
              </div>


              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content">

                           <div class="col-sm-12">
                              <div class="">
                                 <div class="border_">
                                    
                                    <div class="panel-body">
                                       <div class=" form">
                                          <form id="register-account" action="<?php echo $self -> url -> link('account/register', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data" autocomplete="off" >
                                             <div class="row">
                                                <div class="col-md-6" style="display: none">
                                                   <select class="form-control" name="bank_name" id="bank_name">
                                                     <option value="" disabled>Chọn ngân hàng</option>
                                                     <option selected value="Vietcombank">Vietcombank</option>
                                                     <option value="Sacombank">Sacombank</option>
                                                     <option value="BIDV">BIDV</option>
                                                     <option value="Viettinbank">Viettinbank</option>
                                                     <option value="Agribank">Agribank</option>
                                                    
                                                   </select>              
                                                </div>
                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="username" id="username" value="" data-link="<?php echo $self -> url -> link('account/register/checkuser', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_username'] ?>"/>               
                                                </div>
                                                <div class="col-md-6 conf-vcb">
                                                   <input data-url="<?php echo $self -> url -> link('account/register/getjson', '', 'SSL'); ?>" autocomplete="off" class="form-control" name="account_number"  id="account_number" value="" data-link="<?php echo $self -> url -> link('account/register/checkcmnd', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_numberbank'] ?>"/>
                                                   <span><i class=" fa fa-cog fa-spin fa-fw"></i></span>
                                                </div>

                                                
                                                <div class="col-md-6">
                                                   <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo $lang['text_Password'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control" name="account_holder" id="account_holder" value="" readonly="true"  placeholder="<?php echo $lang['name_bank'] ?>"/>
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control valid" id="confirmpassword" type="password" placeholder="<?php echo $lang['text_Repeat_Password'] ?>" />
                                                </div>

                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="email" id="email" data-link="<?php echo $self -> url -> link('account/register/checkemail', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_email'] ?>" />
                                                </div>
  
                                                 <div class="col-md-6">
                                                   <input  class="form-control" id="password2" name="password2" type="password" placeholder="<?php echo $lang['text_Transaction_Password'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input autocomplete="off" type="number"  class="form-control" name="telephone" id="phone" data-link="<?php echo $self -> url -> link('account/register/checkphone', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_phone'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control valid" id="confirmpasswordtransaction" type="password" placeholder="<?php echo $lang['text_Repeat_Transaction_Password'] ?>" />
                                                </div>
                                                

                                                
                                                
                                                  <div class="col-md-6">
                                                   <input type="number" autocomplete="off"  class="form-control" name="cmnds" id="cmnds" placeholder="<?php echo $lang['text_cmnd'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                 <span class="text-info"style=" font-size: 20px; "><?php echo $lang['text_cmnd_img'] ?></span>
                                                    <span class="edit_icon">
                                               <span class="input-group-btn pull-left"> 
                                              
                                                </span>
                                              <!-- <div class="" style="position: relative;">
                                                <a style="position: absolute; width: 100%;
                                                height: 260px; opacity: 0" href="<?php echo HTTPS_SERVER ?>kcfinder/browse.php?type=image" class="iframe-btn btn btn-default" type="button" onclick="openKCFinder()">
                                              </a>
                                                <input style="width: 100%;" type="hidden" class="form-control" id="fieldID" name="Image"">
                                                
                                                <div class="clearfix"></div>
                                                  
                                                <div class="image_item text-center"> 
                                                    <img style="margin-top: 15px; width: 100%; height: 250px" id="thumb_image" class="fancybox_image" src="<?php echo HTTPS_SERVER ?>catalog/view/theme/default/images/notFound.png"> 
                                                </div> 
                                                  <div class="error-file alert alert-dismissable alert-danger" style="display:none; margin:20px 0px;">
                                                                <i class="fa fa-fw fa-times"></i>Please chosen image with : 'jpeg', 'jpg', 'png', 'gif', 'bmp'
                                                            </div>       
                                              </div> -->


                                            <div class="" style="position: relative;">
                                              <input type="file" id="file" name="avatar" style="position: absolute; width: 100%;
                                                height: 270px; opacity: 0;left: 0;top: 0">

                                              <img style="display: none;" id="blah" style="margin-top: 15px; width: 100%; height: 250px" id="thumb_image" class="fancybox_image" src=""> 
                                              <img id="old_img" style="margin-top: 15px; width: 100%; height: 250px" src="<?php echo HTTPS_SERVER ?>catalog/view/theme/default/images/notFound.png">
                                              <div class="error-file alert alert-dismissable alert-danger" style="display:none; margin:20px 0px;">
                                                                <i class="fa fa-fw fa-times"></i>Please chosen image with : 'jpeg', 'jpg', 'png', 'gif', 'bmp'
                                                            </div>       
                                            </div>


                                                </div>
                                                <div class="col-md-6">
                                                  <br>
                                                  <?php echo $lang['text_Submitssss'] ?>
                                                  <p style="margin-top: 30px;"><input id="toi_dong_y" style="float: left;" type="checkbox" name=""><b class="toi_dong_y" style="float: left;margin-top: -10px;margin-left: 32px;"><?php echo $lang['toi_dong_y'] ?></b></p>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div id="success"></div>
                                                <br/>
                                                <div class="col-md-12 text-center">
                                                   <button type="submit" style="width: 45%; font-size: 18px;" class="btn-register btn btn-success " disabled><?php echo $lang['Submit_dk'] ?></button>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                       <div class="row">

                                          

                                          <div class="col-md-12">
                                             <!-- <p><?php echo $lang['url_link'] ?>:</p>
                                             <a style="word-break: break-word; font-weight:700; color:cyan" href="signup&ref=<?php echo $customer_code;  ?>" target="_blank"><?php echo HTTPS_SERVER ?>signup&ref=<?php echo $customer_code;  ?></a> -->
                                          </div>
                                       </div>
                                       <!-- .form -->
                                    </div>

                                    <!-- panel-body -->
                                 </div>

                                 <!-- panel -->
                              </div>
                           </div>

                           <!-- col -->
                        </div>

                      </div>
                 </div>

              </div>
           </div>
        </div>


   
    <script type="text/javascript">
      $('#upload_form').on('submit',function(){
          var form_data = new FormData('#upload_form');
          $.ajax({
            url : "index.php?route=account/register/update_file",
            type: "POST",
            data : form_data,
            contentType: false,
            cache: false,
            processData:false,
            mimeType:"multipart/form-data"
          }).done(function(res){ //
            
          });

          return false;
      })
      
    </script>


        <div class="clearfix" style="margin-top: 100px;"></div>
     </div>
  </div>
</div>

<?php echo $self->load->controller('common/footer') ?>

<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 10);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Account registration successful!!');
   }

</script>
