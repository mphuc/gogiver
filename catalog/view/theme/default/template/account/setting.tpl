<?php
   $self -> document -> setTitle($lang['heading_title']);
   echo $self -> load -> controller('common/header');
   echo $self -> load -> controller('common/column_left');
   ?>
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['heading_header'] ?></h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content">
      <div class="col-md-12">
         <div class="">
           
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="page-tabs" style="margin-bottom:15px">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#EditProfile" ><?php echo $lang['text_account'] ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#ChangePassword"><?php echo $lang['text_password'] ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#ChangePassword2"><?php echo $lang['text_transaction_password'] ?></a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#BitcoinWallet"><?php echo $lang['text_bank'] ?></a>
                            </li>
                             <li>
                                <a data-toggle="tab" href="#Verify">Citizenship Card/Passport</a>
                            </li>

                        </ul>
                    </div>
                    <div class="account container-fluid">
                            <!-- Content Row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-edit-account" style="display:none">
                                        <i class="fa fa-check"></i> Edit account successfull
                                    </div>
                                </div>
                            </div>
                            <div class="row tab-content">
                                <!-- Content Row -->
                                <div class="tab-pane active" id="EditProfile" data-link="<?php echo $self -> url -> link('account/setting/account', '', 'SSL'); ?>" data-id="<?php echo $self->session -> data['customer_id'] ?>" >
                                    
                                    <div class=""  >
                                        <div class="col-lg-6 col-md-6">
                                          <form id="updateProfile" action="<?php echo $self -> url -> link('account/setting/update_profile', '', 'SSL'); ?>" method="POST" novalidate="novalidate">
                                            <div class="">

                                                <div class="">
                                                    <div class="control-group form-group">
                                                        <div class="controls">

                                                            <label class="control-label" for="UserName"><?php echo $lang['text_username'] ?></label>
                                                            <div class="">
                                                                <input class="form-control valid" id="UserName" name='username'  type="text" readonly='true' value="" data-link="<?php echo $self -> url -> link('account/register/checkuser', '', 'SSL'); ?>" />
                                                                <span id="UserName-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                       <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="col-md-2 control-label" for="Level"><?php echo $lang['text_level'] ?></label>
                                                            <div class="col-md-9">
                                                                <label class="control-label">
                                                                    <code id="Level">

                                                                    </code>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="Email"><?php echo $lang['text_email'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" readonly='true' data-link="<?php echo $self -> url -> link('account/register/checkemail', '', 'SSL'); ?>" id="Email" name="email"  type="text" value=""/>
                                                                <span id="Email-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="Phone"><?php echo $lang['text_phone'] ?></label>
                                                            <div class="">
                                                                <input data-link="<?php echo $self -> url -> link('account/register/checkphone', '', 'SSL'); ?>" readonly='true' class="form-control" id="Phone" name="telephone" type="text" value=""/>
                                                                <span id="Phone-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="Country">Country</label>
                                                            <div class="">
                                                                 <select name="country_id" id="input-country" class="form-control">
                                                                    <option value="">--Please Select--</option>
                                                                    <?php foreach ($countries as $country) { ?>
                                                                    <?php if ($country['country_id'] == $country_id) { ?>
                                                                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                                                    <?php } else { ?>
                                                                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                  </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="Country">Province</label>
                                                            <div class="">
                                                                 <select name="zone_id" id="input-country" class="form-control">
                                                                    <option value="">--Please Select--</option>

                                                                    <?php foreach ($zone_byid as $country) { ?>
                                                                    <?php if ($country['zone_id'] == $zone_id) { ?>
                                                                    <option value="<?php echo $country['zone_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                                                    <?php } else { ?>
                                                                    <option value="<?php echo $country['zone_id']; ?>"><?php echo $country['name']; ?></option>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                  </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                     <button type="submit" class="btn btn-primary"><?php echo $lang['wallet_btn'] ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- <div class="col-lg-6 col-md-6">
                                            <p>Xác thực CMND:</p>
                                             <form id="comfim-pd" action="<?php echo $self -> url -> link('account/setting/avatar', '', 'SSL'); ?>" method="POST" enctype="multipart/form-data">
                                                   <span class="edit_icon">
                                                      <input type="file" name="avatar" id="file"  accept="image/jpg,image/png,image/jpeg,image/gif" style="visibility: hidden; width: 1px; height: 1px"> 
                                                     <?php if(!$customer['img_profile']){ ?>
                                                     <a href="" onclick="document.getElementById('file').click(); return false">
                                                     
                                                     <img id="blah" src="#" style="display:none;" />                                         
                                                     <img id="old_img" src="catalog/view/theme/default/img/admin_edit_icon.png" alt=""></a>
                                                     <?php } ?>
                                                     <?php if($customer['img_profile']){ ?>
                                                     <a href="<?php echo $self -> url -> link('account/setting', '', 'SSL'); ?>">
                                                                      
                                                     <img id="old_img" src="<?php echo $customer['img_profile'] ?>" alt="" style="
    width: 100%;
    height: 210px;
"></a>
                                                     <?php } ?>
                                                  </span>
                                                   <div id="btn_save" style="display:none;
                                               margin-bottom: 20px;margin-top: 20px;
                                            " >
                                                   <button type="submit" class="btn-primary btn">Lưu</button>
                                                </div>
                                               </form>
                                        </div> -->
                                    </div>
                                
                                
                                </div>
                                <div class="tab-pane" id="ChangePassword">
                                    <form id="frmChangePassword" action="<?php echo $self -> url -> link('account/setting/editpasswd', '', 'SSL'); ?>"  method="post" novalidate="novalidate">
                                        <div class="col-lg-6">
                                            <div class="">

                                                <div class="">
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="OldPassword"><?php echo $lang['text_old_password'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" id="OldPassword" type="password" data-link="<?php echo $self -> url -> link('account/setting/checkpasswd', '', 'SSL'); ?>" />
                                                                <span id="OldPassword-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="Password"><?php echo $lang['text_new_password'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" id="Password" name="password" type="password"/>
                                                                <span id="Password-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="ConfirmPassword"><?php echo $lang['text_confirm_password'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" id="ConfirmPassword"  type="password"/>
                                                                <span id="ConfirmPassword-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <div class="control-group form-group">
                                                        <div class="controls">
                                                           <button type="submit" class="btn btn-primary"><?php echo $lang['text_button_password'] ?></button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="ChangePassword2">
                                    <form id="changePasswdTransaction" action="<?php echo $self -> url -> link('account/setting/edittransactionpasswd', '', 'SSL'); ?>" class="" method="post" novalidate="novalidate">
                                        <div class="col-lg-6">
                                            <div class="">

                                                <div class="">
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="TranoldPassword"><?php echo $lang['text_old_password'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" id="TranoldPassword" type="password" data-link="<?php echo $self -> url -> link('account/setting/checkpasswdtransaction', '', 'SSL'); ?>" />
                                                                <span id="TranoldPassword-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="Tranpassword"><?php echo $lang['text_new_password'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" id="Tranpassword_New" name="transaction_password" type="password"/>
                                                                <span id="Tranpassword_New-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="TranConfirmPassword"><?php echo $lang['text_confirm_password'] ?></label>
                                                            <div class="">
                                                                <input class="form-control" id="TranConfirmPassword" type="password"/>
                                                                <span id="TranConfirmPassword-error" class="field-validation-error" style="display:none">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="control-group form-group">
                                                        <div class="controls">
                                                             <button type="submit" class="btn btn-primary"><?php echo $lang['text_button_password'] ?></button>
                                                                  <a data-link="<?php echo $self -> url -> link('account/forgotten/resetPasswdTran', '', 'SSL'); ?>" data-id="<?php echo $self->session -> data['customer_id'] ?>" id="reset_passwdTran" href="javascript:;" class="btn btn-danger"><?php echo $lang['text_button_transaction_password'] ?></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane" id="BitcoinWallet">

                                    <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert account-bank" style="display:none">
                                            <i class="fa fa-check"></i> Edit bank successfull
                                            </div>
                                        </div>
                                    </div>
                                        <div class="">
                                            <div class="" id="Banksinfo" data-link="<?php echo $self -> url -> link('account/setting/banks', '', 'SSL'); ?>" data-id="<?php echo $self->session -> data['customer_id'] ?>"></div>
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-lg-6">

                                                            <div style="margin-bottom:20px">
                                                                <label for="Accountholders"><?php echo $lang['text_account_holder'] ?></label>
                                                                <input <?php echo $banks['account_holder'] ? 'readonly="true"' : ''?> class="form-control" id="Accountholders" name="account_holder" value="<?php echo $banks['account_holder'] ?>" type="text"/>
                                                                <span id="Accountholders-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                            <div style="margin-bottom:20px">
                                                                <label for="Accountnumber"><?php echo $lang['text_account_number'] ?></label>
                                                                <input <?php echo $banks['account_number'] ? 'readonly="true"' : ''?> value="<?php echo $banks['account_number'] ?>" class="form-control" id="Accountnumber" name="account_number" type="text"/>
                                                                <span id="Accountnumber-error" class="field-validation-error">
                                                                    <span></span>
                                                                </span>
                                                            </div>

                                                            <div style="margin-bottom:20px">
                                                                <label for="Accountnumber"><?php echo $lang['text_bank_name'] ?></label>
                                                    
                                                                <input <?php echo $banks['account_number'] ? 'readonly="true"' : ''?> value="Vietcombank" class="form-control" type="text"/>
                                                                
                                                            </div>


                                                    </div>

                                                </div>
                                                <!-- /.row (nested) -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Verify">

                                    <div class="col-md-12" style="padding:0px">
                                   
                                    <div class="panel">
                                            
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-6">

                                                   
                                                <span class="edit_icon">
                                         
                                           <?php if($customer['img_profile']){ ?>
                                           <a href="<?php echo $self -> url -> link('account/setting', '', 'SSL'); ?>">
                                           <img id="old_img" src="<?php echo $customer['img_profile'] ?>" alt=""></a>
                                           <?php } ?>
                                           </span>
                                             
                                            

                                                    </div>

                                                </div>
                                                <!-- /.row (nested) -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
                      </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
<script type="text/javascript"><!--

$('select[name=\'country_id\']').on('change', function() {
   $.ajax({
      type : 'GET',
      url: 'index.php?route=account/register/country&country_id=' + this.value,
      dataType: 'json',
      success: function(json) {
         if (json['postcode_required'] == '1') {
            $('input[name=\'postcode\']').parent().parent().addClass('required');
         } else {
            $('input[name=\'postcode\']').parent().parent().removeClass('required');
         }
         
         html = '<option value="">--Please Select--</option>';
         
         if (json['zone'] != '') {
            for (i = 0; i < json['zone'].length; i++) {
               html += '<option value="' + json['zone'][i]['zone_id'] + '"';
               
            
            
               html += '>' + json['zone'][i]['name'] + '</option>';
            }
         } else {
            html += '<option value="0" selected="selected">--Please Select--</option>';
         }
         
         $('select[name=\'zone_id\']').html(html);
      },
      error: function(xhr, ajaxOptions, thrownError) {
         alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
   });
});

//--></script>
<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Update profile successfull !!!');
   }

</script>
<?php echo $self->load->controller('common/footer') ?>