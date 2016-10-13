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
               <div class="row">
                  <!-- .row start -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                     <!-- col-md-6 start here -->
                     <div class="panel panel-default" id="dash_0">
                        <!-- Start .panel -->
                        <div class="panel-body">
                           <a class="lead-stats" href="#">
                              <span class="stats-number dolar c-wallet" data-link="<?php echo $self->url->link('account/dashboard/getCWallet', '', 'SSL'); ?>">loading ...</span>
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
                            
                              <span class="stats-number dolar r-wallet" data-link="<?php echo $self->url->link('account/dashboard/getRWallet', '', 'SSL'); ?>">loading ...</span>
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
                              <span class="stats-number pin-balence" data-link="<?php echo $self->url->link('account/dashboard/totalpin', '', 'SSL'); ?>">loading ...</span>
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
                              <span class="stats-number pd-count" data-link="<?php echo $self->url->link('account/dashboard/countPD', '', 'SSL'); ?>">loading ...</span>
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
                              <span class="stats-number gd-count" data-link="<?php echo $self->url->link('account/dashboard/countGD', '', 'SSL'); ?>">loading ...</span>
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
                              <span class="stats-number downline-tree" data-link="<?php echo $self->url->link('account/dashboard/totaltree', '', 'SSL'); ?>">loading ...</span>
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
                              <span class="stats-number" data-from="0" data-to="48">0</span>
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
                  <div ><code>G<?php echo $i ?></code></div>
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
                        <div class="blog-item">
                           <p class="blog-title"><a href="blog&token=53">Gogiver <?php echo $lang['Notification']; ?> <i class="fa fa-external-link" aria-hidden="true"></i></a></p>
                           <p>
                              HELLO ! Tháng 10 , tháng của những yêu thương…!!!
                           </p>
                           <p>Mùa Đông se lạnh ùa về khắp mọi miền Tổ Quốc. Đâu đó đã lenlõi từng cơn gió lạnh se buốt từng hơi thở của những ngày đầu Đông !</p>
                           <p>...............</p>
                        </div>
                     </div>
                  </div>
               </div>

               <div class=" rule" style="margin-top:0;"></div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title"><?php echo $lang['introduct']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="media-body innerAnnounce">
                                <h4 class="heading" style="margin-bottom: 0px;"> <i class="fa fa-link">
                                  </i> <?php echo $lang['url_link']; ?>
                              </h4>
                                <span><u><a style="word-break: break-word; font-weight:700; color:cyan" href="signup&ref=<?php echo $customer_code;  ?>" target="_blank"><?php echo HTTPS_SERVER ?>signup&ref=<?php echo $customer_code;  ?></a></u></span>
                              </div>
                            
                        </div>
                     </div>
                  </div>
            </div>

            </div>


         </div>
         
        
      </div>
      <!-- End .content -->
      <div id="footer" class="clearfix">
         <!-- Start #footer  -->
         <p class="pull-left">
            Copyrights © 2016 <a href="" class="color-blue strong underline-effect" target="_blank">Gogiver</a>. All rights reserved.
         </p>
         <p class="pull-right">
            <a href="#" class="mr5 strong underline-effect">Terms of use</a>
            |
            <a href="#" class="ml5 mr25 strong underline-effect">Privacy police</a>
         </p>
      </div>
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

</script>  
<?php echo $self->load->controller('common/footer') ?>
