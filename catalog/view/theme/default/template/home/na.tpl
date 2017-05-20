<?php echo $self->load->controller('home/page/header'); ?>
    
<div id="content" class="site-content" style="background: #5472BA !important;">
  
  <div class="container" style="color: #fff">
     <div class="content_p" style="padding-top: 50px; padding-bottom: 100px">
     
     <?php if ($_SESSION['language_id'] == "vietnamese") { ?>
        <p style="margin-bottom: 5px;">Lời ngỏ,</p>
        <p class="text-center"><i>“Cho đi là hạnh phúc hơn nhận về”.</i></p>
        <p style="margin-bottom: 5px;">Đâu đó quanh ta vẫn còn nhiều mảnh đời bất hạnh cần được giúp đỡ, hãy cùng đồng cảm, chia sẻ, xoa dịu bớt những nỗi đau...</p>
        <p style="margin-bottom: 5px;"><b>IONTACH</b> - Với mong muốn đóng góp một phần công sức của mình đến với những hoàn cảnh khó khăn trên khắp mọi nẻo đường Việt Nam,</p>

        <p style="margin-bottom: 5px;"><b>Iontach</b> xây dựng mục NHỊP CẦU NHÂN ÁI tổng hợp một số trang web từ thiện giúp cộng đồng người Việt và thành viên Iontach có thể trực tiếp liên hệ và tham gia vào các sự kiện, phong trào giúp người vượt khó đem lại cho Việt Nam ta ngày càng giàu đẹp  và phát triển vững mạnh hơn</p>
         

        <div class="clearfix"></div>
        <div class="img_book text-center" style="margin-top: 50px;">
          <div>
            <a target="_blank" href="http://www.sosvietnam.org/">
              <img src="catalog/view/theme/default/images/na1.jpg">
            </a>
            <a target="_blank" href="http://ytam.vn/">
              <img src="catalog/view/theme/default/images/na2.png">
            </a>
            <a target="_blank" href="http://tuthienthat.vn/">
              <img src="catalog/view/theme/default/images/na3.png">
            </a><br>
            <a target="_blank" href="http://kenhtuthien.vn">
              <img src="catalog/view/theme/default/images/na4.jpg">
            </a>
            <a target="_blank" href="http://www.traitimvang.vn/">
              <img src="catalog/view/theme/default/images/na5.png">
            </a>
            <a target="_blank" href="http://www.tuthien.vn/">
              <img src="catalog/view/theme/default/images/na6.png">
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