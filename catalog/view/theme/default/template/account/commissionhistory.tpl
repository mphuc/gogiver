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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>Rút và lịch sử hoa hồng</h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content">

                          <div class="col-sm-12">
                             <div class="">
                                <div class="border_">
                                   <div class="">
                                     
                                     <!--  <form action="">
                                        <div class="col-md-2 col-xs-6  pull-right">
                                          <input type="submit" value="Yêu cầu rút">
                                        </div>
                                        <div class="col-md-4 col-xs-6  pull-right">
                                          <select name="" id="">
                                            <option value="">2000000</option>
                                          </select>
                                        </div>

                                      </form> -->
                                   </div>



                                        <div class="panel-body">
                                          <table class="table display dataTable table-bordered table_member">
                                          <thead>
                                            <tr class="header">
                                              <th>TT</th>
                                              <th>GD code</th>
                                              <th>Thời gian tạo</th>
                                              <th>Số tiền</th>
                                              <th>Trạng thái</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $i = 0;
                                              foreach ($pds as $value) {
                                              $i++;
                                            ?>
                                            <tr>
                                              <td data-column="TT"><?php echo $i;?></td>
                                              <td data-column="Ngày"><?php echo $value['gd_number'];?></td>
                                              <td data-column="Nội dung"><?php echo date('d/m/Y H:i',strtotime($value['date_added']));?></td>
                                              <td data-column="ID PH"><?php echo number_format($value['amount']);?> VNĐ</td>
                                              <td data-column="Hoa hồng"><?php if ($value['status'] == 0) echo "Chưa khớp lệnh"; 
                                              if ($value['status'] == 1) echo "Khớp lệnh";
                                              if ($value['status'] == 2) echo "Finish";
                                              ?></td>
                                            </tr>
                                            <?php
                                              }
                                             ?>
                                           


                                          </tbody>
                                        </table>
                                        <?php echo $pagination;?>

                                       </div>


                                   <!-- panel-body -->
                                </div>
                                <!-- panel -->
                             </div>
                          </div>
                          <!-- col -->
                       </div>
                      </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
 
<?php echo $self->load->controller('common/footer') ?>