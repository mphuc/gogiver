<?php
   $self -> document -> setTitle($lang['heading_title_com_his']);
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['heading_title_com_his'] ?></h4>
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
                                
                                   </div>



                                        <div class="panel-body">
                                          <table class="table display dataTable table-bordered table_member">
                                          <thead>
                                            <tr class="header">
                                               <th><?php echo $lang['NO'] ?></th>
                                              <th><?php echo $lang['Amount'] ?></th>
                                              <th><?php echo $lang['Date_create'] ?></th>
                                              <th><?php echo $lang['Loai'] ?></th>
                                              <th><?php echo $lang['Description'] ?></th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $i = 0;
                                              foreach ($pds as $value) {
                                              $i++;
                                            ?>
                                            <tr>
                                              <td data-title="<?php echo $lang['NO'] ?>"><?php echo $i;?></td>
                                              <td data-title="<?php echo $lang['Amount'] ?>"><?php echo $value['text_amount'];?></td>
                                              <td data-title="<?php echo $lang['Date_create'] ?>"><?php echo date('d/m/Y H:i',strtotime($value['date_added']));?></td>
                                              <td data-title="<?php echo $lang['Loai'] ?>"><?php echo $value['wallet'];?> VNĐ</td>
                                              <td data-title="<?php echo $lang['Description'] ?>"><?php echo $value['system_decsription'];   ?></td>
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