<div id="footer" class="clearfix">
        <!-- Start #footer  -->
        <p class="pull-left">
            Copyrights © 2016 <a href="#" class="color-blue strong underline-effect" target="_blank">Gogiver</a>. All rights reserved.
        </p>
        <p class="pull-right">
            <a href="#" class="mr5 strong underline-effect">Terms of use</a>
            |
            <a href="#" class="ml5 mr25 strong underline-effect">Privacy police</a>
        </p>
    </div>
    <!-- End #footer  -->
</div>
</body>
</html>
        <!-- <script src="catalog/view/javascript/jquery.app.js"></script>
	</div>
    </section>
    <footer id="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 left_footer">
                    <h3>Về chúng tôi</h3>
                    <p>HAPPYMONEY.US là gây quỹ quần chúng có cấu trúc</p>

                    <p>Mạng là duy nhất trong một cách mà nó là một dự án cộng đồng toàn cầu dựa trên ngang ngang nhau để gây quỹ quần chúng nền tảng. Với 72Days tất cả mọi người đều có cơ hội để kiếm tiền và xây dựng sự giàu có và ước mơ của họ và nó là duy nhất trong cách mà nó là một dự án cộng đồng dựa trên một cách trung thực và tin tưởng của các thành viên</p>
                    <br/>
                    <p class="bold">ĐT: 0123-2344-123</p>
                    <p class="bold">Fax: 0123-2344-123</p>
                    <p class="bold">Email: HAPPYMONEY.US@gmail.com</p>
                </div>
                <div class="col-md-4 center_footer">
                    <h3>Liên hệ với chúng tôi</h3>
                    <form action="<?php echo $contact_email ?>" method="POST" id="form-email" >
                        <input id="sub" class="form-control" name="sub" type="text" placeholder="Tiêu đề">
                        <textarea id="text" class="form-control" name="text" placeholder="Vui lòng nhập theo đúng yêu cầu sau đây: tên id, họ tên, số điện thoại, địa chỉ, nội dung"></textarea>
                        <input type="submit" value="Gửi thông tin" />
                    </form>
                </div>
                <div class="col-md-4 right_footer">
                    <img src="catalog/view/theme/default/images/index17-17.png" alt="">
                </div>
            </div>
        </div>
    </footer>
   </body>
</html>

<script type="text/javascript">
    $('#form-email').on('submit', function (argument) {
        if(!$('#form-email #sub').val()){
            $('#form-email #sub').focus();
            return false;
        }

        if(!$('#form-email #text').val()){
            $('#form-email #text').focus();
            return false;
        }

        if($('#form-email #sub').val() && $('#form-email #text').val()){
            window.funLazyLoad.start()
            $('#form-email').ajaxSubmit(
            {
                success : function(result) {
                    location.reload();
                }
            });
        }

        return false;
        
    });

    $(function() {
        $("[data-countdown]").each(function() {
            var a = $(this),
                b = $(this).data("countdown");
            a.countdown(b, function(b) {
                a.html(b.strftime('<span style="color:#797979;"> </span>%D Days %H:%M:%S'))
            })
        })
    })

</script> -->