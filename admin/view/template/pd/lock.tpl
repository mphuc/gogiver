<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Lock</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Lock</h3>
    </div>
    <div class="panel-body">
        
        <div class="tab-content row" style="overflow-x: scroll;">
            <ul class="nav nav-tabs" style="margin-bottom: 20px;">
              <li class="active"><a data-toggle="tab" href="#home">Danh sách bị phạt</a></li>
              <li><a data-toggle="tab" href="#menu1">Danh sách đã mở khóa</a></li>
            </ul>
          <div id="home" class="tab-pane fade in active">
            <a target="_bank" href="index.php?route=pd/lock/exportlock&token=<?php echo $_GET['token'] ?>" class="pull-right" style="margin-bottom: 20px;">
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
                        <th>Date lock</th>
                        <th>Number lock</th>
                        <th>C Wallet</th>
                        <th>R Wallet</th>
                        <th>Reason</th>

                    </tr>
                </thead>

                <tbody id="result_date"> 
                    <?php $stt = 0;
                    $date_now = date('Y-m-d H:i:s');
                    foreach ($pin as $value) { 
                        $stt ++;
                    ?>
                      <tr>
                        <td><?php echo $stt; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $selt -> big_upline($value['customer_id'])['middleline'];
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo $selt -> big_upline($value['customer_id'])['bigupline'];
                            ?>
                        </td>
                        <td><?php echo date('d/m/Y H:i:s',strtotime($value['date'])); ?></td>
                        <td><?php echo $selt -> get_num_lock($value['customer_id']) ?></td>
                        <td><?php echo number_format($value['c_wallet']) ?> VND</td>
                        <td><?php echo number_format($value['r_wallet']) ?> VND</td>
                        <td><?php echo $value['description'] ?></td>
                    </tr>  
                    
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
                        <th>Middle Upline</th>
                        <th>Big Upline</th>
                        <th>Date lock</th>
                        <th>C Wallet</th>
                        <th>R Wallet</th>
                        <th>Reason</th>

                    </tr>
                </thead>

                <tbody id="result_date"> 
                    <?php $stt = 0;
                    $date_now = date('Y-m-d H:i:s');
                    foreach ($pins as $value) { 
                        $stt ++;
                    ?>
                      <tr>
                        <td><?php echo $stt; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $selt -> big_upline($value['customer_id'])['middleline'];
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo $selt -> big_upline($value['customer_id'])['bigupline'];
                            ?>
                        </td>
                        <td><?php echo date('d/m/Y H:i:s',strtotime($value['date'])); ?></td>
                        <td><?php echo number_format($value['c_wallet']) ?> VND</td>
                        <td><?php echo number_format($value['r_wallet']) ?> VND</td>
                         <td><b><?php echo $value['description'] ?></b></td>
                    </tr>  
                    
                    <?php } ?>
                </tbody>
            </table>
            <?php echo $pagination ?>
            
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