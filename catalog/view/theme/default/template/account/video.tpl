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
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/EQuv3B-sgP0?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/KIYV_fLn4GE?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/EdAMqlW2Dcw?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/b5hzzdiQJEA?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/rQykCaf1wIk?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/IB65g92Lhkc?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/3TQxWr0M72Y?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/VffT5iRfcOc?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                <?php } else { ?>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/eMkKnWlugVI?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/mrlU7pymbV4?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/-S0XAQu-8bA?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/QbVB3Lyivac?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/rqb8BXfo4kw?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/VE0MNBv24F4?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/dikrj7pHXsQ?ecver=1" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="col-md-6 video_item">
                    <iframe style="width: 100%" height="315" src="https://www.youtube.com/embed/G_LTz8sZsP8?ecver=1" frameborder="0" allowfullscreen></iframe>
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