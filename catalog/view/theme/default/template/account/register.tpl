<?php
   $self -> document -> setTitle($lang['heading_title']);
   echo $self -> load -> controller('common/header');
   echo $self -> load -> controller('common/column_left');
   ?>
<div class="main-content">
<!-- Start .content -->

  <div class="content" style="">
   <?php 
        $pin = $self -> check_pin(); 
    ?>
    <?php /*if ($pin < 10) { ?>

   
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
             
              <h2><?php echo $lang['buy_more_pin'] ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php die(); */}  ?>
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
                                          <form id="register-account" action="<?php echo $self -> url -> link('account/register', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
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
                                                   <input data-url="<?php echo $self -> url -> link('account/register/getjson', '', 'SSL'); ?>" autocomplete="off" class="form-control" name="account_number" id="account_number" value="" data-link="<?php echo $self -> url -> link('account/register/checkcmnd', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_numberbank'] ?>"/>
                                                   <span><i class=" fa fa-cog fa-spin fa-fw"></i></span>
                                                </div>

                                                
                                                <div class="col-md-6">
                                                   <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo $lang['text_Password'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control" name="account_holder" id="account_holder" value="" readonly="true" placeholder="<?php echo $lang['name_bank'] ?>"/>
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control valid" id="confirmpassword" type="password" placeholder="<?php echo $lang['text_Repeat_Password'] ?>" />
                                                </div>



                                                 <div class="col-md-6">
                                                   <input  class="form-control" id="password2" name="password2" type="password" placeholder="<?php echo $lang['text_Transaction_Password'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control valid" id="confirmpasswordtransaction" type="password" placeholder="<?php echo $lang['text_Repeat_Transaction_Password'] ?>" />
                                                </div>



                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="email" id="email" data-link="<?php echo $self -> url -> link('account/register/checkemail', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_email'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="telephone" id="phone" data-link="<?php echo $self -> url -> link('account/register/checkphone', '', 'SSL'); ?>" placeholder="<?php echo $lang['text_phone'] ?>" />
                                                </div>
                                                  <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="cmnds" id="cmnds" placeholder="<?php echo $lang['text_cmnd'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                 <span class="text-info"style=" font-size: 20px; "><?php echo $lang['text_cmnd'] ?></span>
                                                    <span class="edit_icon">
                                               <input type="file" name="avatar" id="file"  accept="image/jpg,image/png,image/jpeg,image/gif" style="visibility: hidden; width: 1px; height: 1px"> 
                                            
                                               <a href="" onclick="document.getElementById('file').click(); return false">
                                               <img id="blah" src="#" style="display:none;" />                                         
                                               <img id="old_img" src="catalog/view/theme/default/img/citizencard.png" alt=""></a>
                                             
                                             
                                               </span>
                                                  <div class="error-file alert alert-dismissable alert-danger" style="display:none; margin:20px 0px;">
                                                                <i class="fa fa-fw fa-times"></i>Please chosen image with : 'jpeg', 'jpg', 'png', 'gif', 'bmp'
                                                            </div>       
                                               
                                                </div>

                                                <div class="clearfix"></div>
                                                <div id="success"></div>
                                                <br/>
                                                <div class="col-md-12">
                                                   <button type="submit" class="btn-register btn btn-warning pull-right ">Submit</button>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                       <div class="row">

                                          <div class="col-md-12" >
                                             <?php echo $lang['text_register'] ?>
                                             <br/>
                                          </div>

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
