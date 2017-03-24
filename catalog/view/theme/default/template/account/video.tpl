<?php 
   $self -> document -> setTitle('Manual'); 
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
      <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['video_huongdan'] ?></h4>
   </div>
   <div class="panel-body form-horizontal group-border stripped">
      <div class="form-group">
         <div class="col-lg-12 col-md-12">
            <div class="input-group input-icon file-upload">
               <div class="widget-content all_video" style="padding:10px" >
                <?php if ($language=='english') { ?>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/ORZeLWSJ-wU?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/KCaPUgf3Jnw?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/u7-HfK6Re4E?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/tJYRM1c4PF0?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/FUTOxu_KqgE?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/ukskMu6tvoY?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/4Ie4Xyk3kkw?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/3TQxWr0M72Y?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/AuWrMpo7Yi8?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/g8d0ZRF_0qE?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                <?php } else { ?>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/a-O5r5Lkddg?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/KJL_I1JVdY0?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/yqld_eCI6f4?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/spo8WwVBKV8?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/Rv_E6kbsdYI?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/_R5q9xT29eM?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/xGTCoZg7Fw4?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/dikrj7pHXsQ?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/4xK-5SRg514?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/0LrnjeBjYxk?ecver=1" frameborder="0" allowfullscreen></iframe>
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

<?php echo $self->load->controller('common/footer') ?>