<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
	<!--<![endif]-->

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $title; ?> </title>
		<meta http-equiv="cache-control" content="no-cache"/>
		<base href="<?php echo $base; ?>" />
		<?php if ($description) { ?>
		<meta name="description" content="<?php echo $description; ?>" />
		<?php } ?>
		<?php if ($keywords) { ?>
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<?php } ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- <link rel="icon" href="catalog/view/theme/default/images/index3-44.png"> -->
		<script src="catalog/view/javascript/jquery/underscorejs/underscorejs.js" type="text/javascript"></script>

		<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="catalog/view/javascript/jquery/jquery.easyui.min.js" type="text/javascript"></script>
		<script src="catalog/view/javascript/jquery/jquery-ui.js" type="text/javascript"></script>

        <script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
		<script src="catalog/view/javascript/jquery/jquery.quick.pagination.min.js" type="text/javascript"></script>
        
		<script src="catalog/view/javascript/loading.js" type="text/javascript"></script>
		
		
		<script src="catalog/view/javascript/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="catalog/view/javascript/jquery.app.js"></script>
       
		
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
        <link href="catalog/view/theme/default/stylesheet/fakeloader.css" rel="stylesheet">
		<?php foreach ($styles as $style) { ?>
		<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
		<?php } ?>
		<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
		<script src="catalog/view/javascript/jquery.animateNumber.min.js" type="text/javascript"></script>
		<script src="catalog/view/javascript/smooth-sliding-menu.js" type="text/javascript"></script>
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
        <script type="text/javascript">
            $(document).ready(function() {
                // $("html").niceScroll({
                //  cursorcolor:"#333",
                //  autohidemode: false,
                //  cursorminheight : 30,
                //  cursorwidth: 10,

                // });
                $(".navigation > ul > li > a img").on({
                    "mouseover" : function() {
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-home.png", "catalog/view/theme/default/img/icon-home-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-register.png", "catalog/view/theme/default/img/icon-register-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-pin.png", "catalog/view/theme/default/img/icon-pin-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-pd.png", "catalog/view/theme/default/img/icon-pd-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-gd.png", "catalog/view/theme/default/img/icon-gd-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-refferal.png", "catalog/view/theme/default/img/icon-refferal-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-tree.png", "catalog/view/theme/default/img/icon-tree-active.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-transaction.png", "catalog/view/theme/default/img/icon-transaction-active.png");

                    },
                    "mouseout" : function() {
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-home-active.png", "catalog/view/theme/default/img/icon-home.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-register-active.png", "catalog/view/theme/default/img/icon-register.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-pin-active.png", "catalog/view/theme/default/img/icon-pin.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-pd-active.png", "catalog/view/theme/default/img/icon-pd.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-gd-active.png", "catalog/view/theme/default/img/icon-gd.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-refferal-active.png", "catalog/view/theme/default/img/icon-refferal.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-tree-active.png", "catalog/view/theme/default/img/icon-tree.png");
                        this.src = this.src.replace("catalog/view/theme/default/img/icon-transaction-active.png", "catalog/view/theme/default/img/icon-transaction.png");
                    }
                });

            });
        </script>
		
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
                </ul>
               
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <img class="avatar mr5" src="catalog/view/theme/default/images/11.jpg" alt="SuggeElson">
                            <span class="user-name"><?php echo $customer['username'] ?></span> 
                            <span class="caret"></span> 
                        </a>
                        <ul class="dropdown-menu right" role="menu">
                            <li><a href="#"><i class="fa fa-user"></i> My Profile</a>
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
                  Language:  
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                    <img src="assets/images/flag-uk.png" />
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li>
                      <a id="vn" href="javascript:void(0)" data-link="<?php echo $changelanguage ?>">
                        <img src="catalog/view/theme/default/img/flags/af.png" />
                        <span>Deutsch</span>
                      </a>
                    </li>
                    <li class="active">
                      <a id="en" href="javascript:void(0)" data-link="<?php echo $changelanguage ?>">
                        <img src="catalog/view/theme/default/img/flags/ae.png" />
                        <span>English</span>
                      </a>
                    </li>
                    
                  </ul>
                </li>
                   
            </nav>
        </header>

<!-- <div class="top_home">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left"><i class="fa fa-list-ul click_show_menu" aria-hidden="true"></i> </a>
    <div class="brand pull-left"> <a href="dashboard.html"><img src="catalog/view/theme/default/img/hplogo.png" alt="logo" style=" width:260px;"> </a></div>
    <ul class="nav navbar-nav pull-right">
    	<li><div class="thetimenow-embeddable-clock" data-type="clock" data-font-color="#be00d6" data-border-color="none" data-background-color="none" data-font-size="20" > </div> 
<script type="text/javascript" src="http://www.thetimenow.com/ttn-embed.min.js"></script></li>
      <li class="dropdown user  hidden-xs"> <a style="color: #FFF" data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-male"></i> <span class="username"><?php if($self -> request -> get['route'] !== 'account/registers' ) {?>
	<?php if(isset($self -> session -> data['customer_id'])){ ?>
		<?php if(intval($customer['cycle']) > 0 && $customer['quy_bao_tro'] == 0 ) { ?>
			<span class="text-danger countdown" data-zone="US/Central" data-countdown="<?php echo $date_auto;?>">
	        </span> |
			<?php }?> 
			<i class="fa fa-user" aria-hidden="true"></i>
			<span href="<?php echo $self -> url -> link('account/setting', '', 'SSL'); ?>" title="<?php echo $customer['username'] ?>"><?php echo $customer['username'] ?>
			</span>
		<?php } ?>
	<?php }?>
</span> <i class="icon-caret-down small"></i> </a>
        <ul class="dropdown-menu">
          <li><a href="index.php?route=account/logout"><i class="icon-key"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<style type="text/css">
	.embed-clock-copyright {
    display: none;
}
.ttn-thetimenow-clock-date {
    font-size: 19px !important;
    text-align: center;
    margin-top: 0 !important;
    float: left;
    margin-right: 11px;
    color: #ff2c00;
}
</style> -->