<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>List Re-PD</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">List Re-PD</h3>
    </div>
    <ul class="nav nav-tabs">
    
    <li class="active"><a data-toggle="tab" href="#menu2">Special User</a></li>
    <li><a data-toggle="tab" href="#menu3">Tài khoản khóa</a></li>
    <li><a data-toggle="tab" href="#menu5">Tài khoản xóa</a></li>
    <li><a data-toggle="tab" href="#menu4">Administrator User</a></li>
  </ul>
  <div class="clearfix"></div>
    <div class="panel-body row">
    <div class="tab-content">
     	<div id="menu2" class="tab-pane fade in active">
          <div class="row">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <!-- <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td> -->
                  <td style="width: 40px;" >STT</td>
                 
                  <td style="width: 140px;" class="text-left" >Username
                  </td>
                   <td style="">Email</td>
                   <td>Images CMND</td>
                   <td>Number CMND</td>
                  <td style="width: 110px;">Phone</td>
                  <td style="width: 140px;">Presenter</td>
                  
                  <td style="width: 110px;" class="text-right">EDIT</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($customer_spicel) { $n=1;?>
                <?php foreach ($customer_spicel as $customer) { 
                  //print_r($customer); die;
                ?>
                <tr class="">
                  <!-- <td class="text-center"><?php if (in_array($customer['customer_id'], $selected)) { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                    <?php } ?></td> -->
                  <td><?php echo $n;?></td>
                  
                  <td class="text-left"><?php echo $customer['username']; ?></td>
                 <td class="text-left"><?php echo $customer['email']; ?></td>
                 <td class="text-center">
                  <?php if($customer['img_profile'] != "") { ?>
                  <a href="<?php echo $customer['img_profile']; ?>" target="_blank">
                    <img style="width:120px;    max-height: 92px;" src="<?php echo $customer['img_profile']; ?>" />
                  </a>
                  <?php } else {echo "Không có CMND"; }?>
                  </td>
                  <td><?php echo $customer['cmnd'] ?></td>
                  <td class="text-left"><?php echo $customer['telephone']; ?></td>
                  <td class="text-left">
                    <?php 
                   
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft->get_pnode($customer['p_node'])['username']; 
                    }
                   
                    ?>
                    
                  </td>
                  <td>
                    <a href="index.php?route=sale/customer/edit&token=<?php echo $_GET['token']; ?>&customer_id=<?php echo $customer['customer_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php $n++; } ?>

                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        </div>
        </div>


        <div id="menu3" class="tab-pane fade">
          <div class="row">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
          <div class="table-responsive">
           
            <div class="col-sm-4"></div>
            <div class="col-sm-3 input-group date">
                 <label class=" control-label" for="input-date_create">Start Data</label>
                 <input style="margin-top: 5px;" type="text" id="start_datessss" name="date_create" value="<?php echo date('d-m-Y') ?>" data-date-format="DD-MM-YYYY" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
              <div class="col-sm-3 input-group date">
                 <label class=" control-label" for="input-date_create">End Data</label>
                 <input style="margin-top: 5px;" type="text" id="end_datesssss" name="date_create" value="<?php echo date('d-m-Y') ?>" data-date-format="DD-MM-YYYY" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
            <div class="col-md-2 pull-right">
              <button id="click_exrpot pull-right" style="margin-top: 28px;" type="button" class="btn btn-success click_exrpot">Export</button>
            </div>
            <br>
            <p></p>
            <script type="text/javascript">

              jQuery('.click_exrpot').click(function(){
                
              window.location.replace("index.php?route=pd/repd/exportlock&token=<?php echo $_GET['token']; ?>&start_date="+jQuery('#start_datessss').val()+"&end_date="+jQuery('#end_datesssss').val());
          });
            </script>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <!-- <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td> -->
                  <td style="width: 40px;" >STT</td>
                 
                  <td style="width: 140px;" class="text-left" >Username
                  </td>
                  <td>Date Create</td>
                  <td>Date Lock</td>
                  <td>Telephone</td>
                   <td>Upline</td>
                   <td>Middle Upline</td>
                   <td>Big Upline</td>
                   <td>Số lần đã GD</td>
                   <td>Số tiền đã GD</td>
                   <td style="">Email</td>

                   <td>Images CMND</td>
                   <td>Number CMND</td>
                  <td style="width: 110px;" class="text-right">EDIT</td>
                </tr>
              </thead>
              <tbody >
                <?php if ($getCustomers_forzen) { $n=1;?>
                <?php foreach ($getCustomers_forzen as $customer) { 
                  //print_r($customer); die;
                ?>
                <tr class="" style="background: <?php echo ($customer['status'] == 10) ? 'rgba(255, 0, 0, 0.37)' : ''; ?>">
                  <!-- <td class="text-center"><?php if (in_array($customer['customer_id'], $selected)) { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                    <?php } ?></td> -->
                  <td><?php echo $n;?></td>
                  
                  <td class="text-left"><?php echo $customer['username']; ?></td>
                  <td><?php echo date('d/m/Y H:i:s',strtotime($customer['date_added'])) ?></td>
                  <td><?php echo date('d/m/Y H:i:s',strtotime($customer['date_off'])) ?></td>
                  <td><?php echo $customer['telephone']; ?></td>
                  <td>
                    <?php 
                   
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft->get_pnode($customer['p_node'])['username']; 
                    }
                   
                    ?>
                    
                  </td>



                  <td>
                  <?php
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft -> big_upline($customer['customer_id'])['middleline'];
                    }
                    
                    ?>
                  </td>
                  <td>
                  <?php
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft -> big_upline($customer['customer_id'])['bigupline'];
                    }
                    
                    ?>
                  </td>
                  <td>
                    <?php 
                      $get_gd_customer =($seft -> get_gd_customer($customer['customer_id'])); 
                      echo $get_gd_customer['total'];
                    ?>
                  </td>
                  <td>
                    <?php 
                     echo number_format($get_gd_customer['sum']);
                    ?>
                  </td>
                 <td class="text-left"><?php echo $customer['email']; ?></td>
                 <td class="text-center">
                  <?php if($customer['img_profile'] != "") { ?>
                  <a href="<?php echo $customer['img_profile']; ?>" target="_blank">
                    <img style="width:120px;    max-height: 92px;" src="<?php echo $customer['img_profile']; ?>" />
                  </a>
                  <?php } else {echo "Không có CMND"; }?>
                  </td>
                  <td><?php echo $customer['cmnd'] ?></td>
                  
                  <td>
                    <a href="index.php?route=sale/customer/edit&token=<?php echo $_GET['token']; ?>&customer_id=<?php echo $customer['customer_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php $n++; } ?>

                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        </div>
        </div>

        <div id="menu5" class="tab-pane fade">
          <div class="row">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
          <div class="table-responsive">
            <p>Màu đỏ: Tài khoản đã xóa</p>
            <div class="col-sm-4"></div>
            <div class="col-sm-3 input-group date">
                 <label class=" control-label" for="input-date_create">Start Data</label>
                 <input style="margin-top: 5px;" type="text" id="start_datesss" name="date_create" value="<?php echo date('d-m-Y') ?>" data-date-format="DD-MM-YYYY" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
              <div class="col-sm-3 input-group date">
                 <label class=" control-label" for="input-date_create">End Data</label>
                 <input style="margin-top: 5px;" type="text" id="end_datesss" name="date_create" value="<?php echo date('d-m-Y') ?>" data-date-format="DD-MM-YYYY" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
            <div class="col-md-2 pull-right">
              <button id="submit_fillterssaaaaaa" style="margin-top: 28px;" type="button" class="btn btn-success">Export</button>
            </div>
            <br>
            <script type="text/javascript">
              jQuery('#submit_fillterssaaaaaa').click(function(){
              window.location.replace("index.php?route=pd/repd/exportlock10&token=<?php echo $_GET['token']; ?>&start_date="+jQuery('#start_datesss').val()+"&end_date="+jQuery('#end_datesss').val());
          });
            </script>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <!-- <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td> -->
                  <td style="width: 40px;" >STT</td>
                 
                  <td style="width: 140px;" class="text-left" >Username
                  </td>
                  <td>Date Create</td>
                  <td>Date Lock</td>
                  <td>Telephone</td>
                   <td>Upline</td>
                   <td>Middle Upline</td>
                   <td>Big Upline</td>
                   <td>Số lần đã GD</td>
                   <td>Số tiền đã GD</td>
                   <td style="">Email</td>

                   <td>Images CMND</td>
                   <td>Number CMND</td>
                  <td style="width: 110px;" class="text-right">EDIT</td>
                </tr>
              </thead>
              <tbody >
                <?php if ($getCustomers_forzensss) { $n=1;?>
                <?php foreach ($getCustomers_forzensss as $customer) { 
                  //print_r($customer); die;
                ?>
                <tr class="" style="background: <?php echo ($customer['status'] == 10) ? 'rgba(255, 0, 0, 0.37)' : ''; ?>">
                  <!-- <td class="text-center"><?php if (in_array($customer['customer_id'], $selected)) { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                    <?php } ?></td> -->
                  <td><?php echo $n;?></td>
                  
                  <td class="text-left"><?php echo $customer['username']; ?></td>
                  <td><?php echo date('d/m/Y H:i:s',strtotime($customer['date_added'])) ?></td>
                  <td><?php echo date('d/m/Y H:i:s',strtotime($customer['date_off'])) ?></td>
                  <td><?php echo $customer['telephone']; ?></td>
                  <td>
                    <?php 
                   
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft->get_pnode($customer['p_node'])['username']; 
                    }
                   
                    ?>
                    
                  </td>
                   <td>
                  <?php
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft -> big_upline($customer['customer_id'])['middleline'];
                    }
                    
                    ?>
                  </td>
                  <td>
                  <?php
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft -> big_upline($customer['customer_id'])['bigupline'];
                    }
                    
                    ?>
                  </td>
                  <td>
                    <?php 
                      $get_gd_customer =($seft -> get_gd_customer($customer['customer_id'])); 
                      echo $get_gd_customer['total'];
                    ?>
                  </td>
                  <td>
                    <?php 
                     echo number_format($get_gd_customer['sum']);
                    ?>
                  </td>
                 <td class="text-left"><?php echo $customer['email']; ?></td>
                 <td class="text-center">
                  <?php if($customer['img_profile'] != "") { ?>
                  <a href="<?php echo $customer['img_profile']; ?>" target="_blank">
                    <img style="width:120px;    max-height: 92px;" src="<?php echo $customer['img_profile']; ?>" />
                  </a>
                  <?php } else {echo "Không có CMND"; }?>
                  </td>
                  <td><?php echo $customer['cmnd'] ?></td>
                  
                  <td>
                    <a href="index.php?route=sale/customer/edit&token=<?php echo $_GET['token']; ?>&customer_id=<?php echo $customer['customer_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php $n++; } ?>

                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        </div>
        </div>


        <div id="menu4" class="tab-pane fade">
          <div class="row">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <!-- <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td> -->
                  <td style="width: 40px;" >STT</td>
                 
                  <td style="width: 140px;" class="text-left" >Username
                  </td>
                   <td style="">Email</td>
                   <td>Images CMND</td>
                   <td>Number CMND</td>
                  <td style="width: 110px;">Phone</td>
                  <td style="width: 140px;">Presenter</td>
                  
                  <td style="width: 110px;" class="text-right">EDIT</td>
                </tr>
              </thead>
              <tbody >
                <?php if ($getCustomers_admin) { $n=1;?>
                <?php foreach ($getCustomers_admin as $customer) { 
                  //print_r($customer); die;
                ?>
                <tr class="">
                  <!-- <td class="text-center"><?php if (in_array($customer['customer_id'], $selected)) { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" class="select_cus" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                    <?php } ?></td> -->
                  <td><?php echo $n;?></td>
                  
                  <td class="text-left"><?php echo $customer['username']; ?></td>
                 <td class="text-left"><?php echo $customer['email']; ?></td>
                 <td class="text-center">
                  <?php if($customer['img_profile'] != "") { ?>
                  <a href="<?php echo $customer['img_profile']; ?>" target="_blank">
                    <img style="width:120px;    max-height: 92px;" src="<?php echo $customer['img_profile']; ?>" />
                  </a>
                  <?php } else {echo "Không có CMND"; }?>
                  </td>
                  <td><?php echo $customer['cmnd'] ?></td>
                  <td class="text-left"><?php echo $customer['telephone']; ?></td>
                  <td class="text-left">
                    <?php 
                   
                    if (count($seft->get_pnode($customer['p_node'])) > 0)
                    {
                      echo $seft->get_pnode($customer['p_node'])['username']; 
                    }
                   
                    ?>
                    
                  </td>
                  <td>
                    <a href="index.php?route=sale/customer/edit&token=<?php echo $_GET['token']; ?>&customer_id=<?php echo $customer['customer_id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php $n++; } ?>

                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    jQuery('#username').on("input propertychang", function() {
        jQuery.ajax({
        type: "POST",
        url: "<?php echo $getaccount;?>",
        data:{
            'keyword' : $(this).val()
        },
        success: function(data){
            jQuery("#suggesstion-box").show();
            jQuery("#suggesstion-box").html(data);
            jQuery("#p_node").css("background","#FFF");            
        }
        });
    });
    function selectU(val) {
        $('.loading').show();
        $("#username").val(val);
        $("#suggesstion-box").hide();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $show_gh_username;?>",
            data:{
                'username' : val
            },
            success: function(data){
               $('.loading').hide();
                    jQuery('#result_date').html(data);           
                }
            });
    }

    $('#submit_date').click(function(){
        $('.loading').show();
        var date_day = $('#date_day').val();
        $.ajax({
            url : "<?php echo $load_pin_date ?>",
            type : "post",
            dataType:"text",
            data : {
                'date' : date_day
            },
            success : function (result){
                $('.loading').hide();
                jQuery('#result_date').html(result);
            }
        });

        /*$.ajax({
            url : "index.php?route=pd/matched/get_popup&token=<?php echo $_GET['token'];?>",
            type : "post",
            dataType:"text",
            data : {
                'date' : date_day
            },
            success : function (result){
                $('.loading').hide();
                console.log(result);
            }
        });*/
    });
    $('.date').datetimepicker({
        pickTime: false
    });
    jQuery('#submit_fillter').click(function(){
        window.location.replace("<?php echo $export; ?>&start_date="+jQuery('#start_date').val()+"&end_date="+jQuery('#end_date').val());
    });
    
</script>
<style type="text/css">
    .panel-body{
        min-height: 500px;
    }
   ul#suggesstion-box,ul#suggesstion {
        position: absolute;
        width: 94%;
        background: #fff;
        color: #000;
    }
    #suggesstion-box li.list-group-item,#suggesstion li.list-group-item {
        cursor: pointer;
    }
    #suggesstion-box li.list-group-item:hover,#suggesstion li.list-group-item:hover {
        background: #626f78;
        cursor: pointer;
        color: #fff;
    }
</style>
<?php echo $footer; ?>