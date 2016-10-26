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
                                  <input type="text" name="name" id="name" placeholder="John Doe" />
                                  <label for="name">Name</label>
                                </p>
                                
                                
                                
                                <!-- <p class="web">
                                  <input type="text" name="web" id="web" placeholder="www.example.com" />
                                  <label for="web">Website</label>
                                </p>     -->
                              
                                <p class="text">
                                  <textarea name="content" placeholder="Write something to us" /></textarea>
                                </p>
                                
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
</script>
      
<?php echo $self->load->controller('common/footer') ?>