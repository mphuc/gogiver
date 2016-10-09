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
                  Vòng quay PH - Cho của bản đã kết thúc, vui lòng nạp thêm 3 Pin để bắt đầu vòng quy mới
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
                              <h5>C - Wallet</h5>
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
                              <h5>R - Wallet</h5>
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
                              <h5>Thành Viên Tuyến Dưới</h5>
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
                              <h5>Qũy Cộng Đồng</h5>
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
                              <h5>Thành viên đang hoạt động</h5>
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
         <div class="row no-padding">
            <!-- .row start -->
            <div class="col-md-3 col-sm-6 col-xs-6">
               <!-- col-md-3 start here -->
               <div class="panel panel-default plain brad0 matchSparkStats" id="dash_9">
                  <!-- Start .panel -->
                  <div class="panel-body">
                     <div class="sparkline-stats">
                        <div class="row padding">
                           <!-- .row start -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <h5 class="uppercase text-muted sparkline-title mb5">Members</h5>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-4">
                              <!-- col-md-4 start here -->
                              <div class="stats-number s24 strong" data-from="0" data-to="12750">0</div>
                           </div>
                           <!-- col-md-4 end here -->
                           <div class="col-lg-8 col-md-12">
                              <!-- col-md-12 start here -->
                              <div id="sparkline-members" class="sparkline"></div>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <div class="change color-green strong s16">+5% <i class="glyphicon glyphicon-circle-arrow-up"></i>
                              </div>
                           </div>
                           <!-- col-md-12 end here -->
                        </div>
                        <!-- / .row -->
                     </div>
                  </div>
               </div>
               <!-- End .panel -->
            </div>
            <!-- col-md-3 end here -->
            <div class="col-md-3 col-sm-6 col-xs-6">
               <!-- col-md-3 start here -->
               <div class="panel panel-default plain brad0 matchSparkStats" id="dash_10">
                  <!-- Start .panel -->
                  <div class="panel-body">
                     <div class="sparkline-stats">
                        <div class="row padding">
                           <!-- .row start -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <h5 class="uppercase text-muted sparkline-title mb5">Sales</h5>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-4">
                              <!-- col-md-4 start here -->
                              <div class="stats-number dolar s24 strong" data-from="0" data-to="8500">0</div>
                           </div>
                           <!-- col-md-4 end here -->
                           <div class="col-lg-8 col-md-12">
                              <!-- col-md-12 start here -->
                              <div id="sparkline-sales" class="sparkline"></div>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <div class="change color-green strong s16">+2% <i class="glyphicon glyphicon-circle-arrow-up"></i>
                              </div>
                           </div>
                           <!-- col-md-12 end here -->
                        </div>
                        <!-- / .row -->
                     </div>
                  </div>
               </div>
               <!-- End .panel -->
            </div>
            <!-- col-md-3 end here -->
            <div class="col-md-3 col-sm-6 col-xs-6">
               <!-- col-md-3 start here -->
               <div class="panel panel-default plain brad0 matchSparkStats" id="dash_11">
                  <!-- Start .panel -->
                  <div class="panel-body">
                     <div class="sparkline-stats">
                        <div class="row padding">
                           <!-- .row start -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <h5 class="uppercase text-muted sparkline-title mb5">advertising costs</h5>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-4">
                              <!-- col-md-4 start here -->
                              <div class="stats-number dolar s24 strong" data-from="0" data-to="1250">0</div>
                           </div>
                           <!-- col-md-4 end here -->
                           <div class="col-lg-8 col-md-12">
                              <!-- col-md-12 start here -->
                              <div id="sparkline-advert" class="sparkline"></div>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <div class="change color-red strong s16">-17% <i class="glyphicon glyphicon-circle-arrow-down"></i>
                              </div>
                           </div>
                           <!-- col-md-12 end here -->
                        </div>
                        <!-- / .row -->
                     </div>
                  </div>
               </div>
               <!-- End .panel -->
            </div>
            <!-- col-md-3 end here -->
            <div class="col-md-3 col-sm-6 col-xs-6">
               <!-- col-md-3 start here -->
               <div class="panel panel-default panel-tile plain brad0 matchSparkStats" id="dash_12">
                  <!-- Start .panel -->
                  <div class="panel-body">
                     <div class="sparkline-stats">
                        <div class="row padding">
                           <!-- .row start -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <h5 class="uppercase text-muted sparkline-title mb5">engagements</h5>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-4">
                              <!-- col-md-4 start here -->
                              <div class="stats-number s24 strong" data-from="0" data-to="5.28" data-decimals="2">0</div>
                           </div>
                           <!-- col-md-4 end here -->
                           <div class="col-lg-8 col-md-12">
                              <!-- col-md-12 start here -->
                              <div id="sparkline-eng" class="sparkline"></div>
                           </div>
                           <!-- col-md-12 end here -->
                           <div class="col-md-12">
                              <!-- col-md-12 start here -->
                              <div class="change color-red strong s16">-1% <i class="glyphicon glyphicon-circle-arrow-down"></i>
                              </div>
                           </div>
                           <!-- col-md-12 end here -->

                        </div>

                        <!-- / .row -->
                     </div>

                  </div>
               </div>

               <!-- End .panel -->
            </div>
            <!-- col-md-3 end here -->
            <div class="col-md-12">
               <div class="panel panel-default panel-tile">
                  <div class="panel-body">
                     <div class="widget-header">
                        <i class="icon-check"></i>
                        <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> Thông báo hệ thống</h3>
                     </div>
                     <div class="widget-content">
                        <div class="blog-item">
                           <p class="blog-title"><a href="blog&token=53">Gogiver Thông báo <i class="fa fa-external-link" aria-hidden="true"></i></a></p>
                           <p>
                              HELLO ! Tháng 10 , tháng của những yêu thương…!!!
                           </p>
                           <p>Mùa Đông se lạnh ùa về khắp mọi miền Tổ Quốc. Đâu đó đã lenlõi từng cơn gió lạnh se buốt từng hơi thở của những ngày đầu Đông !</p>
                           <p>...............</p>
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
