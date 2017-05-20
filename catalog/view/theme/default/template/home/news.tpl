<?php echo $self->load->controller('home/page/header'); ?>
    
<div id="content" class="site-content" style="background: #5472BA !important;">
  
  <div class="container" style="color: #fff">
     <div class="content_p" style="padding-top: 50px; padding-bottom: 100px">
     
     <?php if ($_SESSION['language_id'] == "vietnamese") { ?>
        <p style="margin-bottom: 5px;">Lời ngỏ,</p>
        <p style="margin-bottom: 5px;">Thông tin sẽ giúp làm tăng hiểu biết, là nguồn gốc của nhận thức và là cơ sở  quyết định của con người.</p>
        <p style="margin-bottom: 5px;">Iontach xây dựng tiện ích tin tức và tổng hợp các trang web cung cấp thông tin, sự kiện mới nhất của Việt Nam và thế giới với mong muốn giúp cộng đồng người Việt Nam nói chung và thành viên Iontach nói riêng có thêm nhiều kiến thức và đa nguồn thông tin từ đó có những ứng xử sáng suốt , và cuộc sống đầy  đủ ý nghĩa hơn.</p>
        

        <div class="clearfix"></div>
        <div class="img_book text-center" style="margin-top: 50px;">
          <div>
            <a target="_blank" href="http://tuoitre.vn">
              <img src="catalog/view/theme/default/images/news1.png">
            </a>
            <a target="_blank" href="http://vnexpress.net/">
              <img src="catalog/view/theme/default/images/news2.png">
            </a>
            <a target="_blank" href="http://www.doisongphapluat.com/">
              <img src="catalog/view/theme/default/images/news3.png">
            </a>
            <a target="_blank" href="http://vneconomy.vn/ ">
              <img src="catalog/view/theme/default/images/news4.png">
            </a>
            <a target="_blank" href="http://www.nguoiduatin.vn/">
              <img src="catalog/view/theme/default/images/news5.png">
            </a>
            <a target="_blank" href="http://www.24h.com.vn/">
              <img src="catalog/view/theme/default/images/news6.png">
            </a>
            <a target="_blank" href="http://dantri.com.vn/">
              <img src="catalog/view/theme/default/images/news7.png">
            </a>
            <a target="_blank" href="http://congly.vn/">
              <img src="catalog/view/theme/default/images/news8.png">
            </a>
            </div>
        </div>

      <?php } ?>
     </div>
  </div>
</div>
<style type="text/css">
  .img_book img{
    width: 250px;
    height: 140px;
    margin-bottom: 20px;
  }
  div.content_p{
        font-size: 20px;
  }
</style>
         <!-- #content -->
<?php echo $self->load->controller('home/page/footer'); ?>  