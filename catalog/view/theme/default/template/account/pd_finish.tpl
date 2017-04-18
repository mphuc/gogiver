<?php
   $self -> document -> setTitle($lang['heading_title_comis']);
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['text_register_user'] ?></h4>
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
                      
                                <div class="list_ph" style="padding-bottom: 20px;">
                                   <div class="Head" role="tab">
                                      
                                      
                                      <table  class="table">
                                        <thead>
                                          <tr>
                                            <th><?php echo $lang['PD_NUMBER'];?> </th>
                                            <th><?php echo $lang['DATE_CREATED'] ?></th>
                                            <th><?php echo $lang['useridph'] ?></th>
                                            <th><?php echo $lang['FILLED'] ?></th>
                                            <!-- <td><?php //echo $lang['MAX_PROFIT'] ?></td> -->
                                            <!-- <td><?php //echo $lang['TIME_REMAIN'] ?></td> -->
                                            <th><?php echo $lang['STATUS'] ?></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php $num = 1; foreach ($pds as $value => $key){ ?>
                                          <tr>
                                             <td data-title="<?php echo $lang['DATE_CREATED'] ?>"><strong>PD<?php echo $key['pd_number'] ?></strong></td>
                                            <td data-title="<?php echo $lang['DATE_CREATED'] ?>"><strong><?php echo date("d/m/Y", strtotime($key['date_added'])); ?></strong></td>
                                            <td data-title="UserID PH"><strong><?php echo $key['username'] ?></strong></td>
                                            <td data-title="<?php echo $lang['FILLED'] ?>"><strong><?php echo number_format($key['filled']); ?> <?php echo $lang['VND'] ?></strong></td>
                                         
                                            <td data-title="<?php echo $lang['STATUS'] ?>"><strong><span class=""><?php switch ($key['status']) {
                                         case 0:
                                             echo '<span class="label label-warning">'.$lang['dangcho'].'</span>';
                                             break;
                                         case 1:
                                             echo '<span class="label label-info">'.$lang['khoplenh'].'</span>';
                                             break;
                                         case 2:
                                             echo '<span class="label label-success">'.$lang['ketthuc'].'</span>';
                                             break;
                                         case 3:
                                             echo '<span class="label label-danger">'.$lang['baocao'].'</span>';
                                             break;
                                         } ?></span></strong></td> 
                                        <?php $num++; } ?>
                                          </tr>
                                          
                                            
                                         
                                        </tbody>
                                      </table>  
                                   </div>
                                   
                                   </div>
                                </div>
                                
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