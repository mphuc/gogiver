<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Danh sách nhắc nhở</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Danh sách nhắc nhở</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">Danh sách ID F1 không kích pin</a></li>
          <li><a data-toggle="tab" href="#menu1">Danh sách ID chưa kích đủ pin từ 16/04</a></li>
          <li><a data-toggle="tab" href="#menu2">Trạng thái user</a></li>
        </ul>
        <div class="tab-content row" style="overflow-x: scroll;">
          <div id="home" class="tab-pane fade in active">
            <a target="_bank" href="index.php?route=pd/user45/exportafter45&token=<?php echo $_GET['token'] ?>" class="pull-right" style="margin-bottom: 20px;">
                <button class="btn btn-success">Export Excel</button>
            </a>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TT</th>
                        <th>Username</th>
                        <th>SDT</th>
                        <th>Up line</th>
                        <th>Middle Upline</th>
                        <th>Big Upline</th>
                        <th>Số F1 kích pin</th>
                        <th>Thời gian bắt đầu kích pin</th>
                        <th>Số ngày</th>
                    </tr>
                </thead>

                <tbody id="result_date"> 
                    <?php $stt = 0;
                    $date_now = date('Y-m-d H:i:s');
                    foreach ($pin as $value) { 
                        $get_account_pin = $selt -> get_account_pin($value['customer_id']);
                        $day = strtotime($date_now) - strtotime($value['date_added']);
                        $day = floor($day/86400);
                        if ($day >= 45 && count($get_account_pin) == 0) {
                            $stt ++;
                    ?>
                      <tr>
                        <td><?php echo $stt; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id'])['middleline'];
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id'])['bigupline'];
                            ?>
                        </td>
                        <td><?php echo count($get_account_pin) ?></td>
                        <td><span> <?php echo date('d/m/Y H:i:s',strtotime($value['date_added'])); ?>
                         </span> </td>
                         <td><?php echo $day ?></td>
                    </tr>  
                    <?php } ?>
                  
            
                    <?php } ?>
                </tbody>
            </table>
          </div>
          <div id="menu1" class="tab-pane fade">
            <div class="form-group pull-right">
                <div class="col-md-4"></div>
                <?php 
                    $date_added = date('d-m-Y');
                    $date_finish = strtotime ( '- 30 day' , strtotime ($date_added));
                    $date_finish= date('d-m-Y',$date_finish) ;
                ?>

                <div class="col-sm-3 input-group date">
                     <label class=" control-label" for="input-date_create">Start Data</label>
                     <input style="margin-top: 5px;" type="text" id="start_date" name="date_create" value="<?php echo $date_finish ?>" data-date-format="DD-MM-YYYY" class="form-control">
                     <span class="input-group-btn">
                     <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                     </span>
                </div>
                <div class="col-sm-3 input-group date">
                     <label class=" control-label" for="input-date_create">End Data</label>
                     <input style="margin-top: 5px;" type="text" id="end_date" name="date_create" value="<?php echo $date_added ?>" data-date-format="DD-MM-YYYY" class="form-control">
                     <span class="input-group-btn">
                     <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                     </span>
                </div>
                <div class="col-sm-1 input-group date">
                    
                        <button id="submit_fillter" style="margin-top: 28px;" class="btn btn-success">Export Excel</button>
                   

                </div>
            </div>
            
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TT</th>
                        <th>Username</th>
                        <th>SDT</th>
                        <th>Up line</th>
                        <th>Middle Upline</th>
                        <th>Big Upline</th>
                        <th>Số PD đã kích</th>
                        <th>PD tối thiểu</th>
                        <th>Các PD đã kích</th>
                    </tr>
                </thead>

                <tbody id="result_date"> 
                    <?php $stt = 0;
                    $date_now = date('Y-m-d H:i:s');
                    $tt_hd = 0;
                    foreach ($count_all_customer as $value) { ?>
                    <?php $get_level = $selt -> get_level($value['customer_id']);

                        switch ($get_level['level']) {
                            case 1:
                                $num_pd = 3;
                                break;
                              case 2:
                                $num_pd = 4;
                                break;
                              case 3:
                                $num_pd = 5;
                                break;
                              case 4:
                                $num_pd = 7;
                                break;
                              case 5:
                                $num_pd = 10;
                                break;
                              case 6:
                                $num_pd = 11;
                                break;
                      }

                      $get_provine_16_04 = $selt -> get_provine_16_04($value['customer_id']);

                      if (count($get_provine_16_04) < $num_pd) {
                        $tt_hd += 1;
                       ?>


                      <tr>
                        <td><?php echo $tt_hd; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id'])['middleline'];
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id'])['bigupline'];
                            ?>
                        </td>
                        <td><?php echo count($get_provine_16_04) ?></td>
                         </span> </td>
                         <td><?php echo $num_pd ?></td>

                         <td class="text-center">
                          <?php 
                            
                            foreach ($get_provine_16_04 as $value_pd) { ?>
                              <p class="label label-success"><?php echo date('d/m/Y H:i:s',strtotime($value_pd['date_added'])); ?> | <?php echo number_format($value_pd['filled']) ?> VNĐ
                              </p><br>
                           <?php }
                          ?>
                        </td>

                    </tr>  
                    <?php } ?>
                  
            
                    <?php } ?>
                </tbody>
            </table>
          </div>


        <div id="menu2" class="tab-pane fade">
            
            <a target="_bank" href="index.php?route=pd/user45/exportafter_all&token=<?php echo $_GET['token'] ?>" class="pull-right" style="margin-bottom: 20px;">
                <button class="btn btn-success">Export Excel</button>
            </a>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TT</th>
                        <th>Username</th>
                        <th>SDT</th>
                        <th>Up line</th>
                        <th>Middle Upline</th>
                        <th>Big Upline</th>
                        <th>Trạng thái</th>
                       
                    </tr>
                </thead>

                <tbody id="result_date"> 
                <?php $array = array(3,4,5,7,485,1319) ?>
                <?php foreach ($array as  $item) { ?>
                    
                
                    <?php 
                        $user = $selt -> get_all_child($item);
                        $user = explode(",",$user);
                        $iii = 0;
                        foreach ($user as $values) {
                        $iii++; 
                       $value = $selt -> get_user_customer($values);
                    ?>
                       
                    <tr>
                    <td><?php echo $iii; ?></td>
                        
                    <td><?php echo $value['username'] ?></td>
                    <td><?php echo $value['telephone'] ?></td>
                    <td><?php echo $value['upline'] ?></td>
                    <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id'])['middleline'];
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id'])['bigupline'];
                            ?>
                        </td>
                    <td>
                        <?php if ($value['status'] == 1 || $value['status'] == 2) echo "Hoạt động";
                            if ($value['status'] == 8)
                            {
                                echo "Bị khóa";
                            }
                            if ($value['status'] == 10)
                            {
                                echo "Đã xóa";
                            }
                        ?>
                    </td>
                    </tr>
                    <?php }   ?>
                    <tr><td></td><td></td><td></td><td></td></tr>

                    <?php } ?>
                      
                </tbody>
            </table>
        </div>
     	
        </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">

    $('#submit_fillter').on('click',function(){
        window.location.replace("index.php?route=pd/user45/exportall_customer&token=<?php echo $_GET['token'] ?>&start_date="+jQuery('#start_date').val()+"&end_date="+jQuery('#end_date').val());
    });

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