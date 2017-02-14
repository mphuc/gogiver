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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['support'] ?></h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content" style="padding:10px">
                          <div class="col-md-10 col-md-push-1">
                              <form class="form" id="support" method="post" action="index.php?route=account/support/sendmail">
        
                                <p class="name">
                                  <input type="text" name="name" id="name" placeholder="John Doe" required />
                                  <label for="name">Title</label>
                                </p>                                
                                
                 
                              
                                <p class="text">
                                  <textarea name="content" placeholder="Write something to us" required ></textarea>
                                </p>
                                <p>
                                <input style="width: 150px; margin-left: 10px; float: right" autocomplete="off" type="text" name="capcha" placeholder="Capcha" id="input-password" value="" class="form-control" required />
                                <img class="img_capcha" style="float: right" src="captcha_code.php"/>
                              </p>
                                <div class="clearfix"></div>
                                <p class="submit">
                                  <input type="submit" value="Send" />
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