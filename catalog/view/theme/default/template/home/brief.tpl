<?php echo $self->load->controller('home/page/header'); ?>
      
         <!-- #site-navigation -->
         <div id="content" class="site-content">
            
            <div class="container">
               <div class="row">
                  <div class="col-md-12" style="margin-bottom: 20px;">
                  <?php 
                     if (isset($_SESSION['language_id'])) {
                     if ($_SESSION['language_id'] == "vietnamese") {
                  ?>
                     <?php for ($i=1;$i<15;$i++) { ?>
                       <img style="margin-top: 10px;" src="catalog/view/theme/default/images/brief/000<?php echo $i;?>-min.jpg" alt="">
                     <?php  }?>
                     <?php } else { ?>
                    <?php for ($i=1;$i<15;$i++) { ?>
                       <img style="margin-top: 10px;" src="catalog/view/theme/default/images/brief_en/000<?php echo $i;?>-min.jpg" alt="">
                     <?php  } } } else { ?>
                        <?php for ($i=1;$i<15;$i++) { ?>
                       <img style="margin-top: 10px;" src="catalog/view/theme/default/images/brief_en/000<?php echo $i;?>-min.jpg" alt="">
                     <?php  } ?>
                     <?php } ?>
                     
                  </div>
               </div>
            </div>
         </div>
         <!-- #content -->
        
<?php echo $self->load->controller('home/page/footer'); ?>  