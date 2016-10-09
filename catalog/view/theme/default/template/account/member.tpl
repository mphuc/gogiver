<?php
   $self -> document -> setTitle('Quản lý thành viên');
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>Quản lý thành viên</h4>
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
                  <div class="col-md-12 col-sm-12 col-xs-12" id="no-more-tables">
                    <select name="" id="Floor" class="form-control" required="required" style="width:200px;margin-bottom: 10px;">
                     <option value="null">Thành Viên</option>
                     <?php 
    $totalFloor = intval($self -> sumFloor());
    for ($i=1; $i <= $totalFloor; $i++) { 
      
        echo "<option value='floor".$i."'>Thành Viên F".$i."</option>";
    
    } ?>
                     
                  </select>
                  <div class="row" id="customerFloor" data-id="<?php echo $self->session -> data['customer_id'] ?>" data-link="<?php echo $self->url->link('account/member/customerFloor', '', 'SSL'); ?>">
                     <div class="col-md-12 col-sm-12 col-xs-12" id="no-more-tables">
                                          <?php 
    $totalFloor = intval($self -> sumFloor());
    for ($i=1; $i <= $totalFloor; $i++) { 
      
        echo ' <div class="resetFloor" id="customerFloor'.$i.'">
                        </div>';
    
    } ?>
                     </div>
                  </div>
                  <div id="floorOne">
                       <table id="" class="table table-bordered">
                      <thead>
                        <tr class="header">
                           <th>STT</th>
                           <th>ID Hệ Thống</th>
                           <th>Họ Tên</th>
                           <th>Số Tài Khoản</th>
                           <th>Số Điện Thoại</th>
                           
                           <th>Pin</th>
                           <th>Người Bảo Trợ</th>
                           <th>Trạng Thái PH</th>
                        </tr>
                        
                      </thead>
                      <tbody>
                      <?php //echo "<pre>"; print_r($data['member_f1']);echo "</pre>"; ?>
                      <?php $Num = 0; foreach ($data['member_f1'] as $value) { ?>
                        <tr>
                             <td data-title="No" align="center"><?php echo $Num;  ?></td>
                             <td data-title="ID Hệ Thống"><?php echo $value['username']; ?></td>
                             <td data-title="Họ Tên"><?php echo $value['account_holder'] ?></td>
                             <td data-title="Số Tài Khoản"><?php echo $value['account_number'] ?></td>
                             <td data-title="Điện Thoại"><?php echo $value['telephone'] ?></td>
                           
                             <td data-title="Pin"><?php echo $value['ping'] ?></td>
                             <td data-title="Người Bảo Trợ"><?php echo $self -> getParrent($value['p_node']) ?></td>
                             <td data-title="Trạng Thái PH"><span class="text-warning"><?php echo (intval($self -> checkPD($value['customer_id'])) === 1 ? '<span class="text-success">Kích hoạt</span>' : '<span class="text-warning">Đang chờ</span>') ?></span></td>
                          </tr>

                        <!--  <tr <?php echo $value['check_Newuser'] > 0 ? 'style="color:#0000ff"' : 'style="color:#ff0000"' ?> >
                          <td data-title="ID hệ thống"><?php echo $value['username'];?></td>
                          <td data-title="Tên đầy đủ trên thẻ ATM"><?php echo $value['account_holder'];?></td>
                          <td data-title="Điện thoại"><?php echo $value['telephone'];?></td>
                          
                          <td data-title="Số tài khoản">
                            <?php print_r($value['account_number']);?>
                          </td>
                          <td data-title="Pin"><?php echo $value['ping'];?></td>
                          <td data-title="Đăng nhập gần nhất"><?php echo $value['date_login_update'] == '0000-00-00 00:00:00' ? 'Chưa đăng nhập lần nào' : date('d/m/Y H:i',strtotime($value['date_login_update']))?></td>
            
                        </tr> -->
                      <?php
                        $Num++; }
                      ?>
                      </tbody>
                    </table>
                     <?php echo $pagination; ?>
                   </div>
                  </div>
                 
               </div>
               <!-- panel-body -->
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

<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Create user successfull !!!');
   }

</script>
<script type="text/javascript">
  window.sumFloor = '<?php echo intval($self -> sumFloor()); ?>';

</script>
<script type="text/javascript">

  jQuery('.details_member').click(function() {
    var id = jQuery(this).data('id');

    jQuery.ajax({
      url : '<?php echo $ulr_getdetail_user;?>',
      data : {
        'customer_id' : id
      },
      type : 'POST',
      datatype : 'json',
      success : function(data){
        /*var datas = jQuery.parseJSON(data);
        console.log(datas);
        jQuery('#id_nhan').val("ádasdsadas");
        jQuery('#level').val(datas.customer_id);
        jQuery('#email').val(datas.email);
        jQuery('#full_name').val(datas.username);
        jQuery('#tk_bank').val(datas.account_number);
        jQuery('#phone_number').val(datas.telephone);*/
        alertify.confirm('Thông tin thành viên', data, function(){  }, function(){ });
      }
    });

  });


</script>