<?php 
   $self -> document -> setTitle('Thêm PH'); 
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>Tạo PH</h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content" style="padding:10px">
         <div class="">
            <!-- <div class="">
               <h3 class="panel-title"><?php echo $lang['text_button_create'] ?></h3>
            </div> -->
            <div class="panel-body">
       
              
               <div class="row">
                  <div class="col-md-12">
                     <div class="alert  alert-success alert-edit-account" style="display:none">
                        <i class="fa fa-check"></i> <?php echo $lang['ok'] ?>.
                     </div>
                     <div id="checkPD-error" class="alert alert-dismissable alert-danger" style="display:none">
                     </div>
                     <div id="checkWaiting-error" class="alert alert-dismissable alert-danger" style="background-color: rgba(255, 0, 0, 0.09); display:none">
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <form id="submitPD" class="form-horizontal margin-none" name="buy_share_form" action="<?php echo $self -> url -> link('account/pd/submit', '', 'SSL'); ?>" method="post" novalidate="novalidate">
                     <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $lang['amount']?></label>
                        <div class="col-md-8">
                          <select class="form-control valid" id="amount" name="amount">
                                             <option value=""><?php echo $lang['choise']?></option>
                                             <?php if ($level['level'] == 1) {?>
                                             <option value="8800000"><?php echo number_format("8800000")."<br>"; ?> <?php echo $lang['VND']?></option>
                                             <?php } ?>
                                             <?php if ($level['level'] == 2) {?>
                                             <option value="17600000"><?php echo number_format("17600000")."<br>"; ?> <?php echo $lang['VND']?></option>
                                             <?php } ?>
                                             <?php if ($level['level'] == 3) {?>
                                             <option value="26400000"><?php echo number_format("26400000")."<br>"; ?> <?php echo $lang['VND']?></option>
                                             <?php } ?>
                                             <?php if ($level['level'] == 4) {?>
                                             <option value="35200000"><?php echo number_format("35200000")."<br>"; ?> <?php echo $lang['VND']?></option>
                                             <?php } ?>
                                             <?php if ($level['level'] >= 5) {?>
                                             <option value="44000000"><?php echo number_format("44000000")."<br>"; ?> <?php echo $lang['VND']?></option>
                                             <?php } ?>
                                             
      
                                          </select>
                                          <span id="amount-error" class="field-validation-error" style="display: none;">
                                                            <span><?php echo $lang['err_amount']?></span>
                                                        </span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $lang['password']?></label>
                        <div class="col-md-8">
                           <input class="form-control" id="Password2" name="Password2" type="password"/>
                           <span id="Password2-error" class="field-validation-error" style="display: none;">
                           <span >The transaction password field is required.</span>
                           </span>
                        </div>
                     </div>
                     <div class="control-group form-group">
                        <div class="controls">
                           <div class=" ">
                              <div class="loading"></div>
                              <button type="submit" class="btn-register btn btn-primary"> <?php echo $lang['text_button_create'] ?></button>
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
<script type="text/javascript">
   
window.err_password = '<?php echo $lang['err_password'] ?>';

window.err_pd = '<?php echo $lang['err_pd'] ?>';

window.err_pin = '<?php echo $lang['err_pin'] ?>';
window.err_account = '<?php echo $lang['err_account'] ?>';


window.err_password_2 = '<?php echo $lang['err_password_2'] ?>';

</script>
<?php echo $self->load->controller('common/footer') ?>