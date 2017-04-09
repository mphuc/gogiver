<?php echo $self->load->controller('home/page/header'); ?>
    
<div id="content" class="site-content" style="background: #5472BA !important;">
  
  <div class="container" style="color: #fff">
     <div class="" style="padding-top: 50px; padding-bottom: 100px">
     
     <?php if ($_SESSION['language_id'] == "vietnamese") { ?>
        <p style="margin-bottom: 5px;">Lời ngỏ,</p>
        <p style="margin-bottom: 5px;">Một công việc tốt là yếu tố quyết định đối  với cuộc sống và hạnh phúc của mỗi người.</p>
        <p style="margin-bottom: 5px;">Một nhân viên thạo việc sẽ giúp doanh nghiệp nâng cao năng suất, tạo ra chất lượng sản phẩm và dịch vụ tốt hơn.</p>

        <p style="margin-bottom: 5px;">Một xã hội có nhiều công ăn việc làm cho người dân thì tệ nạn xã hội giảm thiểu,  chất lượng cuộc sống được nâng cao.</p>
         <p style="margin-bottom: 5px;">Iontach xây dựng mục Cầu Nối Nhân Sự tập hợp những trang web Tuyển Dụng, và Tìm Việc nhằm đem lại cho Người Việt Nam và cộng đồng Iontach có nhiều cơ hội phát triển.</p>
        

        <div class="clearfix"></div>
        <div class="img_book text-center" style="margin-top: 50px;">
          <div>
            <a target="_blank" href="http://www.vietnamworks.com/">
              <img src="catalog/view/theme/default/images/hr1.png">
            </a>
            <a target="_blank" href="http://careerbuilder.vn/">
              <img src="catalog/view/theme/default/images/hr2.gif">
            </a>
            <a target="_blank" href="https://www.careerlink.vn/">
              <img src="catalog/view/theme/default/images/hr3.png">
            </a>
            <a target="_blank" href="http://mywork.com.vn/">
              <img src="catalog/view/theme/default/images/hr4.jpg">
            </a>
            <a target="_blank" href="http://1001vieclam.com/">
              <img src="catalog/view/theme/default/images/hr5.png">
            </a>
            <a target="_blank" href="https://vieclam24h.vn/">
              <img src="catalog/view/theme/default/images/hr6.jpg">
            </a>
            <a target="_blank" href="http://tuyendung.com.vn">
              <img src="catalog/view/theme/default/images/hr7.png">
            </a>
            <a target="_blank" href="https://www.timviecnhanh.com/">
              <img src="catalog/view/theme/default/images/hr8.jpg">
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
</style>
         <!-- #content -->
<?php echo $self->load->controller('home/page/footer'); ?>  