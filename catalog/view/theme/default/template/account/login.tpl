<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8">
        <title>Login | Iontach - Empowering Communitees, Ending Poverty</title>
        <!-- Mobile specific metas -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <!-- Force IE9 to render in normal mode -->
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="author" content="" />
        <meta name="description" content="Iontach is a community where people help each other.Iontach is not a bank, Iontach does not collect your money, Iontach is not an online business, HYIP, investment or MLM program. Iontach is a community where people help each other." />
    
        <meta name="keyword" content="Iontach Community, Iontach Corporation, mlm,mml">
<meta name="robots" content="index, follow"/>
        <meta name="application-name" content="" />
        <link rel="icon" href="catalog/view/theme/default/img/icon.png">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <!-- Css files -->
        <!-- Icons -->
        <link href="catalog/view/theme/default/css/icons/font-awesome.css" rel="stylesheet" />
      
        <link href="catalog/view/theme/default/css/bootstrap/bootstrap.css" rel="stylesheet" />
      
        <link href="catalog/view/theme/default/css/main.css" rel="stylesheet" />
       
        <link href="catalog/view/theme/default/css/plugins.css" rel="stylesheet" />
       
        <link href="catalog/view/theme/default/css/theme/theme-default.css" rel="stylesheet" />
        
        <link href="catalog/view/theme/default/css/responsive.css" rel="stylesheet" />
        
        <link href="catalog/view/theme/default/css/custom.css" rel="stylesheet" />
       
    </head>
    <body class="login-page">
        <div class="container">
            
        </div>
        <!-- Start login container -->
        <div class="container login-container">
            <div class="login-panel panel plain">
                <!-- Start .panel -->
                <div class="panel-body p0">
                    <div class="text-center mb30">
                         <img src="catalog/view/theme/default/img/logo.png" width="200" class="logo" alt="Dash logo">
                    </div>
                     <form action="login.html" class="form-horizontal mt0" method="post">
                    <form action="login.html" method="post" class="form-horizontal m-t-10" class="no-margin">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <span class="input-group-addon input-group-lg"><i class="fa fa-envelope"></i></span>
                                    <input  autocomplete="off" type="text" name="email" value="<?php echo $email; ?>" placeholder="Username" id="input-email" class="form-control input-lg" />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <span class="input-group-addon input-group-lg"><i class="fa fa-key"></i></span>
                                    
                                    <input autocomplete="off" type="password" name="password" value="<?php echo $password; ?>" placeholder="Password" id="input-password" class="form-control input-lg"  />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                        <img class="img_capcha" style="float: left" src="captcha_code.php"/>
                        <input style="width: 150px; margin-left: px; float: right" autocomplete="off" type="text" name="capcha" placeholder="Capcha" id="input-password" value="" class="form-control" />
                      </div>
                    </div>

                        <div class="form-group mb0">
                                
                            <div class="col-lg-12 mt30">
                                <button class="btn btn-danger btn-lg btn-block uppercase" type="submit"><i class="fa fa-unlock-alt mr5"></i> sign in</button>
                            </div>
                        </div>
                        <?php if ($redirect) { ?>
                          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                          <?php } ?>
                       </div>
                       <?php if ($success) { ?>
                       <div class="error_warning"><i class="fa fa-check-circle"></i>
                          <?php echo $success; ?>
                       </div>
                       <?php } ?>
                       <?php if ($error_warning) { ?>
                       <div class="error_warning"><i class="fa fa-exclamation-circle"></i>
                          <?php echo $error_warning; ?>
                       </div>
                       <?php } ?>
                    </form>
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- End login container -->
        <div class="container">
            <div class="footer-links">
                
                <p class="text-center mb5"><a href="forgot.html" class="color-gray-lighter color-hover-white s16 transition" style=" color: #48ae00 !important; "> Forgot your password ?</a>
                </p>
            </div>
        </div>

        <!-- Init plugins olny for this page -->
      
        <script src="catalog/view/theme/default/assetslg/js/jquery-1.11.1.min.js"></script>
        <script src="catalog/view/theme/default/assetslg/bootstrap/js/bootstrap.min.js"></script>
        <script src="catalog/view/theme/default/assetslg/js/jquery.backstretch.min.js"></script>
        <script src="catalog/view/theme/default/assetslg/js/scripts.js"></script>
    </body>

</html>

