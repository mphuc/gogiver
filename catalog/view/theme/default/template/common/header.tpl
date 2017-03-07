<!DOCTYPE html>
<html dir="<?php echo $direction; ?>">
  <!--<![endif]-->

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $title; ?> - Empowering Communitees, Ending Poverty </title>
    <meta http-equiv="cache-control" content="no-cache"/>
    <base href="<?php echo $base; ?>" />
    
    <meta name="description" content="Iontach is a community where people help each other.Iontach is not a bank, Iontach does not collect your money, Iontach is not an online business, HYIP, investment or MLM program. Iontach is a community where people help each other." />
  
    <meta name="keyword" content="Iontach Community, Iontach Corporation, mlm,mml">
<meta name="robots" content="index, follow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="catalog/view/theme/default/img/icon.png">
    <script src="catalog/view/javascript/jquery/underscorejs/underscorejs.js" type="text/javascript"></script>

    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/jquery/jquery.easyui.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/jquery/jquery-ui.js" type="text/javascript"></script>

    <script src="catalog/view/javascript/jquery/jquery.quick.pagination.min.js" type="text/javascript"></script>
        
    <script src="catalog/view/javascript/loading.js" type="text/javascript"></script>
    
    
    <script src="catalog/view/javascript/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/jquery.app.js"></script>
       
    
    
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <!-- Css files -->
        <!-- Icons -->
        <link href="catalog/view/theme/default/css/jquery.fancybox.css" rel="stylesheet" type="text/css" /> 
        <link href="catalog/view/theme/default/css/icons/font-awesome.css" rel="stylesheet" />
      
        <link href="catalog/view/theme/default/css/bootstrap/bootstrap.css" rel="stylesheet" />
      
        <link href="catalog/view/theme/default/css/main.css" rel="stylesheet" />
       
        <link href="catalog/view/theme/default/css/plugins.css" rel="stylesheet" />
       
        <link href="catalog/view/theme/default/css/theme/theme-default.css" rel="stylesheet" />
        
        <link href="catalog/view/theme/default/css/responsive.css" rel="stylesheet" />
        
        <link href="catalog/view/theme/default/css/custom.css" rel="stylesheet" />
        <link href="catalog/view/theme/default/stylesheet/fakeloader.css" rel="stylesheet">
    <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
    <script  src="catalog/view/javascript/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/common.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/jquery.animateNumber.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/smooth-sliding-menu.js" type="text/javascript"></script>
    <!-- <script src="catalog/view/theme/default/ckeditor/ckeditor.js" ></script>
    <script src="catalog/view/theme/default/ckeditor/samples/js/sample.js" ></script>
    <link href="catalog/view/theme/default/ckeditor/samples/css/samples.css" rel="stylesheet" />
    <link href="catalog/view/theme/default/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" rel="stylesheet" /> -->
    <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript"></script>
    <?php } ?>
    <?php echo $google_analytics; ?>
     <script type="text/javascript">
            window.funLazyLoad = {
                start : function() {
                    $("#fakeloader").fakeLoader({
                        timeToHide : 99999999999, //Time in milliseconds for fakeLoader disappear
                        zIndex : "999", //Default zIndex
                        spinner : "spinner2",
                        bgColor : "rgba(0,0,0,0.5)", //Hex, RGB or RGBA colors
                    });
                },
                reset : function() {
                    $("#fakeloader").hide();
                },
                show : function() {
                    $("#fakeloader").show();
                }
            }

        </script>
 
    <link href="catalog/view/javascript/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="catalog/view/javascript/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="catalog/view/javascript/jquery.form.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/alertifyjs/alertify.js" type="text/javascript"></script>
    <link href="catalog/view/theme/default/css/al_css/alertify.css" rel="stylesheet">
    <script src="catalog/view/javascript/bootstrap/bootstrap.js"></script>
        <!-- Core plugins ( not remove ) -->
        <script src="catalog/view/javascript/libs/modernizr.custom.js"></script>
        <script src="catalog/view/javascript/libs/jRespond.js"></script>
    <script src="catalog/view/javascript/jquery.adminPlugin.js"></script>
        <script src="catalog/view/javascript/main.js"></script>
         <script src="catalog/view/javascript/changeLang.js" type="text/javascript"></script>
    <script type="text/javascript">
      var chkReadyState = setInterval(function() {
          if (document.readyState == "complete") {
              // clear the interval
              clearInterval(chkReadyState);
              jQuery('.preloader').hide()
              // finally your page is loaded.
          }
      }, 100);
    </script>
  </head>

  <body class="loading ball-scale-multiple top-bar-fixed left-sidebar-fixed page-footer ovh">
    <div id="fakeloader"></div>
    <div class="preloader">
            <div class="loader-inner">
                <div></div>
                <div></div>
                <div></div>

            </div>
            
        </div>

        <header class="top-bar">

            <nav class="navbar navbar-default">
                <ul class="nav navbar-nav">
                    <li class="sidebar-toggle">
                        <a id="left-sidebar-toggle" href="#">
                            <i class="fa fa-navicon"></i>
                        </a>
                    </li>
                    <li class="sidebar-hide">
                        <a id="left-sidebar-hide" href="#">
                            <i class="fa fa-navicon"></i>
                        </a>
                    </li>
                    <li class="page-title">
                        <h2 id="title_page"></h2>
                    </li>
                     <a style="margin-top: 12px; float: left; font-size: 16px; margin-left: 10px;"  href="<?php echo $self -> url -> link('account/manual', '', 'SSL'); ?>"> <span class="nav-item-text btn btn-success"><?php echo $lang['Manual'] ?></span></a>
                </ul>
               
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown" >

                        <a href="#" data-toggle="dropdown">
                            <img class="avatar mr5" src="catalog/view/theme/default/img/icon.png" alt="SuggeElson">
                            <span class="user-name"><?php echo $customer['username'] ?></span> 
                            <span class="caret"></span> 
                        </a>
                        <ul class="dropdown-menu right" role="menu">
                            <li><a href="setting.html"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-calendar"></i> My Shedule</a>
                            </li>
                            <li><a href="#"><i class="fa fa-envelope"></i> My Messages</a>
                            </li>
                            <li><a href="#"><i class="fa fa-edit"></i> My Tasks</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-lock"></i> Lock Screen</a>
                            </li>
                            <li><a href="logout.html"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                
               <li class="dropdown language-selector pull-right">

                <?php switch (intval($pd_march)) {
                  case 0:
                      echo '<a href="provide-donation.html" style=" margin-right: 5px; position: relative;"> PD <span class="badge badge-accent">0</span> </a>';
                      break;
                 case 1:
                      echo '<a href="provide-donation.html" style=" margin-right: 5px; position: relative;"> PD <span class="badge badge-accent">1</span> </a>';
                      break;
                 case 2:
                      echo '<a href="provide-donation.html" style=" margin-right: 5px; position: relative;"> PD <span class="badge badge-accent">2</span> </a>';
                      break;
                 case 3:
                      echo '<a href="provide-donation.html" style=" margin-right: 5px; position: relative;"> PD <span class="badge badge-accent">3</span> </a>';
                      break;
                 case 4:
                      echo '<a href="provide-donation.html" style=" margin-right: 5px; position: relative;"> PD <span class="badge badge-accent">4</span> </a>';
                      break;
                
              } ?>
                <?php switch (intval($gd_march)) {
                  case 0:
                      echo '<a href="getdonation.html" style=" margin-right: 5px; position: relative;"> GD <span class="badge badge-accent">0</span> </a>';
                      break;
                 case 1:
                      echo '<a href="getdonation.html" style=" margin-right: 5px; position: relative;"> GD <span class="badge badge-accent">1</span> </a>';
                      break;
                 case 2:
                      echo '<a href="getdonation.html" style=" margin-right: 5px; position: relative;"> GD <span class="badge badge-accent">2</span> </a>';
                      break;
                 case 3:
                      echo '<a href="getdonation.html" style=" margin-right: 5px; position: relative;"> GD <span class="badge badge-accent">3</span> </a>';
                      break;
                 case 4:
                      echo '<a href="getdonation.html" style=" margin-right: 5px; position: relative;"> GD <span class="badge badge-accent">4</span> </a>';
                      break;
                
              } ?>
                  Language:
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                    <img id="img" src="<?php if (trim($_SESSION['language_id']) == "vietnamese") echo "catalog/view/theme/default/img/flags/af.png"; else echo "catalog/view/theme/default/img/flags/ae.png" ?>" />
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li  class="<?php if (trim($_SESSION['language_id']) == "vietnamese") echo "active" ?>">
                      <a id="vn" href="javascript:void(0)" data-link="<?php echo $changelanguage ?>">
                        <img src="catalog/view/theme/default/img/flags/af.png" />
                        <span>Việt Nam</span>
                      </a>
                    </li>
                    <li  class="<?php if (trim($_SESSION['language_id']) == "english") echo "active" ?>">
                      <a id="en" href="javascript:void(0)" data-link="<?php echo $changelanguage ?>">
                        <img src="catalog/view/theme/default/img/flags/ae.png" />
                        <span>English</span>
                      </a>
                    </li>
                    
                  </ul>
                </li>
                <div class="dropdown pull-right mail_header">
                  <li class="dropdown language-selector pull-right dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                  <span class="badge badge-accent" style="left: 12px;"><?php echo count($get_mail_admin) ?></span>
                  </li>
                  
                  <ul class="dropdown-menu" style="padding-bottom: 10px;">
                  <?php foreach ($get_mail_admin as $value) { ?>
                    <div class="notifiadmin">
                    <a href="mail.html">
                      <p class="content_mail">Message from admin</p>
                    </a>
                      <p class="date_mail"><?php echo date('d/m/Y H:i',strtotime($value['date_added'])) ?></p>
                    </div>
                  <?php } ?>
                    
                  </ul>
                </div>
                
            </nav>
        </header>

