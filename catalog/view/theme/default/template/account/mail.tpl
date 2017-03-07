<?php 
   $self -> document -> setTitle('Mail'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="main-content">
<!-- Start .content -->
<div class="content" style="">
<div class="row">
<!-- .row start -->
<div class="col-md-12">
<!-- col-md-12 start here -->
<div class="panel panel-default" id="dash_0">
   <!-- Start .panel -->
   <div class="panel-heading">
      <h4 class="panel-title"><i class="fa fa-align-justify"></i>Mail</h4>
   </div>
   <div class="panel-body form-horizontal group-border stripped">
      <div class="form-group">
         <div class="col-lg-12 col-md-12">
            <div class="input-group input-icon file-upload">
               <div class="widget-content" style="padding:10px">
               <?php $i = 0; foreach ($get_mail_admin_all as $value) { $i++ ?>
                 <div class="title_mail_content" data-toggle="collapse" data-target="#demo<?php echo $i ?>"><?php echo $value['title'] ?> <span class="pull-right" style="color: #2196f3;"><?php echo date('d/m/Y H:i',strtotime($value['date_added'])) ?></span></div>
                  <div id="demo<?php echo $i ?>" class="collapse content_mail_view">
                    <?php echo $value['description'] ?>
                  </div>
               <?php } ?>
                
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Row -->
   <!-- End row -->
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('#datatable').dataTable();
   } );
</script>
<?php echo $self->load->controller('common/footer') ?>