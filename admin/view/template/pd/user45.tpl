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
        </ul>
        <div class="tab-content row" style="overflow-x: scroll;">
          <div id="home" class="tab-pane fade in active">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TT</th>
                        <th>Username</th>
                        <th>SDT</th>
                        <th>Up line</th>
                        
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
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TT</th>
                        <th>Username</th>
                        <th>SDT</th>
                        <th>Up line</th>
                        
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