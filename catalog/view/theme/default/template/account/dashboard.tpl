<?php
   $self->document->setTitle($lang['text_dashboard']);
   echo $self->load->controller('common/header'); echo $self->load->controller('common/column_left');

   ?>

   <div class="main-content">
   
      <div class="content" style="">
         <div class="row">
            <!-- .row start -->
            <div class="col-md-12">
            <?php if(count($chu_ky) > 0 && intval($chu_ky['number']) > 0) { ?>
               <div class="col-md-12 alert" style="margin:0px 0px; color:red; font-size:18px; font-weight:700">
                  <?php echo $lang['vongquayketthuc'];?>
               </div>
            <?php } ?>
               <!-- col-md-8 start here -->
               <?php 
                  if (count($getPDfinish_child) > 0) {
                     foreach ($getPDfinish_child as $value) {
                  ?>
                  <?php if ($language=='english') { ?>

                  <div class="alert alert-danger">
                       <strong><?php echo $value['username'];?> not transfer money</strong> Please create PD with money <?php echo number_format($value['amount']); ?> VND no penalty <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="index.php?route=account/pd/createpd_child&token=<?php echo $value['transfer_code'];?>">Create PH</a>
                     </div>

                   <?php }else{ ?>
                     <div class="alert alert-danger">
                       <strong><?php echo $value['username'];?> chưa chuyển tiền</strong> Bạn vui lòng tạo PD với số tiền <?php echo number_format($value['amount']); ?> VNĐ để không bị phạt <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="index.php?route=account/pd/createpd_child&token=<?php echo $value['transfer_code'];?>">Tạo PH</a>
                     </div>
                     <?php } ?>
                  <?php
                     }
                  }
               ?>

               <?php 

                  if (intval($repd) != 0) {
                    
                    
                  ?>
                
                  <?php if ($language=='english') { ?>
                  
                    <div class="alert alert-danger">
                       <strong>Notification! </strong> Please create PH to freezing or locked accounts. <a class="btn btn-success" href="provide-donation.html">Create PH</a>
                     </div>
                  <?php }else{ ?>
                  
                     <div class="alert alert-danger">
                       <strong>Thông báo! </strong> Bạn vui lòng tạo PH để không bị đóng băng hoặc bị khóa tài khoản. <a class="btn btn-success" href="provide-donation.html">Tạo PH</a>
                     </div>

                  <?php
                   }
                  }
               ?>
               <div class="row">
                  
                  <!-- .row start -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-6 start here -->
                     <div class="panel panel-default" id="dash_0">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number dolar c-wallet">
                                 <?php echo $self -> getCWallet(); ?> VND</span>
                              <span class="stats-icon">
                              <i class="fa fa-money color-green"></i>
                              </span>
                              <h5><?php echo $lang['c_wallet'];?></h5>
                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <!-- col-md-6 end here -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-6 start here -->
                     <div class="panel panel-default" id="dash_1">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                            
                              <span class="stats-number dolar r-wallet"><?php echo $self -> getRWallet(); ?> VND</span>
                              <span class="stats-icon">
                              <i class="fa fa-money color-yellow-dark"></i>
                              </span>
                              <h5><?php echo $lang['r_wallet'];?></h5>
                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <!-- col-md-6 end here -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-4 start here -->
                     <div class="panel panel-default" id="dash_2">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number pin-balence" data-link="<?php echo $self->url->link('account/dashboard/totalpin', '', 'SSL'); ?>"><?php echo $self -> totalpin(); ?></span>
                              <span class="stats-icon">
                              <i class="fa fa-battery-full color-blue"></i>
                              </span>
                              <h5><?php echo $lang['pinBalance']; ?></h5>
                              

                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <!-- col-md-4 end here -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-4 start here -->
                     <div class="panel panel-default" id="dash_3">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number pd-count"><?php echo $self -> countPD(); ?></span>
                              <span class="stats-icon">
                              <i class="fa fa-cloud-upload color-green"></i>
                              </span>
                              <h5><?php echo $lang['provideDonation']; ?></h5>

                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <!-- col-md-4 end here -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-4 start here -->
                     <div class="panel panel-default" id="dash_4">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number gd-count"><?php echo $self -> countGD(); ?></span>
                              <span class="stats-icon">
                              <i class="fa fa-cloud-download color-gray"></i>
                              </span>
                              <h5><?php echo $lang['getDonation']; ?></h5>
                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <!-- col-md-4 end here -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-4 start here -->
                     <div class="panel panel-default" id="dash_5">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number downline-tree"><?php echo $self -> totaltree(); ?></span>
                              <span class="stats-icon">
                              <i class="fa fa-users color-green-light"></i>
                              </span>
                              <h5><?php echo $lang['accounttree']; ?></h5>
                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <!-- col-md-4 end here -->

                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-4 start here -->
                     <div class="panel panel-default" id="dash_3">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number" data-from="0" data-to="48"><?php echo $self -> insurance_fund(); ?> VND</span>
                              <span class="stats-icon">
                              <i class="fa fa-university color-red"></i>
                              </span>
                              <h5><?php echo $lang['insurance_fund']; ?></h5>
                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-4 start here -->
                     <div class="panel panel-default" id="dash_3">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number" data-from="0" data-to="48"><?php echo $onlineToday;?></span>
                              <span class="stats-icon">
                              <i class="fa fa-smile-o color-blue"></i>
                              </span>
                              <h5><?php echo $lang['member_online']; ?></h5>
                           </a>
                        </div>
                     </div>
                     <!-- End .panel -->
                  </div>

               </div>
              
            </div>
            <!-- col-md-8 end here -->
            
            <!-- col-md-4 end here -->
         </div>
         <!-- / .row -->
         <div class="row">
            <?php for ($i=0; $i < 6; $i++) { ?>
             <div class="col-md-2 col-sm-2 col-xs-2">
               <div class="panel panel-default item_level">
                  <div ><code>I<?php echo $i ?></code></div>
                  <div data-level="<?php echo $i + 1 ?>" data-id="<?php echo $self->session -> data['customer_id'] ?>" data-link="<?php echo $self->url->link('account/dashboard/analytics', '', 'SSL'); ?>" class="analytics-tree analytics-tree-loading">loading ...
                  </div>
               </div>
              </div>
          <?php } ?>

            <div class="col-md-12">
               <div class="panel panel-default panel-tile">
                  <div class="panel-body">
                     <div class="widget-header">
                        <i class="icon-check"></i>
                        <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php echo $lang['Notification_System']; ?></h3>
                     </div>
                     <div class="widget-content">
               <?php foreach ($article_limit as $key => $value): ?>
                     <div class="blog-item">
                        <p class="blog-title"><a href="blog&token=<?php echo $value["simple_blog_article_id"]; ?>"><?php echo $value['article_title'] ?></a></p>
                        <p><?php echo date("m/d/Y H:i:A", strtotime($value['date_added'])); ?></p>
                        <p><?php echo html_entity_decode($value['short_description'] , ENT_QUOTES, 'UTF-8')?></p>
                        
                     </div>
                     <?php endforeach; ?>
                     <?php echo $pagination; ?>
       
             
          </div>
                  </div>
               </div>

               
            <div class=" rule" style="margin-bottom:80px;"></div>
            </div>


         </div>
         
        
      </div>
      <!-- End .content -->
      
      <!-- End #footer  -->
   </div>
   <!-- End / .main-content -->
</div>
<div class="clearfix"></div>
<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Create user successfull !!!');
   }
   if (location.hash === '#createPD') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Create PD successfull !!!');
   }
</script>  
<?php echo $self->load->controller('common/footer') ?>
