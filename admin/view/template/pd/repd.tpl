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
    <div class="col-md-2 pull-right">
      <span class="url_xuatpin" href="" style="margin-bottom:10px; float:right;margin-top: 28px;">
            <a target="_blank" href="index.php?route=pd/repd/export&token=<?php echo $_GET['token'];?>">
                <div class="btn btn-success pull-right">Export Excel</div>
            </a>
        </span>
      </div>
    <div class="panel-body">
     	<table class="table table-bordered table-hover">
     		<thead>
     			<tr>
     				<th>TT</th>
                    <th>Username</th>
                    <th>Telephone</th>
                    <th>Upline</th>
                    <th>Middle Upline</th>
                    <th>Big Upline</th>
                    <th>GD</th>
     				<th>Date Re PD</th>
     			</tr>
     		</thead>
            
     		<tbody id="result_date"> 
                <?php $stt = 0;
                foreach ($pin as $value) { $stt ++?>
                  <tr>
                    <td><?php echo $stt; ?></td>
                    
                    <td><?php echo $value['username'] ?></td>
                    <td><?php echo $value['telephone'] ?></td>
                    <td><?php echo $value['upline'] ?></td>
                    <td><?php echo $seft -> big_upline($value['customer_id'])['middleline'] ?></td>
                     <td><?php echo $seft -> big_upline($value['customer_id'])['bigupline'] ?></td>
                    <td>GD<?php echo $value['gd_number'] ?></td>
                    <td><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo $value['date_finish']; ?>">
                     </span> </td>

                     <td>
                        <?php if ($seft -> big_upline($value['customer_id'])['bigupline'] == "HoXuan" || $seft -> big_upline($value['customer_id'])['bigupline'] == "NgocMinh") {?>
                        <a href="index.php?route=pd/repd/lock_repd&id=<?php echo $value['id'] ?>&token=<?php echo $_GET['token'];?>"> Lock
                
                        </a>
                        <?php } ?>
                     </td>

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