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
               <div class="col-md-12">
               <p style="text-indent: 20px; font-size: 26px; text-transform: uppercase;">Gửi các thành viên Iontach thân mến !!!</p>
               <p style="text-indent: 20px; font-size: 26px;"> Chúng ta đã trải qua rất nhiều sóng gió trong nghành CHO – NHẬN tại Việt Nam. Điều đó nhắc nhở trong mỗi cá nhân chúng ra rằng cần phải xây dựng 1 sân chơi mang lại giá trị lâu dài, 1 quỹ tương hỗ đúng nghĩa để giúp đỡ cộng đồng người Việt. Trong bối cảnh CHO - NHẬN Việt Nam tưởng chừng như không thể tồn tại thì Iontach ra đời với biết bao hy vọng, sự mong đợi và cả những niềm tin của rất nhiều trái tim tâm huyết. Chúng ta đã làm được những điều tưởng chừng như không thể khi setup 2000 ID chỉ trong vòng chưa đầy nửa tháng. </p>
                <div class="text-center col-md-3 pull-left" style="text-align: center; margin-right: 20px; margin-bottom: 20px;">
                  <img class="img-responsive" style="margin-top: 10px; height: 440px !important; width: 300px; margin: 0 auto; margin-top: 10px;" src="catalog/view/theme/default/images/e2d17db34d15a74bfe04.jpg" src="" alt="">
               </div>

               <p style="text-indent: 20px; font-size: 26px;">Hệ thống Iontach vận hành vào lúc 11h00 phút ngày 17/3/2017 theo đúng như lộ trình đã định. Chúng ta đang ở những ngày đầu tiên khi vận hành hệ thống. Khác hẳn với các quỹ tương hỗ khác. Iontach vận hành theo lộ trình kích pin linh hoạt, giúp giảm thiểu và hạn chế tối đa các thành viên tham gia thiếu tính nghiêm túc. Đảm bảo sự an toàn cho các thành viên khi vận hành. Điều đó khiến không khỏi sự băn khoăn của rất nhiều các thành viên, không biết khi nào sẽ đến lượt kích pin. Nhưng vì sự an toàn của hệ thống, Pin sẽ được đưa xuống cho các đầu nhánh và có sự phân bổ hợp lý xen kẽ theo từng ngày.Vì vậy sẽ có thông báo cụ thể trên Group để giúp các thành viên nắm được. Iontach mong muốn xây dựng 1 quỹ tương hỗ bền vững, một điểm đến an toàn cho các thành viên, một sân chơi với đúng ý nghĩa mang lại những giá trị thật sự giúp cho cộng đồng thoát nghèo. </p>
               <p style="text-indent: 20px; font-size: 26px;"> Hãy cùng chung tay để tạo dựng giá trị Iontach đúng nghĩa !!!</p>

               </div>
               
              
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