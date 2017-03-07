<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Manager Mail</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Manager Mail</h3>
    </div>
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Mail customer</a></li>
      <li><a data-toggle="tab" href="#menu1">Mail Send</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
          <div class="panel-body row">
              <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Username</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Imgages</th>
                  <th>Date_added</th>
                  <th>Reply</th>
                </tr>
              </thead>
              <tbody>
                <?php $stt = 1; $sum=0;
                  foreach ($pin as $key => $value) { ?>
                <tr>
                  <td><?php echo $stt; ?></td>
                  <td><?php echo $value['username'] ?></td>
                  <td><?php echo $value['title'] ?></td>
                  <td><?php echo $value['description'] ?></td>
                  <td><img style="width: 100px;" src="<?php echo $value['images'] ?>" /></td>
                  <td><?php echo  date('d/m/Y H:i:s',strtotime($value['date_added'])) ?></td>
                  <td>
                    <a href="index.php?route=pd/sendmail_customer&token=<?php echo $_GET['token'] ?>&customer_id=<?php echo $value['customer_id'] ?>">
                      <button class="btn btn-success">Reply</button>
                    </a>
                  </td>
                </tr>

                <?php $stt ++; } ?>
              </tbody>
            </table>
            <?php echo $pagination ?>
           	
          </div>
        </div>
      <div id="menu1" class="tab-pane fade">
          <div class="panel-body row">
              <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Username Send</th>
                  <th>Title</th>
                  <th>Content</th>
                  
                  <th>Date_added</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php $stt = 1; $sum=0;
                  foreach ($get_all_mail_admin as $key => $value) { ?>
                <tr>
                  <td><?php echo $stt; ?></td>
                  <td><?php echo $value['username'] ?></td>
                  <td><?php echo $value['title'] ?></td>
                  <td><?php echo $value['description'] ?></td>
                  
                  <td><?php echo  date('d/m/Y H:i:s',strtotime($value['date_added'])) ?></td>
                  
                </tr>

                <?php $stt ++; } ?>
              </tbody>
            </table>
            <?php echo $paginations ?>
            
          </div>
        


      </div>
      
    </div>

  </div>
</div>
<script type="text/javascript">
   if (location.hash === '#suscces') {
     alert("Send mail complete !")
   }
</script>  
<?php echo $footer; ?>