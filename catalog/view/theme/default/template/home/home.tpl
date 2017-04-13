<?php echo $self->load->controller('home/page/header'); ?>
    
         <!-- #site-navigation -->
         <div id="content" class="site-content">
            <!-- <div class="big-title" style="background-image: url('catalog/view/theme/default/images/bg01.jpg')">
               <div class="container">
                  <h1 class="entry-title" itemprop="headline"></h1> 
               
               </div>
            </div> -->
            <style type="text/css">
               .input1,.input2{
                  position: relative;
               }
               .input1 i,.input2 i{
                  position: absolute;
                  right: 4px;
                   top: 5px;
                   font-size: 26px;
                   display: none;
               }
            </style>
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="content">
                        <article id="post-74236" style="margin-top: 20px;">
                           <?php if ($_SESSION['language_id'] == "vietnamese") { ?>


    
                              <div class="col-md-6 col-md-push-2" style="margin-left: 28%">
                                 <!-- <h3 class="text-center" style="text-align: center;margin-bottom: 25px;">Tỷ giá quy đổi</h3>
                                 <p class="text-center" style="font-size: 13px;    text-align: center; color: #fff; margin-top: -15px;">(Áp dụng tại Hội sở chính NHTMCP Ngoại thương Việt Nam)</p>
                                 <form>
                                    <div class="col-md-6" style="float: left;">
                                         <div class="form-group input1">
                                           <input type="text" class="form-control" id="amount" placeholder="Số tiền muốn quy đổi" >
                                           <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                         </div>  
                                         <div class="form-group input2">
                                           
                                           <input type="text" placeholder="Số tiền quy đổi" class="form-control" id="amount_qd">
                                           <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                         </div>
                                    </div>
                                   <div class="col-md-6" style="float: left;">
                                         <div class="form-group">
                                          <select class="form-control" id="curent_1">
                                             <option value="VND" selected="selected">Vietnamese Dong</option>
                                           </select>
                                           
                                         </div>
                                         <div class="form-group">
                                             <select class="form-control" id="curent_2">
                                             <option value="USD" selected="selected">USD</option>
                                              <option value="AUD">AUD</option>
                                              <option value="CAD">CAD</option>
                                              <option value="CHF">CHF</option>
                                              
                                              <option value="EUR">EUR</option>
                                              <option value="GBP">GBP</option>
                                              <option value="HKD">HKD</option>
                                              
                                              <option value="JPY">JPY</option>
                                              <option value="KRW">KRW</option>
                                              
                                              <option value="SGD">SGD</option>
                                              <option value="THB">THB</option>
                                              
                                           </select>
                                         </div>
                                    </div>
                                 </form> -->
                              </div>
                              <div class="clearfix" style="clear: both;"></div>
                              <div class="col-md-2 col-sm-2 col-xs-4" style="float: left;">
                                 <a href="index.php?route=home/page/redbook">
                                  <img src="catalog/view/theme/default/images/khottrithuc.png" style="border: 2px solid #fff">
                                 </a>

                                 <a href="index.php?route=home/page/news" style="margin-top: 15px; float: left;">
                                  <img src="catalog/view/theme/default/images/newss.png" style="border: 2px solid #fff">
                                 </a>

                                 <a href="index.php?route=home/page/hr" style="margin-top: 15px; float: left;">
                                  <img src="catalog/view/theme/default/images/caunoinhansu.png" style="border: 2px solid #fff">
                                 </a>
                                 <a href="index.php?route=home/page/curentcy" style="margin-top: 15px; float: left;">
                                  <img src="catalog/view/theme/default/images/tygia.png" style="border: 2px solid #fff">
                                 </a>
                                 <a href="index.php?route=home/page/na" style="margin-top: 15px; float: left;">
                                  <img src="catalog/view/theme/default/images/ncna.png" style="border: 2px solid #fff">
                                 </a>
                              </div>
                              <div class="col-md-10 col-sm-10 col-xs-8" style="float: left;">
                                <!-- <p style="text-align: center;color: #fff; margin-bottom: 5px;">“Nếu là con chim, chiếc lá,</p>
                           <p style="text-align: center;color: #fff; margin-bottom: 5px;">Thì con chim phải hót, chiếc lá phải xanh,</p>
                           <p style="text-align: center;color: #fff; margin-bottom: 5px;">Lẽ nào vay mà không trả,</p>
                           <p style="text-align: center;color: #fff; margin-bottom: 5px;">Sống là cho, đâu chỉ nhận riêng mình,”</p>
                           <p style="text-align: center;color: #fff; margin-bottom: 5px;">(Một Khúc Ca Xuân – Tố hữu)</p><br>

                           <p style="color: #fff">- CHO và NHẬN là sự tuần hoàn của cuộc sống, từ những việc nhỏ nhặt như người nông dân chăm chỉ cày cấy  tới cuối mùa vụ thì bội thu, đến những thứ gần chúng ta nhất như điện, nồi cơm, bếp ga, chiếc điện thoại, chiếc xe chúng ta dùng đều là sản phẩm của sự cho đi của những nhà phát minh với mong muốn ban đầu là đem lại sự tiện dụng cho con người.
Xã hội sẽ nhân văn và ý vị hơn khi người người đều trân trọng và cảm nhận được sự cho đi và nhận lại trong từng lời nói, hành động. </p>
                              
                            <p style="color: #fff">- Chỉ cần 1 nụ cười của bạn có thể đem lại cho một ai đó cảm thấy yêu đời hơn, đôi khi chỉ một hành động đỗ xe bên lề đường thay vì để giữa đoạn đường nhiều người qua lại chính là giúp người sau di chuyển dễ dàng hơn. </p>
                            <p style="color: #fff">- Cho đi ở đây không nhất thiết phải là vật chất, tiền bạc mà có thể đấy là những “tài sản” tinh thần, tài sản phi vật chất của cá nhân. Anh A là người học giỏi, anh có thể dùng tri thức, kinh nghiệm của mình để dạy lại cho người khác, như thế là anh đã cho đi. Chị B là người nấu ăn, thêu may giỏi, chị có thể chỉ bày cho người khác nấu ăn, may thêu là chị đang cho đi.</p>
                            <p style="color: #fff">- Ở đâu đó xung quanh chúng ta luôn có những mảnh đời bất hạnh cần được sẻ chia giúp đỡ. Chúng ta không ngần ngại mà hãy giúp đỡ,bao dung và rộng lượng khi còn có thể. Chúng ta trao đi yêu thương thì chúng ta sẽ được nhận lại niềm vui từ trong tâm hồn của mình. Không hẳn là cho đi rồi sẽ trông chờ người ta trả lại cho mình là vui mà niềm vui bắt nguồn từ chính cảm xúc,nhận lại được những điều thực sự ý nghĩa.</p>
                            <p style="color: #fff">- Chúng ta đều biết các hoạt động xã hội tình nguyện mang lại lợi ích cho mọi người có tính 'lây lan' rất nhanh. Hôm nay bạn là người nhận được sự giúp đỡ thì ngày mai bạn sẽ giúp đỡ được nhiều người khác hơn. Nhờ vậy mà sợi dây kết nối có thể kéo dài vô tận, mang đến hạnh phúc  bền vững. Bạn quyên góp tiền cho một tổ chức nghĩa là cùng với bạn bè tạo ra một sự giúp đỡ to lớn hơn cho người khó khăn. Bằng nhiều cách, bạn hoàn toàn có thể mang hạnh phúc đến cho nhiều người.</p>
                            <p style="color: #fff">- Lòng tốt không phân biệt việc nhỏ, to, không phân biệt mối quan hệ. Chắc chắn khi giúp đỡ người khác chính là bạn đang trang bị cho mình một loại thuốc tinh thần giúp cuộc sống ý nghĩa hơn.</p>
                            <p style="color: #fff">“Cho đi là hạnh phúc hơn nhận về”.</p> -->
                              <img src="catalog/view/theme/default/images/0002.jpg" style="margin-bottom: 30px">
                                 <img src="catalog/view/theme/default/images/0001.jpg">
                              </div>
                           <?php } else { ?>
                               <div class="col-md-2 col-sm-2 col-xs-4" style="float: left;">
                                 <a href="index.php?route=home/page/redbook">
                                  <img src="catalog/view/theme/default/images/khottrithuc.png" style="border: 2px solid #fff">
                                 </a>

                                 <a href="index.php?route=home/page/news" style="margin-top: 15px; float: left;">
                                  <img src="catalog/view/theme/default/images/newss.png" style="border: 2px solid #fff">
                                 </a>

                              </div>
                              <div class="col-md-10 col-sm-10 col-xs-8" style="float: left;">

                                 <img style="width: 100%" src="catalog/view/theme/default/images/gtcl1.png">
                              </div>
                           <?php } ?>
                        </article>
                       <!--  <article id="post-74236">
                           <div class="entry-content">
                              <div class="vc_row wpb_row vc_row-fluid services1 vc_custom_1435835587561">
                                 <div class="wpb_column vc_column_container vc_col-sm-6">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div
                                                         class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-exchange" ></span></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-9">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_custom_heading vc_custom_1437450002294" >
                                                         <h3 style="font-size: 18px;color: #111111;text-align: left" ><a href="../ground-transport/index.html">GROUND TRANSPORT</a></h3>
                                                      </div>
                                                      <div class="vc_custom_heading vc_custom_1437449347466" >
                                                         <p style="font-size: 14px;color: #878787;text-align: left" >Transport began providing transportation solutions to Transport’s contract warehousing customers in the 1980s and expanded over time to include dedicated transportation carriage and freight brokerage.</p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="wpb_column vc_column_container vc_col-sm-6">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div
                                                         class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-cubes" ></span></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-9">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_custom_heading vc_custom_1437539228564" >
                                                         <h3 style="font-size: 18px;color: #111111;text-align: left" ><a href="../warehousing/index.html">WAREHOUSING</a></h3>
                                                      </div>
                                                      <div class="vc_custom_heading vc_custom_1437449298380" >
                                                         <p style="font-size: 14px;color: #878787;text-align: left" >Transport provides warehousing, fulfillment services, and transportation management through a network of warehouse and distribution centers spanning across North America.</p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="vc_row wpb_row vc_row-fluid services1 vc_custom_1435835593836">
                                 <div class="wpb_column vc_column_container vc_col-sm-6">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div
                                                         class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-truck" ></span></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-9">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_custom_heading vc_custom_1437539246519" >
                                                         <h3 style="font-size: 18px;color: #111111;text-align: left" ><a href="../trucking-service/index.html">TRUCKING SERVICE</a></h3>
                                                      </div>
                                                      <div class="vc_custom_heading vc_custom_1437449464280" >
                                                         <p style="font-size: 14px;color: #878787;text-align: left" >Transport rigorous carrier partner selection ensures that only top quality carriers will have access to our customers’ freight. We partner with many carriers to insure we match the proper carrier with your freight requirements. </p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="wpb_column vc_column_container vc_col-sm-6">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div
                                                         class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-fighter-jet" ></span></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-9">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_custom_heading vc_custom_1437450038799" >
                                                         <h3 style="font-size: 18px;color: #111111;text-align: left" ><a href="../logistic-services/index.html">LOGISTIC SERVICE</a></h3>
                                                      </div>
                                                      <div class="vc_custom_heading vc_custom_1437449409473" >
                                                         <p style="font-size: 14px;color: #878787;text-align: left" >Transport offers a host of logistic management services and supply chain solutions. We provide innovative solutions with the best people, processes, and technology to drive uncommon value for your company.</p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="vc_row wpb_row vc_row-fluid services1 vc_custom_1435835644373">
                                 <div class="wpb_column vc_column_container vc_col-sm-6">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div
                                                         class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-codepen" ></span></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-9">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_custom_heading vc_custom_1437539270431" >
                                                         <h3 style="font-size: 18px;color: #111111;text-align: left" ><a href="../cargo/index.html">CARGO</a></h3>
                                                      </div>
                                                      <div class="vc_custom_heading vc_custom_1437449531024" >
                                                         <p style="font-size: 14px;color: #878787;text-align: left" >Transport specializes in the safe transportation of office, computer, and medical related equipment. From a single laptop to an entire data center, we can help plan, pack and relocate your equipment anywhere in the country. </p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="wpb_column vc_column_container vc_col-sm-6">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div
                                                         class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-home" ></span></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-9">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_custom_heading vc_custom_1437539285140" >
                                                         <h3 style="font-size: 18px;color: #111111;text-align: left" ><a href="../storage/index.html">STORAGE</a></h3>
                                                      </div>
                                                      <div class="vc_custom_heading vc_custom_1437449626249" >
                                                         <p style="font-size: 14px;color: #878787;text-align: left" >Transport has access to over a ten million square feet of storage space in strategic partnership locations throughout the US. We offer complete, customized solutions for all of your business storage needs.</p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid services2 vc_custom_1437117328540" style="position: relative; left: -104.5px; box-sizing: border-box; width: 1349px; padding-left: 104.5px; padding-right: 104.5px;">
                                 <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                       <div class="wpb_wrapper">
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-shield" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868501624">
                                                         <h2 style="color: #5472ba;text-align: left">SAFETY</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-flag-checkered" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868511130">
                                                         <h2 style="color: #5472ba;text-align: left">INTERGRITY</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-line-chart" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868522782">
                                                         <h2 style="color: #5472ba;text-align: left">VISION</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-binoculars" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868534605">
                                                         <h2 style="color: #5472ba;text-align: left">MISSION</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-pencil-square-o" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868544861">
                                                         <h2 style="color: #5472ba;text-align: left">QUALITY</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-magic" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868553893">
                                                         <h2 style="color: #5472ba;text-align: left">INNOVATION</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-users" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868569008">
                                                         <h2 style="color: #5472ba;text-align: left">CLIENTS</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-puzzle-piece" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868580303">
                                                         <h2 style="color: #5472ba;text-align: left">COLLABORATION</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                   <div class="wpb_wrapper">
                                                      <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
                                                         <div class="vc_icon_element-inner vc_icon_element-color-custom vc_icon_element-size-lg vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-life-ring" style="color:#232331 !important"></span></div>
                                                      </div>
                                                      <div class="vc_custom_heading style5 vc_custom_1436868591526">
                                                         <h2 style="color: #5472ba;text-align: left">SAFETY</h2>
                                                      </div>
                                                      <div class="wpb_text_column wpb_content_element  gray">
                                                         <div class="wpb_wrapper">
                                                            <p>Transport earn trust through authenticity and accountability. We cultivate mutually beneficial partnerships with customers, associates and suppliers.</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="vc_row-full-width vc_clearfix"></div>
                           </div>
                           
                        </article> -->
                        <!-- #post-## -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- #content -->
<script type="text/javascript">
   jQuery(document).ready(function(){
      var delay = (function(){
        var timer = 0;
        return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
      })();
      jQuery("#amount").on('input propertychange', function() {
         jQuery('.input2 i').show();
         delay(function(){
             jQuery.ajax({
                 url : "index.php?route=home/page/conver_buy",
                 type : "post",
                 dateType:"text",
                 data : {
                     'amount' : jQuery('#amount').val(),
                     'curent_1' : jQuery('#curent_1').val(),
                     'curent_2' : jQuery('#curent_2').val()
                 },
                 success : function (result){
                     jQuery('.input2 i').hide();
                     jQuery('#amount_qd').val(result);
                 }
             });
          }, 800 );
       });

      jQuery("#amount_qd").on('input propertychange', function() {
         jQuery('.input1 i').show();
         delay(function(){
             jQuery.ajax({
                 url : "index.php?route=home/page/conver_buy",
                 type : "post",
                 dateType:"text",
                 data : {
                     'amount' : jQuery('#amount_qd').val(),
                     'curent_2' : jQuery('#curent_1').val(),
                     'curent_1' : jQuery('#curent_2').val()
                 },
                 success : function (result){
                     jQuery('.input1 i').hide();
                     jQuery('#amount').val(result);
                 }
             });
         }, 800 );
       });
      jQuery("#curent_2").on('change', function() {
          jQuery('#amount').val('');
          jQuery('#amount_qd').val('');
       });

   });
</script>
<?php echo $self->load->controller('home/page/footer'); ?>  

