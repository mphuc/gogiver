<?php
   $self -> document -> setTitle('Đăng ký thành viên');
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
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>ĐĂNG KÝ THÀNH VIÊN</h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content">

                           <div class="col-sm-12">
                              <div class="">
                                 <div class="border_">
                                    
                                    <div class="panel-body">
                                       <div class=" form">
                                          <form id="register-account" action="<?php echo $self -> url -> link('account/register', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate">
                                             <div class="row">
                                                <div class="col-md-6" style="display: none">
                                                   <select class="form-control" name="bank_name" id="bank_name">
                                                     <option value="" disabled>Chọn ngân hàng</option>
                                                     <option selected value="Vietcombank">Vietcombank</option>
                                                     <option value="Sacombank">Sacombank</option>
                                                     <option value="BIDV">BIDV</option>
                                                     <option value="Viettinbank">Viettinbank</option>
                                                     <option value="Agribank">Agribank</option>
                                                    
                                                   </select>              
                                                </div>
                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="username" id="username" value="" data-link="<?php echo $self -> url -> link('account/register/checkuser', '', 'SSL'); ?>" placeholder="ID hệ thống viết không dấu"/>               
                                                </div>
                                                <div class="col-md-6 conf-vcb">
                                                   <input data-url="<?php echo $self -> url -> link('account/register/getjson', '', 'SSL'); ?>" autocomplete="off" class="form-control" name="account_number" id="account_number" value="" data-link="<?php echo $self -> url -> link('account/register/checkcmnd', '', 'SSL'); ?>" placeholder="Số tài khoản ngân hàng VD:05010000xxxxx"/>
                                                   <span><i class=" fa fa-cog fa-spin fa-fw"></i></span>
                                                </div>

                                                
                                                <div class="col-md-6">
                                                   <input class="form-control" id="password" name="password" type="password" placeholder="Mật khẩu đăng nhập" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control" name="account_holder" id="account_holder" value="" readonly="true" placeholder="Tên đầy đủ không dấu như trên thẻ ATM"/>
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control valid" id="confirmpassword" type="password" placeholder="Nhập lại mật khẩu đăng nhập" />
                                                </div>



                                                 <div class="col-md-6">
                                                   <input  class="form-control" id="password2" name="password2" type="password" placeholder="Mật khẩu giao dịch" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input class="form-control valid" id="confirmpasswordtransaction" type="password" placeholder="Nhập lại mật khẩu giao dịch" />
                                                </div>



                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="email" id="email" data-link="<?php echo $self -> url -> link('account/register/checkemail', '', 'SSL'); ?>" placeholder="Email đang sử dụng để nhận thông tin từ hệ thống" />
                                                </div>
                                                <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="telephone" id="phone" data-link="<?php echo $self -> url -> link('account/register/checkphone', '', 'SSL'); ?>" placeholder="Số điện thoại đang sử dụng để nhận thông tin từ hệ thống" />
                                                </div>
                                                  <div class="col-md-6">
                                                   <input autocomplete="off"  class="form-control" name="cmnds" id="cmnds" placeholder="Số Chứng minh nhân dân" />
                                                </div>

                                                <div class="clearfix"></div>
                                                <div id="success"></div>
                                                <br/>
                                                <div class="col-md-12">
                                                   <button type="submit" class="btn-register btn btn-warning pull-right ">Submit</button>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                       <div class="row">

                                          <div class="col-md-12" >
                                             <p>Lưu ý: hệ thống Gogiver chỉ hỗ trợ tài khoản vietcombank.</p>
                                             <p>Nhập đúng số tài khoản ngân hàng vietcombank, hệ thống sẽ tự lấy họ tên từ tài khoản của bạn.</p>
                                             <p>Mỗi tài khoản vietcombank chỉ có thể đăng ký đươc 3 tài khoản.</p>
                                             <br/>
                                          </div>

                                          <div class="col-md-12">
                                             <p>Sao chép đường dẫn bên dưới để gửi cho bạn bè cùng tham gia hệ thống:</p>
                                             <a style="word-break: break-word; font-weight:700; color:cyan" href="signup&ref=<?php echo $customer_code;  ?>" target="_blank"><?php echo HTTPS_SERVER ?>signup&ref=<?php echo $customer_code;  ?></a>
                                          </div>
                                       </div>
                                       <!-- .form -->
                                    </div>
                                    <!-- panel-body -->
                                 </div>
                                 <!-- panel -->
                              </div>
                           </div>
                           <!-- col -->
                        </div>
                      </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>

<?php echo $self->load->controller('common/footer') ?>

<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 10);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Đăng ký tài khoản thành công!');
   }

</script>
