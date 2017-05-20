<?php echo $self->load->controller('home/page/header'); ?>
    
<div id="content" class="site-content" style="background: #5472BA !important;">
  
  <div class="container" style="color: #fff">
     <div class="content_p" style="padding-top: 50px; padding-bottom: 100px">
     
     <?php if ($_SESSION['language_id'] == "vietnamese") { ?>
        <p style="margin-bottom: 5px;">Lời mở đầu,</p>
        <p style="margin-bottom: 5px;">Tri thức là chìa khóa dẫn đến thành công!</p>
        <p style="margin-bottom: 5px;">Sách là ngọn đèn bất diệt của trí tuệ con người!</p>
        <p style="margin-bottom: 5px;">Ý nghĩa của Iontach là sự kỳ diệu, sứ mệnh của Iontach là đem lại  những lợi ích thiết thực về tinh thần, vật chất và giá trị nhân văn đến với cộng đồng người Việt Nam nói chung cũng như thành viên của Iontach nói riêng.</p>
        <p style="margin-bottom: 5px;">Iontach xây dựng kho tri thức là nơi tập hợp lại những trang web về sách nói và đọc sách online với mong muốn chia sẽ và đóng góp một phần nhỏ công sức cho sự phát triển giàu đẹp của Việt Nam trong tương lai.</p>

        <div class="clearfix"></div>
        <div class="img_book text-center" style="margin-top: 50px;">
          <a target="_blank" href="http://sachnoionline.com">
            <img src="catalog/view/theme/default/images/sn1.png">
          </a>
          <a target="_blank" href="http://sachnoionline.com/">
            <img src="catalog/view/theme/default/images/sn2.png">
          </a>
          <a target="_blank" href="http://khosachnoi.com.vn/">
            <img src="catalog/view/theme/default/images/sn3.png">
          </a>
          <a target="_blank" href="http://sachvui.com/">
            <img src="catalog/view/theme/default/images/sn4.png">
          </a>
          <a target="_blank" href="http://tve-4u.org/">
            <img src="catalog/view/theme/default/images/sn5.png">
          </a>
          <a target="_blank" href="http://sachpdf.com/">
            <img src="catalog/view/theme/default/images/sn6.png">
          </a>
        </div>

      <?php } ?>
     </div>
  </div>
</div>
<style type="text/css">
  .img_book img{
    width: 180px;
    height: 100px;
  }
  div.content_p{
        font-size: 20px;
  }
</style>
         <!-- #content -->
<?php echo $self->load->controller('home/page/footer'); ?>  