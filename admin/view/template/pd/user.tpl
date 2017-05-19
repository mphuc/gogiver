<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>List User trùng</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">List User trùng</h3>
    </div>
    <div class="panel-body">
     	<table class="table table-bordered table-hover">
     		<thead>
     			<tr>
     				<th>TT</th>
            <th>Username</th>
            
     			</tr>
     		</thead>
            
     		<tbody id="result_date"> 
                <?php $stt = 0;
                foreach ($pin as $value) { $stt ++?>
                  <tr>
                    <?php if ($value['account_holder']) { ?>
                    <td><?php echo $stt; ?></td>
                    
                    <td>
                        <p><?php echo $value['username']." - ".$value['account_holder']." - ".$value['account_number'] ?></p>
                        <?php
                            $get_account_hoder = $seft -> get_account_hoder($value['customer_id'],$value['account_holder']); 
                            foreach ($get_account_hoder as $values) { ?>
                                <p><?php echo $values['username']." - ".$values['account_holder']." - ".$values['account_number'] ?></p>
                            <?php }
                            
                        ?>    
                    </td>
                    <?php } ?>
                </tr>  
              
        
                <?php } ?>
     		</tbody>
     	</table>
        <?php echo $pagination ?>
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