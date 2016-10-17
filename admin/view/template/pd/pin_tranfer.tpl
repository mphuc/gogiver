<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Pin</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Pin</h3>
    </div>
    <div class="panel-body">
        <div class="pull-left">
            <div class="form-group row">
            <div class="col-sm-3 input-group date">
                 <label class=" control-label" for="input-date_create">Lọc theo ngày</label>
                 <input style="margin-top: 5px;" type="text" id="date_day" name="date_create" value="<?php echo date('d-m-Y')?>" placeholder="Ngày đăng ký" data-date-format="DD-MM-YYYY" id="date_create" class="form-control">
                 <span class="input-group-btn">
                 <button style="margin-top:28px" type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                 </span>
              </div>
              <div class="col-sm-3">
                <button id="submit_date" style="margin-top: 28px;" type="button" class="btn btn-success">Lọc</button>
              </div>
              <div class="col-md-2">
              <span class="url_xuatpin" href="" style="margin-bottom:10px; float:right;margin-top: 28px;">
                    <div class="btn btn-success pull-right">Xuất Excel</div>
                </span>
              </div>
            </div>
        </div>
        
     	<table class="table table-bordered table-hover">
     		<thead>
     			<tr>
     				<th>TT</th>
     				<th>Username</th>
     				<th>Amount</th>
     				<th>Date</th>
                    <th>Type</th>
                    <th>Description</th>
     			</tr>
     		</thead>
     		<tbody id="result_date"> 
               
                <?php $stt = 0;
                
                foreach ($pin as $value) { $stt ++?>
                
                  <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $value['username'] ?></td>
                    <td><?php echo $value['amount'] ?></td>
                    <td><?php echo date('d/m/Y H:i:s',strtotime($value['date_added'])) ?></td>
                    <td><?php echo $value['type'] ?></td>
                    <td><?php echo $value['system_description'] ?></td>
                </tr>  
                <?php } ?>
                
               
     		</tbody>
     	</table>
        <?php echo $pagination ?>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#submit_date').click(function(){
        var date_day = $('#date_day').val();
        $.ajax({
            url : "<?php echo $load_pinhistory_date ?>",
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
    jQuery('.url_xuatpin').click(function(){
        var date_day = $('#date_day').val();
        //alert(date_day);
        //return false;
        window.location.replace("index.php?route=report/exportCustomer/xuatpin&date="+date_day+"&token=<?php echo $_GET['token'];?>");
    })
</script>
<?php echo $footer; ?>