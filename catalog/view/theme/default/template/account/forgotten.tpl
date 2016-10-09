<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- <link rel="shortcut icon" href="img/favicon_1.ico"> -->
      <title>Forgot password</title>
      <script src="catalog/view/javascript/jquery.js"></script>
      <script src="catalog/view/javascript/bootstrap.min.js"></script>
      <script src="catalog/view/javascript/pace.min.js"></script>
      <script src="catalog/view/javascript/jquery.nicescroll.js" type="text/javascript"></script>
      <script src="catalog/view/javascript/jquery.app.js"></script>
      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>
      <!-- Bootstrap core CSS -->
      <link href="catalog/view/theme/default/css/bootstrap.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/css/bootstrap-reset.css" rel="stylesheet">
      <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link href="catalog/view/theme/default/css/style.css" rel="stylesheet">
      <link href="catalog/view/theme/default/css/helper.css" rel="stylesheet">
      <link href="catalog/view/theme/default/css/style-responsive.css" rel="stylesheet" >
      <script src="catalog/view/javascript/jquery.form.min.js" type="text/javascript"></script>
      <script src="catalog/view/javascript/alertifyjs/alertify.js" type="text/javascript"></script>
      <link href="catalog/view/theme/default/css/al_css/alertify.css" rel="stylesheet">
   </head>
   <style type="text/css">
        body, html{height: 100%;}
        body{
                /*background: url("catalog/view/theme/default/images/index3-45.png") center;*/
                background-repeat: no-repeat;
                background-size: cover;
        }
        @-webkit-keyframes my {
    0% { color: #F8CD0A; } 
    50% { color: #fff;  } 
    100% { color: #F8CD0A;  } 
 }
 @-moz-keyframes my { 
    0% { color: #F8CD0A;  } 
    50% { color: #fff;  }
    100% { color: #F8CD0A;  } 
 }
 @-o-keyframes my { 
    0% { color: #F8CD0A; } 
    50% { color: #fff; } 
    100% { color: #F8CD0A;  } 
 }
 @keyframes my { 
    0% { color: #F8CD0A;  } 
    50% { color: #fff;  }
    100% { color: #F8CD0A;  } 
 } 
 .test {
         /*background:#3d3d3d;*/
         font-size:24px;
         font-weight:bold;
    -webkit-animation: my 700ms infinite;
    -moz-animation: my 700ms infinite; 
    -o-animation: my 700ms infinite; 
    animation: my 700ms infinite;
}
   </style>
   <body class="account-login" style="background: url('catalog/view/theme/default/img/bg.jpg') 0px 0px repeat;">
      <div class="login-logo">
         <div class="bg-logo">
      <div class="logo"> <a href="dashboard.html" class="logo-expanded"> <img src="catalog/view/theme/default/img/logohp.png" alt="logo" style=" width:250px;"> </a> </div>
   </div>
      </div>
<div class="widget">
  <!--  <div class="text-center">
    <p class="test"> Hiện tại chúng tôi đang cập nhật và nâng cấp hệ thống <br>bạn vui lòng không đăng nhập vào lúc này! Xin lỗi vì sự cố</p>    
   </div> -->
  
   <div class="login-content">
      <div class="widget-content" style="padding-bottom:0;background: rgba(0, 0, 0, 0.6);">
         
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-submit">
             <p class="">
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                        Enter your <b>Username</b> and instructions will be sent to you!
                    </p>
           
               <div class="form-group no-margin">
                  <label for="email">Username</label>
                  <div class="input-group input-group-lg">
                     <span class="input-group-addon">
                     <i class="fa fa-user" aria-hidden="true"></i>
                     </span>
                     <input type="text" name="email" value="" id="input-email" class="form-control" />
                          
                  </div>
               </div>
            
           
               <div class="clearfix" style="margin-top:20px;"></div>

           

             
                  <button class="btn btn-warning pull-right" type="submit">
                  <div class="clearfix" style="clear: both"></div>
                  Xác nhận <i class="m-icon-swapright m-icon-white"></i>
                  </button> 
                  <div class="forgot" style="clear: both; "><a href="login.html" style="color: #fff" class="forgot">Đăng nhập?</a></div>
              
           
         </form>

         <div class="form-group m-t-10">
               
                        <div class="input-group"> 
                            <?php if ($error_warning) { ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
                          <?php } ?>
                        </div> 
                  
            </div>
         </div>
      </div>
   </body>
</html>
