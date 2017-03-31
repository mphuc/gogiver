<?php 
   $self -> document -> setTitle("Support"); 
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['support'] ?></h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content" style="padding:10px">
                          <div class="col-md-10 col-md-push-1">
                              <form class="form" id="support" method="post" action="index.php?route=account/support/sendmail" enctype="multipart/form-data" >
        
                                <p class="name">
                                  <input type="text" name="name" id="name" placeholder="John Doe" required />
                                  <label for="name"><?php echo $lang['Title'] ?></label>
                                </p>                                
                                
                 
                              
                                <p class="text">
                                  <textarea id="content" name="content" placeholder="<?php echo $lang['Write_something_to_us'] ?>" required ></textarea>
                                </p>
                                <p>
                                  <!-- <span class="input-group-btn pull-left"> 
                                      <a href="<?php echo HTTPS_SERVER ?>kcfinder/browse.php?type=image" class="iframe-btn btn btn-default" type="button" onclick="openKCFinder()">
                                          <?php echo $lang['Images'] ?>
                                      </a>
                                  </span>
                                  <input style="width: 80%;" type="text" class="form-control" id="fieldID" name="Image" required minlenght="3" placeholder="<?php echo $lang['urlImages'] ?>">
                                  
                                  <div class="clearfix"></div>
                                    
                                  <div class="image_item text-center"> 
                                      <img style="margin-top: 15px; width: 200px;" id="thumb_image" class="fancybox_image" src="<?php echo HTTPS_SERVER ?>catalog/view/theme/default/images/notFound.png"> 
                                  </div> -->
                                <div class="" style="position: relative;">
                                    <input type="file" id="file" name="avatar" style="position: absolute; width: 100%;
                                      height: 211px; opacity: 0;left: 0;top: 0">

                                    <img style="display: none;" id="blah" style="margin-top: 15px; width: 100%; height: 211px" id="thumb_image" class="fancybox_image" src=""> 
                                    <img id="old_img" style="margin-top: 15px; width: 100%; height: 270px" src="<?php echo HTTPS_SERVER ?>catalog/view/theme/default/images/notFound.png">
                                    <div class="error-file alert alert-dismissable alert-danger" style="display:none; margin:20px 0px;">
                                                      <i class="fa fa-fw fa-times"></i>Please chosen image with : 'jpeg', 'jpg', 'png', 'gif', 'bmp'
                                                  </div>       
                                  </div>


                              </p>
                                <p>
                                <img class="img_capcha" style="float: left" src="captcha_code.php"/>
                                <input style="width: 150px; margin-left: 10px; float: left" autocomplete="off" type="text" name="capcha" placeholder="Capcha" id="input-password" value="" class="form-control" required />
                                
                              </p>
                              <div class="form-group "> 
                              
                            
                          </div>       
                                <div class="clearfix"></div>
                                <p class="submit">
                                  <input type="submit" value="<?php echo $lang['Send'] ?>" />
                                </p>
                              </form>
                          </div>
                        </div>
                     </div>
                     <!-- End Row -->
                     <!-- End row -->
                  </div>
                  <script type="text/javascript">
                     $(document).ready(function() {
                         $('#datatable').dataTable();
                     } );
                  </script>
                      
              </div>
           </div>
        </div>
     </div>

  </div>
  <div class="clearfix" style="margin-top: 80px;"></div>
</div>
<script type="text/javascript">
    if (location.hash === '#success') {
        alertify.set('notifier', 'delay', 100000000);
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('Send mail successfull !!!');
    }
     if (location.hash === '#error') {
      var html = '<div class="col-md-12">';
        html += '<p class="text-center" style="font-size:23px;text-transform: uppercase;height: 20px;color:red">ERROR !</p><p class="text-center" style="font-size:20px;height: 20px">Faild Capcha</p>';
        html += '<p style="margin-top:30px;font-size:16px"></p>';
        html += '</div>';
        alertify.alert(html, function(){
           
        });
    }
</script>
      
<?php echo $self->load->controller('common/footer') ?>