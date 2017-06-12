<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Danh sách nhắc nhở PD</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Danh sách nhắc nhở PD</h3>
    </div>
    <div class="panel-body">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Nhắc nhở PD</a></li>
        <li><a data-toggle="tab" href="#menu1">PD thành viên đang hoạt động</a></li>
        <li><a data-toggle="tab" href="#menu2">ID chưa PD lần nào</a></li>
      </ul>

      <div class="tab-content row">
        <div id="home" class="tab-pane fade in active">

          <div class="col-md-2 pull-right">
      <span class="url_xuatpin" href="" style="margin-bottom:10px; float:right;margin-top: 28px;">
            <a target="_blank" href="index.php?route=pd/pd_month/export_tab1&token=<?php echo $_GET['token'];?>">
                <div class="btn btn-success pull-right">Export Excel</div>
            </a>
        </span>
      </div>
        
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>TT</th>
                <th>Username</th>
                <th>SDT</th>
                <th>Up line</th>
                <th>Big Upline</th>
                <th>Number PD</th>
                <th>Min PD</th>
                <th>Date PD not match </th>
                <th>Date Lock</th>
              </tr>
            </thead>
               
            <tbody id="result_date"> 
                    <?php $stt = 0;
                    $data_add = date('Y-m-d');
                    $pd_nn = 0;
                    foreach ($pin as $value) { $stt ++?>
                      <?php $get_level = $seft -> get_level($value['customer_id']);

                        switch ($get_level['level']) {
                              case 1:
                                $num_pd = 3;
                                break;
                              case 2:
                                $num_pd = 4;
                                break;
                              case 3:
                                $num_pd = 7;
                                break;
                              case 4:
                                $num_pd = 9;
                                break;
                              case 5:
                                $num_pd = 1;
                                break;
                              case 6:
                                $num_pd = 13;
                                break;
                      }
                      if ($value['total_pd'] < $num_pd) {
                        $pd_nn += 1;
                       ?>
                      
                      <tr style="background: <?php echo $data_add == date('Y-m-d',strtotime($value['date_added'])) ? "rgba(76, 175, 80, 0.36)" : "rgba(115, 115, 115, 0.74)" ; ?>">
                        <td><?php echo $pd_nn; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id']);
                            ?>
                        </td>

                        <td><?php echo $value['total_pd'] ?></td>
                        <td><?php echo $num_pd ?></td>

                        <td class="text-center">
                          <?php 
                            $get_pd_not_macth = $seft -> get_pd_not_macth($value['customer_id']);
                            foreach ($get_pd_not_macth as $value_pd) { ?>
                              <p class="label label-success"><?php echo date('d/m/Y H:i:s',strtotime($value_pd['date_added'])); ?> | <?php echo number_format($value_pd['filled']) ?> VNĐ
                              </p><br>
                           <?php }
                          ?>
                        </td>

                        <td><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo $value['date_block']; ?>">
                        
                    </tr>  
                    
                 
                    <?php } }?>
            </tbody>
          </table>
        </div>


        <div id="menu1" class="tab-pane fade">
          <div class="col-sm-1 input-group date pull-right">
                    
            <button id="submit_fillters" style="margin-top: 22px;" class="btn btn-success submit_fillters">Export Excel</button>
             

          </div>
          <div class="col-sm-3 input-group date pull-right">
             <label class=" control-label" for="input-date_create">Số ngày còn lại để khóa</label>
             <select id="num_day" class="form-control">
              <?php for ($i=1; $i < 31; $i++) {  ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
              <?php } ?>
               
             </select>
             
          </div>
            <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>TT</th>
                <th>Username</th>
                 <th>SDT</th>
                <th>Up line</th>
                <th>Big Upline</th>
                <th>Number PD</th>
                <th>Max PD</th>
                <th>Date PD not match </th>
                <th>Date Lock</th>
              </tr>
            </thead>
               
            <tbody id="result_date"> 
                    <?php $stt = 0;
                    $data_add = date('Y-m-d');
                    $tt_hd = 0;
                    foreach ($pd_user_all as $value) { $stt ++?>
                      <?php $get_level = $seft -> get_level($value['customer_id']);

                        switch ($get_level['level']) {
                              case 1:
                                $num_pd = 3;
                                break;
                              case 2:
                                $num_pd = 5;
                                break;
                              case 3:
                                $num_pd = 7;
                                break;
                              case 4:
                                $num_pd = 9;
                                break;
                              case 5:
                                $num_pd = 1;
                                break;
                              case 6:
                                $num_pd = 13;
                                break;
                      }
                      if ($value['total_pd'] < $num_pd) {
                        $tt_hd += 1;
                       ?>
                      
                      <tr style="background: <?php echo $data_add == date('Y-m-d',strtotime($value['date_added'])) ? "rgba(76, 175, 80, 0.36)" : "rgba(115, 115, 115, 0.74)" ; ?>">
                        <td><?php echo $tt_hd; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id']);
                            ?>
                        </td>

                        <td><?php echo $value['total_pd'] ?></td>
                        <td><?php echo $num_pd ?></td>
                        <td class="text-center">
                          <?php 
                            $get_pd_not_macth = $seft -> get_pd_not_macth($value['customer_id']);
                            foreach ($get_pd_not_macth as $value_pd) { ?>
                              <p class="label label-success"><?php echo date('d/m/Y H:i:s',strtotime($value_pd['date_added'])); ?> | <?php echo number_format($value_pd['filled']) ?> VNĐ
                              </p><br>
                           <?php }
                          ?>
                        </td>
                        
                        <td><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo $value['date_block']; ?>">
                        
                    </tr>  
                    
                 
                    <?php } }?>
            </tbody>
          </table>
        </div>


        <div id="menu2" class="tab-pane fade">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>TT</th>
                <th>Username</th>
                 <th>SDT</th>
                <th>Up line</th>
                <th>Big Upline</th>
                <th>Number PD</th>
                <th>Max PD</th>
                <th>Date Lock</th>
              </tr>
            </thead>
               
            <tbody id="result_date"> 
                    <?php $stt_none = 0;
                    $data_add = date('Y-m-d');
                    foreach ($pd_user_all_node as $value) { $stt ++?>
                      <?php $get_level = $seft -> get_level($value['customer_id']);

                        switch ($get_level['level']) {
                              case 1:
                                $num_pd = 3;
                                break;
                              case 2:
                                $num_pd = 5;
                                break;
                              case 3:
                                $num_pd = 7;
                                break;
                              case 4:
                                $num_pd = 9;
                                break;
                              case 5:
                                $num_pd = 1;
                                break;
                              case 6:
                                $num_pd = 13;
                                break;
                      }
                      if ($value['total_pd'] < $num_pd) {
                        $stt_none += 1;
                       ?>
                      
                      <tr style="background: <?php echo $data_add == date('Y-m-d',strtotime($value['date_added'])) ? "rgba(76, 175, 80, 0.36)" : "rgba(115, 115, 115, 0.74)" ; ?>">
                        <td><?php echo $stt_none; ?></td>
                        
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['telephone'] ?></td>
                        <td><?php echo $value['upline'] ?></td>
                        <td>
                            <?php 
                                echo $seft -> big_upline($value['customer_id']);
                            ?>
                        </td>

                        <td><?php echo $value['total_pd'] ?></td>
                        <td><?php echo $num_pd ?></td>
                        <td><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo $value['date_block']; ?>">
                        
                    </tr>  
                    
                 
                    <?php } }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    jQuery('.submit_fillters').click(function(){
        window.location.replace("<?php echo $exports; ?>&num_day="+jQuery('#num_day').val());
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