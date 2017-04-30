<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Level</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Level</h3>
    </div>
    <div class="panel-body">
      
        <div class="clearfix" style="margin-bottom: 28px;"></div>
        <div class="tab-content row" style="overflow-x: scroll;">
          
     	<table class="table table-bordered table-hover">
     		<thead>
     			<tr>
     				<th class="text-center">TT</th>
                    <!-- <th>ID</th> -->
     				<th class="text-center">Username</th>
     				
     				<th class="text-center">Number F1</th>
            <th class="text-center">Level hiện tại</th>
            <th class="text-center">Lên Level</th>
            <th class="text-center">Parent</th>
            <th class="text-center">Date create</th>
     			</tr>
     		</thead>
     		<tbody id="result_date"> 
               
                <?php $stt = 0;
                foreach ($get_all_customer as $value) { $stt ++?>
                  <tr>
                    <td class="text-center"><?php echo $stt; ?></td>
                    <!-- <td><?php echo $value['customer_id'] ?></td> -->
                    <td class="text-center"><?php echo $value['username'] ?></td>
                    
                    <td class="text-center"><?php echo $selt -> get_level($value['customer_id']) ?></td>
                    <td class="text-center"><span class="label label-info"> Level <?php echo $value['level']-1 ?></span></td>
                    <td class="text-center">
                      <?php switch ($value['level']) {
                        case 1:
                          $p_node = 6;
                          break;
                        case 2:
                          $p_node = 36;
                          break;
                        case 3:
                          $p_node = 216;
                          break;
                        case 4:
                          $p_node = 1296;
                          break;
                        case 5:
                          $p_node = 7776;
                          break;
                      }  
                        if (intval($selt -> get_level($value['customer_id'])) >= $p_node) { ?>
                          <span class="label label-success">Đủ điều kiện lên level <?php echo $value['level'] ?></span>
                      <?php   } else {  ?>
                        <span class="label label-warning">Chưa đủ điều kiện lên cấp</span>
                        <?php }

                      ?>
                      
                    </td>
                    <td class="text-center"><?php echo $selt -> getCustomer($value['p_node']) ?></td>
                    <td class="text-center"><?php echo $value['date_added'] ?></td>
                    
                </tr>  
              
                <?php } ?>
                
               
     		</tbody>
     	</table>
      <?php echo $pagination ?>
        
        </div>
          
         
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#submit_date').click(function(){
        var date_day = $('#date_day').val();
        $.ajax({
            url : "<?php echo $load_pin_date ?>",
            type : "post",
            dataType:"text",
            data : {
                'date' : date_day
            },
            success : function (result){
                jQuery('#result_date').html(result);
            }
        });
    });
    $('.date').datetimepicker({
        pickTime: false
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
    jQuery('#submit_fillter').click(function(){
        window.location.replace("<?php echo $export; ?>&start_date="+jQuery('#start_date').val()+"&end_date="+jQuery('#end_date').val());
    });
</script>
<?php echo $footer; ?>
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