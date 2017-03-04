<?php echo $self->load->controller('home/page/header'); ?>
      
      
         <!-- #site-navigation -->
         <div id="content" class="site-content">
            <div class="big-title" style="background-image: url('catalog/view/theme/default/images/bg01.jpg')">
               <div class="container">
                  <h1 class="entry-title" itemprop="headline">Media</h1>
                  <div class="breadcrumb">
                     <div class="container">
                        <ul class="tm_bread_crumb">
                           <li class="level-1 top"><a href="../index.html">Home</a></li>
                           <li class="level-2 sub tail current">Media</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row">
                  <?php if (isset($_SESSION['language_id'])) {
               if ($_SESSION['language_id'] == "vietnamese") { ?>
               <!-- viet -->
               <img class="img-responsive" style="margin-top: 10px; height: 100% !important; width: 100%" class="lazy" src="catalog/view/theme/default/images/thitruongvn/19001e3356b4bceae5a5.jpg" src="" alt="">
                <img class="img-responsive" style="margin-top: 10px; height: 100% !important; width: 100%" class="lazy" src="catalog/view/theme/default/images/thitruongvn/e4361b045383b9dde092.jpg" src="" alt="">
               <?php for ($i=1;$i<34;$i++) { ?>
                 <img class="img-responsive" style="margin-top: 10px; height: 100% !important; width: 100%" class="lazy" src="catalog/view/theme/default/images/thitruongvn/PHAT TRIEN 6 TINH MIEN TAY-<?php echo $i;?>.jpg" src="" alt="">
                 <div class="clearfix"></div>
               <?php  }?>

                <?php } else { ?>
                <!-- anh -->
                <?php } } else { ?>
                  <!-- anh -->
                <?php } ?>
               </div>
            </div>
         </div>
         <!-- #content -->
<?php echo $self->load->controller('home/page/footer'); ?>  