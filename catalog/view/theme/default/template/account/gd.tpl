<?php 
   $self -> document -> setTitle('DANH SÁCH GH'); 
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>Danh Sách GH</h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content" style="padding:10px">
                           <div class="">
                              <div class="">
                                 
                                 <div class="btn-toolbar pull-right" style="margin-bottom:20px;">
                                    <a href="<?php echo $self -> url -> link('account/gd/create', '', 'SSL'); ?>" class="btn btn-default"><i class="fa fa-fw fa-plus"></i><?php echo $lang['text_button_create'] ?></a>
                                 </div>
                                 <!-- <div class="clearfix"></div> -->
                              </div>
                              <?php if($gds){ ?>
                              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                              <?php $num = 1; foreach ($gds as $value => $key){ ?>
                              <div class="list_ph" style="margin-bottom: 30px">
                                 <div class="Head" role="tab" id="headingOne<?php echo $key['gd_number'] ?>">
                                    
                                    <h4 style=" width: 200px;float: left;">GH : <strong>GH<?php echo $key['gd_number'] ?></strong></h4>
                                    <table  class="table">
                                        <tbody>
                                          <tr>
                                            <td>Ngày tạo</td>
                                            <td>UserID GH</td>
                                            <td>Số tiền</td>
                                            <td>Đã Nhận</td>
                                            <td>Thời gian chờ </td>
                                            <td>Trạng thái</td>
                                            <td rowspan="2">
                                              <a style="margin-top:15px;" class="pull-right btn btn-primary " role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key['gd_number'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $key['gd_number'] ?>">
                                              <i class="short-full fa  fa-list glyphicon-plus glyphicon-minus"></i>
                                              Chi tiết
                                              </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td><strong><?php echo date("d/m/Y", strtotime($key['date_added'])); ?></strong></td>
                                            <td><strong><?php echo $key['username'] ?></strong></td>
                                            <td><strong><?php echo number_format($key['amount']); ?> <?php echo $lang['VND'] ?></strong></td>
                                            <td><strong><?php echo number_format($key['filled']); ?> <?php echo $lang['VND'] ?></strong></td>
                                            <td><strong><span style="color:red; font-size:15px;" class="text-danger countdowns" data-countdown="<?php echo $key['date_finish']; ?>">
                                       </span> </strong></td>
                                            <td><strong><span class=""><?php switch ($key['status']) {
                                       case 0:
                                           echo '<span class="label label-inverse">Đang chờ</span>';
                                           break;
                                       case 1:
                                           echo '<span class="label label-info">Khớp lệnh</span>';
                                           break;
                                       case 2:
                                           echo '<span class="label label-success">Kết thúc</span>';
                                           break;
                                       case 3:
                                           echo '<span class="label label-danger">Báo cáo</span>';
                                           break;
                                       } ?></span></strong></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                 </div>
                                 <div id="collapseOne<?php echo $key['gd_number'] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $key['gd_number'] ?>">
                                    <div class="ph_collapse">
                                       <?php 
                                          $show_transfer = $self -> show_transfer($key['id']); 
                                          if (!$show_transfer) {
                                            echo '<p class="text-warning"> Please waiting!!!!';
                                          }else {
                                            echo $show_transfer;
                                          }
                                      
                                          ?>
                                    </div>
                                 </div>
                              </div>
                              <?php $num++; } ?>
                           </div>
                           <!-- panel-group -->
                           <div class="clearfix" ></div>
                           <script>
                              function toggleIcon(e) {
                                  $(e.target)
                                      .prev('.Head')
                                      .find(".short-full")
                                      .toggleClass('glyphicon-plus glyphicon-minus');
                              }
                              $('.panel-group').on('hidden.bs.collapse', toggleIcon);
                              $('.panel-group').on('shown.bs.collapse', toggleIcon);
                           </script>
                              
                              <?php } ?>
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

  $('.gh_confirm').on('click', function() {
    var result = confirm("Xác nhận hóa đơn?");
    var code = $(this).data().value;
    if (result) {
      url = 'confirmgh.html&token='+code;
      location = url;
    }
  });
   $('.gh_report').on('click', function() {
    var result = confirm("Báo cáo ID không PH?");
    var code = $(this).data().value;
    if (result) {
      url = 'reportgh.html&token='+code;
      location = url;
    }
  });
</script>
      
<?php echo $self->load->controller('common/footer') ?>