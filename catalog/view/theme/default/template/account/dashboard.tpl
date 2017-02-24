<?php

   $self->document->setTitle($lang['text_dashboard']);
   echo $self->load->controller('common/header'); echo $self->load->controller('common/column_left');

   ?>

   <div class="main-content">
   
      <div class="content" style="">
        <div class="col-md-12">
          <div class="row">
          <div class="pull-left"  style="margin-right: 20px; margin-bottom: 25px; font-size: 18px; font-weight: bold; line-height: 14px; color: red; list-style: none;  padding: 10px; background: #cecece;">
              You have <span data-countdown="<?php echo $date_finish ?>"></span>  to have a new member
          </div>
          <?php 
            switch ($date_pd['level']) {
              case 1:
                $num_pd = 3;
                break;
              case 2:
                $num_pd = 5;
                break;
              case 3:
                $num_pd = 7;
                break;
              case 4:
                $num_pd = 9;
                break;
              case 5:
                $num_pd = 1;
                break;
              case 6:
                $num_pd = 13;
                break;
            }
          ?>
          
          <?php if ($date_pd['count_pd'] < $num_pd) { ?>
            <div class="pull-right"  style=" margin-bottom: 25px; font-size: 18px; font-weight: bold; line-height: 14px; color: red; list-style: none;  padding: 10px; background: #cecece;">
                <?php echo $date_pd['count_pd'] ?> PD. Time left to create <?php echo $num_pd-$date_pd['count_pd'] ?> PD <span data-countdown="<?php echo $date_pd['date_pd'] ?>"></span>
            </div>
          <?php } ?>
          <!-- <div class="clearfix"></div>
           <div class="pull-left"  style=" margin-bottom: 25px; font-size: 18px; font-weight: bold; line-height: 14px; color: red; list-style: none;  padding: 10px; background: #cecece;">
          <strong>Your downline have <span data-countdown="2017-01-16 23:00:00"></span> <?php //echo "trungdoan";?></strong> to comple PD. Do you want to <a class="btn btn-success">Get PD</a></a> 
          </div> -->

           <div class="clearfix"></div>
          <div class=" rule" style="margin-top:25px;"></div>
               <div class="panel panel-default panel-tie">
                  <div class="panel-body">
                     <div class="widget-header">
                        <i class="icon-check"></i>
                        <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> Notification System</h3>
                     </div>
                     <div class="widget-content">
               <?php foreach ($article_limit as $key => $value): ?>
                <?php //print_r($value) ?>
                     <div class="blog-item" style="padding-left: 10px;">
                        <p class="blog-title"><a href="blog&token=<?php echo $value["simple_blog_article_id"]; ?>"><?php echo $value['article_title'] ?></a></p>
                        <p><?php $value['date_added'] = "2017-01-07 10:20:00"; echo date("d/m/Y H:i:A", strtotime($value['date_added'])); ?></p>
                        <p><?php echo html_entity_decode($value['description'] , ENT_QUOTES, 'UTF-8')?></p>
                        
                     </div>
                     <?php endforeach; ?>
                     <?php echo $pagination; ?>
       
             
          </div>
                  </div>
               </div>

               
            <div class=" rule" style="margin-bottom:30px;"></div>
            </div>
            </div>
         <div class="row">
            <!-- .row start -->
            <div class="col-md-12">
            <?php if(count($chu_ky) > 0 && intval($chu_ky['number']) > 0) { ?>
               <div class="col-md-12 alert" style="margin:0px 0px; color:red; font-size:18px; font-weight:700">
                  <?php echo $lang['vongquayketthuc'];?>
               </div>
            <?php } ?>
               
               <?php 
                  if (count($getPDfinish_child) > 0) {
                     foreach ($getPDfinish_child as $value) {
                  ?>
                  <?php if ($language=='english') { ?>

                  <div class="alert alert-danger">
                       <strong><?php echo $value['username'];?> didn't PD </strong> Please get PD the amount  of <?php echo number_format($value['amount']); ?> VND <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="index.php?route=account/pd/createpd_child&token=<?php echo $value['transfer_code'];?>">Create PD</a>
                     </div>

                   <?php }else{ ?>
                     <div class="alert alert-danger">
                       <strong><?php echo $value['username'];?> chưa PD </strong> Bạn vui lòng kéo PD về với số tiền <?php echo number_format($value['amount']); ?> VNĐ <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="index.php?route=account/pd/createpd_child&token=<?php echo $value['transfer_code'];?>">Tạo PD</a>
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
<?php 
  //print_r($get_customer_by_id_in); die;
  for ($i=1; $i <=12 ; $i++) { 
    $month[$i] = 0;
    foreach ($get_customer_by_id_in as $key => $value) {
      $date= explode("-",$value['date_added']);
      if ( intval($date[1])."-".$date[0] == $i."-2017"){
        $month[$i] +=1;
      }
    }
  }
?>
<script type="text/javascript">
    window.onload = function () {
      var chart = new CanvasJS.Chart("chartContainer", {
        title: {
          text: "Membership Growth Chart"
        },
        axisY:{
          title : "Total Member",
          titleFontColor: "#5472BA",
           titleFontSize: 20,
           lineColor: "#5472BA"
         },
         
         axisX:{
          title : "Month",
          titleFontColor: "#5472BA",
           titleFontSize: 20,
           lineColor: "#5472BA"
         },
       
        data: [
        {

          type: "splineArea",
          dataPoints: [
          { x: 1, y: <?php echo $month[1] ?> },
          { x: 2, y: <?php echo $month[2] ?> },
          { x: 3, y: <?php echo $month[3] ?> },
          { x: 4, y: <?php echo $month[4] ?> },
          { x: 5, y: <?php echo $month[5] ?> },
          { x: 6, y: <?php echo $month[6] ?> },
          { x: 7, y: <?php echo $month[7] ?> },
          { x: 8, y: <?php echo $month[8] ?> },
          { x: 9, y: <?php echo $month[9] ?> },
          { x: 10, y: <?php echo $month[10] ?> },
          { x: 11, y: <?php echo $month[11] ?> },
          { x: 12, y: <?php echo $month[12] ?> }
        
      
          ]
        }
        ]
      });

      chart.render();
    }
  </script>
              <div id="chartContainer" style="height: 400px; width: 100%; margin-bottom: 30px;"></div>




               <div class="row">
                  
                  <!-- .row start -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge custom_padding_right">
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
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge custom_padding_right">
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
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge custom_padding_right">
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
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge custom_padding_right">
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
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge ">
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

                 <!--  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge">
                    col-md-4 start here
                    <div class="panel panel-default" id="dash_3">
                       Start .panel
                       <div class="panel-body">
                          <a class="lead-stats" href="#">
                             <span class="stats-number" data-from="0" data-to="48"><?php //echo $self -> insurance_fund(); ?> VND</span>
                             <span class="stats-icon">
                             <i class="fa fa-university color-red"></i>
                             </span>
                             <h5><?php //echo $lang['insurance_fund']; ?></h5>
                          </a>
                       </div>
                    </div>
                    End .panel
                 </div> -->
                  <div class="col-lg-4 col-md-6 col-xs-6 col-small-enlarge custom_padding_right">
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
             <div class="col-md-2 col-sm-2 col-xs-2 ">
               <div class="panel panel-default item_level">
                  <div ><code>I<?php echo $i ?></code></div>
                  <div data-level="<?php echo $i + 1 ?>" data-id="<?php echo $self->session -> data['customer_id'] ?>" data-link="<?php echo $self->url->link('account/dashboard/analytics', '', 'SSL'); ?>" class="analytics-tree analytics-tree-loading">loading ...
                  </div>
               </div>
              </div>
          <?php } ?>
            <div class="clearfix"></div>
            <div class="row">
            <div class="col-md-6" id="no-more-tables">
              <div class="panel panel-default" id="dash_0">
              <!-- Start .panel -->
                <div class="panel-heading">
                   <h4 class="panel-title"><i class="fa fa-align-justify"></i>New Member</h4>
                </div>
                <div class="panel-body form-horizontal group-border stripped">
                  <table id="datatable" class="table table-striped table-bordered dataTable">
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Sponsor</th>
                    <th>Status</th>
                  </tr>
                  
                  <?php foreach ($get_customer_by_id_in as $key => $value) { ?>
                    <tr>
                      <td><?php echo ($value['customer_id'] > 61 ) ? $value['customer_id'] + 1000 : $value['customer_id'] ?></td>
                      <td><?php echo $value['username'] ?></td>
                      <td>
                        <?php echo $self->getusername($value['p_node'])['username']; ?>
                      </td>
                      <td>
                        <?php if ($value['status'] == 1) echo "ACTIVE"; else "LOCK"; ?>
                      </td>
                    </tr>
                  
                  <?php } ?>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-6" id="no-more-tables">
              <div class="panel panel-default" id="dash_0">
              <!-- Start .panel -->
                <div class="panel-heading">
                   <h4 class="panel-title"><i class="fa fa-align-justify"></i>Downline PDGD</h4>
                </div>
                <div class="panel-body form-horizontal group-border stripped">
                  <table id="datatable" class="table table-striped table-bordered dataTable">
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Downline PDGD</th>
                  </tr>
                  <?php foreach ($get_childrend as $key => $value) { ?>
                    <tr>
                      <td>
	<?php if ($value['customer_id'] > 61 )
	{
		$customer_id = $value['customer_id'] + 1000; 
	}
	else
	{
		$customer_id = $value['customer_id'];
	}
	if ($value['customer_id'] =64 )	$customer_id = 1060;
	if ($value['customer_id'] =65 )	$customer_id = 1061;
	 
?>
	<?php echo $customer_id  ?>
	
</td>
                      <td><?php echo $value['username'] ?></td>
                      <td>
                        <a href="index.php?route=account/dashboard/child_gd&token=<?php echo $value['customer_code'] ?>">
                          <button type="button" class="btn btn-primary">GD</button>
                        </a>
                        <a href="index.php?route=account/dashboard/child_pd&token=<?php echo $value['customer_code'] ?>">
                          <button type="button" class="btn btn-success">PD</button>
                        </a>
                        </td>
                    </tr>
                  <?php } ?>
                  </table>
                </div>
              </div>
            </div>
            
            </div>
            <div class=" rule" style="margin-bottom:80px;"></div>

         </div>
         
        
      </div>
      <!-- End .content -->
      
      <!-- End #footer  -->
   </div>
   <!-- End / .main-content -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
    } );
</script>
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
