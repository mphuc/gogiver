<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Tạo PD ảo</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Tạo PD ảo</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="index.php?route=pd/create_pd/submit&token=<?php echo $_GET['token'] ?>">
        <div class="col-md-4 col-md-push-4">
            <div class="form-group">
            <div class="col-md-12">
                <label class=" control-label" for="input-date_create">Username</label>
                 <input required="true" style="margin-top: 5px;" type="text" id="username" class="form-control" placeholder="Username">
                 <ul id="suggesstion-box" style="z-index: 999999" class="list-group"></ul>
            </div>
            <div class="col-md-12">
            <label class=" control-label" for="input-date_create">Customer_id</label>
            <input style="margin-top: 5px;"  readonly="true" type="text" name="customer_id" id="customer_id" class="form-control" placeholder="customer_id">
            </div>

            <div class="col-md-12">
            <label class=" control-label" for="input-date_create">Send Pin</label>
            <input style="margin-top: 5px;"  required="true" type="text" name="send_pin" id="" class="form-control" placeholder="Send Pin" value="<?php if (isset($self -> session -> data['send_pin_pd'])) echo $self -> session -> data['send_pin_pd'];?>">
            </div>
            

            <div class="col-sm-12 input-group date">
                 <label class=" control-label" for="input-date_create">Date</label>
                 <input style="margin-top: 5px;" type="text" id="start_date" name="date" value="<?php if (isset($self -> session -> data['date_create_pd'])) echo $self -> session -> data['date_create_pd']; else echo date('d-m-Y')?>" data-date-format="DD-MM-YYYY" id="date_create" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
            </div>

            <div class="col-md-12">

                <button class="form-control btn btn-success" style="margin-top: 20px;">Create</button>
            </div>
              
        </div>
      </form>
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

                    jQuery('#customer_id').val(data);           
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