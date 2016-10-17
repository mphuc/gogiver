<?php echo $header; ?>
<div id="content" class="common-login">
<div class="wrapper-page animated fadeInDown">
         
         <div class="panel panel-color panel-primary" style="background:#fff !important; border:1px solid #cecece; width:400px; padding: 30px; margin: 0 auto">
            <div class="heade-login text-center">
            <h3>
              <a href="http://gogivers.help">
                 GOGIVERS.HELP
               </a>
            </h3>
            </div>

            <form action="<?php echo $action; ?>" method="post" class="form-horizontal" id="frm_login">
      <h4 class="title">Login Access</h4>
               <div class="form-group">
<div class="col-sm-12">
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-user"></i>
</span>
<input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" />
</div>
</div>
</div>
               <div class="form-group">
<div class="col-sm-12">
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-lock password-icon"></i>
</span>
 <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />

</div>
<div class="input-group" style="margin-top: 16px;">
<span class="input-group-addon">
<i class="fa fa-lock password-icon"></i>
</span>
 <input type="text" name="otp" value="" placeholder="Mã OTP" id="" class="form-control" />

</div>

<div class="sublink">

</div>
</div>
</div>

 <?php if ($redirect) { ?>
                  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                  <?php } ?>
              
               <?php if ($success) { ?>
               <div class="signup-alert"> <?php echo $success; ?></div>
               
               <?php } ?>
               <?php if ($error_warning) { ?>
               <div class="signup-alert"> <?php echo $error_warning; ?></div>
             
               <?php } ?>

               <div class="form-group text-right">
                  <div class="col-xs-12">
                     <!-- <input type="submit" value="Login" class="btn-login" /> -->
                     <button class="btn btn-purple w-md" type="submit"><i class="fa fa-key"></i> Log In</button>
                  </div>
               </div>
            
            </form>
         </div>
       
      </div>
</div>
<?php echo $footer; ?>