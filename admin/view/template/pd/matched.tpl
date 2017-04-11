<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>List GH</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">List GH</h3>
    </div>
    <div class="panel-body">
        <div class="pull-left row">
            <div class="form-group">
            <!-- <div class="col-md-3">
                <label class=" control-label" for="input-date_create">Username</label>
                 <input style="margin-top: 5px;" type="text" id="username" class="form-control"  placeholder="Username"> 
                 <ul id="suggesstion-box" class="list-group"></ul>
            </div> -->
            <div class="col-sm-2 input-group date">
                 <label class=" control-label" for="input-date_create">Date</label>
                 <input style="margin-top: 5px;" type="text" id="date_day" name="date_create" value="<?php echo date('d-m-Y')?>" placeholder="Ngày đăng ký" data-date-format="DD-MM-YYYY" id="date_create" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
              <div class="col-sm-2">
                <button id="submit_date" style="margin-top: 28px;" type="button" class="btn btn-success">Lọc</button>
              </div>
              <!-- <div class="col-sm-2 input-group date">
                 <label class=" control-label" for="input-date_create">Start Data</label>
                 <input style="margin-top: 5px;" type="text" id="start_date" name="date_create" value="<?php echo date('d-m-Y')?>" data-date-format="DD-MM-YYYY" id="date_create" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
              <div class="col-sm-2 input-group date">
                 <label class=" control-label" for="input-date_create">End Data</label>
                 <input style="margin-top: 5px;" type="text" id="end_date" name="date_create" value="<?php echo date('d-m-Y')?>" data-date-format="DD-MM-YYYY" id="date_create" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div> -->
              <!-- <div class="col-sm-1">
                <button id="submit_fillter" style="margin-top: 28px;" type="button" class="btn btn-success">Export</button>
                
              </div> -->
            </div>
        </div>
        <div class="clearfix" style="margin-bottom: 28px;"></div>
        <!-- <a href="index.php?route=report/exportCustomer/xuatpin&token=<?php echo $_GET['token'];?>" style="margin-bottom:10px; float:right">
            <div class="btn btn-success pull-right">Xuất Excel</div>
        </a> -->

     	<table class="table table-bordered table-hover">
     		<thead>
     			<tr>
     				<th>TT</th>
                    <!-- <th>ID</th> -->
                    <th>Amount</th>
     				<th>Username PD</th>
                    <th>Username GD</th>
                    
                    <th>Status PD</th>
                    <th>Status GD</th>
                    <th>Date</th>
     			</tr>
     		</thead>
            
     		<tbody id="result_date"> 
                <?php $stt = 0;
                foreach ($pin as $value) { $stt ++?>
                  <tr>
                    <td><?php echo $stt; ?></td>
                    
                    <td><?php echo $value['pd_username'] ?></td>
                    <td><?php echo $value['gd_username'] ?></td>
                    <td><?php echo number_format($value['amount']) ?> VNĐ</td>
                    <td><?php 

                    if ($value['pd_satatus'] == 0) {
                        echo "<span class='label label-default'>Watting</span>";
                    }
                    if ($value['pd_satatus'] == 1) { ?>
                       <span style="cursor: pointer;" class='label label-success' data-toggle="modal" data-target="#myModalPD<?php echo $value['transfer_code'] ?>" >Finish</span> 
                    <?php } 
                    if ($value['pd_satatus'] == 2) {
                        echo "<span class='label label-danger'>Report</span>";
                    }
                    ?> </td>
                    
                    <td><?php 

                    if ($value['gd_status'] == 0) {
                        echo "<span class='label label-default'>Watting</span>";
                    }
                   
                    if ($value['gd_status'] == 1) {
                        echo "<span class='label label-success' >Finish</span>";
                    } 
                    if ($value['gd_status'] == 2) {?> 
                        <span style="cursor: pointer;" class='label label-danger' data-toggle="modal" data-target="#myModalGD<?php echo $value['transfer_code'] ?>" >Report</span> 
                   <?php }
                    ?> </td>
                   
                    <td><?php echo date('d/m/Y H:i',strtotime($value['date_added'])) ?></td>
                    
                </tr>  
              
                
                
               <!-- PD -->
               <div class="modal fade" id="myModalPD<?php echo $value['transfer_code'] ?>" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="myModalLabelSTAR2017040554482">PD Finish <?php echo $value['pd_username'] ?> | <?php echo number_format($value['amount']) ?> VNĐ</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row-fluid">
                            <img style="width: 100%" src="<?php echo $value['image'];?>">
                           
                        </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     
                    </div>
                    
                  </div>

                <!-- GD -->
               <div class="modal fade" id="myModalGD<?php echo $value['transfer_code'] ?>" role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="">GD Report <?php echo $value['gd_username'] ?> | <?php echo number_format($value['amount']) ?> VNĐ</h4>
                      </div>
                      <div class="modal-body">

                        <div class="row-fluid">
                            <p style="margin-bottom: 20px;">
                            
                            <?php echo ($value['text_report'] == "no_money") ? "Lý do: tôi chưa nhận được tiền" : "Lý do: ".$value['text_report']; ?>
                            </p>
                            <img style="width: 100%" src="<?php echo $value['image'];?>">
                           
                        </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     
                    </div>
                    
                  </div>


                <?php } ?>
     		</tbody>
     	</table>
        
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