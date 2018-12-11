<?php require_once('Connections/cn_tanzi.php'); ?>
<?php
if(empty($_SESSION['looking'])){
									$_SESSION['looking']= array();//建立陣列;
								}
								
if(isset($_GET['Id'])){
	
			$house_id = $_GET['Id'];
			array_push($_SESSION['looking'],"$house_id");
			
			$_SESSION['looking_num'] = count($_SESSION['looking']);
			
	}


?>
<?php 
//頁碼
if(isset($_GET['h_class_Id'])){		$h_class_Id = $_GET['h_class_Id'];
									$sql_count = mysql_query("SELECT * FROM `house` WHERE `Class`=$h_class_Id");
						 }else{
									$sql_count = mysql_query("SELECT * FROM `house`");
							  }
							  
$total_count = mysql_num_rows($sql_count);				//總筆數
$page_num = 9;											//預設產品數
$total_page = ceil($total_count/$page_num);				//總頁數
$mod_num = fmod($total_count,$page_num);				//取餘數
$per_count = $page_num;									//每頁筆數
$start = 0; 											//起始資料序號
$end = $page_num;										//取得瀏覽頁數,沒有則設為第一頁


if(isset($_GET['h_class_Id'])){	
	
	if(isset($_GET['page'])){
							$page = $_GET['page'];
							if ($page!=""){	$page=$_GET['page'];}else{	$page=1;}
							$begin = ($page-1) * $page_num;	
							$sql = mysql_query("SELECT * FROM `house` WHERE `Class`=$h_class_Id ORDER BY `Id` ASC LIMIT $begin,$per_count");
					}else {
							$sql = mysql_query("SELECT * FROM `house` WHERE `Class`=$h_class_Id ORDER BY `Id` ASC LIMIT $per_count");
						 }
	
						 
if(isset($_GET['start'],$_GET['end'])){
												$start = $_GET['start']+1;
												if($_GET['page'] == $total_page){
													   		$end = $total_count;																													
													}else{
															$end = $_GET['end']+1;
													}
									  }else{
										  		$start=1;
												$end=$page_num;
										   }
	
	
	}else{

if(isset($_GET['page'])){
							$page = $_GET['page'];
							if ($page!=""){	$page=$_GET['page'];}else{	$page=1;}
							$begin = ($page-1) * $page_num;	
							$sql = mysql_query("SELECT * FROM `house` ORDER BY `Id` ASC LIMIT $begin,$per_count");
					}else{
							$sql = mysql_query("SELECT * FROM `house` ORDER BY `Id` ASC LIMIT $per_count");
						 }
	
						 
if(isset($_GET['start'],$_GET['end'])){
												$start = $_GET['start']+1;
												if($_GET['page'] == $total_page){
													   		$end = $total_count;																													
													}else{
															$end = $_GET['end']+1;
													}
									  }else{
										  		$start=1;
												$end=$page_num;
										   }
	}//esle的

?>
<?php 
$sql_class = mysql_query("SELECT * FROM `house_class`");//產品類別
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Definity - Shop Right Sidebar Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/favicon.ico">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/styles/vendor/bootstrap.min.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/fonts/et-lineicons/css/style.css">
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/fonts/linea-font/css/linea-font.css">
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/fonts/fontawesome/css/font-awesome.min.css">
        <!-- Slider -->
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/styles/vendor/slick.css">
        <!-- Lightbox -->
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/styles/vendor/magnific-popup.css">
        <!-- Animate.css -->
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/styles/vendor/animate.css">
        <!-- Range Slider -->
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/styles/vendor/jquery-ui.min.css">
        <link rel="stylesheet" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/styles/vendor/jquery-ui.structure.min.css">


        <!-- Definity CSS -->
        <link rel="stylesheet" href="assets/styles/main.css">
        <link rel="stylesheet" href="assets/styles/responsive.css">

        <!-- JS -->
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar">
        
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <!-- ========== Preloader ========== -->

        <div class="preloader">
          <img src="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/images/loader.svg" alt="Loading...">
        </div>
        
        
        
        <!-- ========== Navigation ========== -->

        <nav class="navbar navbar-default navbar-static-top navbar-inverse mega">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <!-- Logo -->
              <a class="navbar-brand" href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index.html"><img class="navbar-logo" src="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/images/logo-light.png" alt="Definity - Logo"></a>
            </div><!-- / .navbar-header -->

            <!-- Navbar Links -->
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">

                <!-- Home -->
                <li class="dropdown mega-fw">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Home<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <div class="row">

                      <!-- Multi Page -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Multipage</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-main-mp.html" target="_blank">Main Demo</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fs-slider-mp.html" target="_blank">Full Screen Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fs-video-mp.html" target="_blank">Full Screen Video</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-kenburn-mp.html" target="_blank">Kenburn Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fw-slider-mp.html" target="_blank">Full Width Slider</a></li>
                      </div>

                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Multipage</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-animated-mp.html" target="_blank">Animated Heading</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fw-video-mp.html" target="_blank">Full Width Video</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-text-mp.html" target="_blank">Text Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-freelancer-mp.html" target="_blank">Freelancer</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-agency-mp.html" target="_blank">Agency</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-agency2-mp.html" target="_blank">Agency 2</a></li>
                      </div>

                      <!-- Onepage -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Onepage</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-main-op.html" target="_blank">Main Demo</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fs-slider-op.html" target="_blank">Full Screen Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fs-video-op.html" target="_blank">Full Screen Video</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-kenburn-op.html" target="_blank">Kenburn Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fw-slider-op.html" target="_blank">Full Width Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-fw-video-op.html" target="_blank">Full Width Video</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-landing.html" target="_blank">Landing Page</a></li>
                      </div>

                      <div class="col-md-3 mb-sm-30">
                        <li class="dropdown-header">Onepage</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-animated-op.html" target="_blank">Animated Heading</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-text-op.html" target="_blank">Text Slider</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-freelancer-op.html" target="_blank">Freelancer</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-agency-op.html" target="_blank">Agency</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-agency2-op.html" target="_blank">Agency 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-app-landing.html" target="_blank">Mobile App</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/index-web-app-landing.html" target="_blank">Web App</a></li>
                        
                      </div>
                    </div><!-- / .row -->
                  </ul><!-- / .dropdown-menu -->
                </li><!-- / Home -->
                

                <!-- Elements -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Elements <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <div class="row">

                      <!-- Basic -->
                      <div class="col-lg-6 mb-sm-30">
                        <li class="dropdown-header">Basic</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/typography.html" target="_blank"><i class="fa fa-font"></i> Typography</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/buttons.html" target="_blank"><i class="fa fa-bold"></i> Buttons</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/forms.html" target="_blank"><i class="fa fa-send"></i> Forms</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/grid.html" target="_blank"><i class="fa fa-th"></i> Grid</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/alerts.html" target="_blank"><i class="fa fa-info-circle"></i> Alerts</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/labels.html" target="_blank"><i class="fa fa-tags"></i> Labels</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/progress-bars.html" target="_blank"><i class="fa fa-tasks"></i> Progress Bars</a></li>
                        <li><a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><i class="fa fa-flag"></i> Font Awesome</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/line-icons-page.html" target="_blank"><i class="fa fa-flag-o"></i> Line Icons</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/linea-icons-page.html" target="_blank"><i class="fa fa-flag-o"></i> Line Icons 2</a></li>
                      </div>

                      <!-- Layout -->
                      <div class="col-lg-6 mb-sm-30">
                        <li class="dropdown-header">Layout</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/headers.html" target="_blank"><i class="fa fa-header"></i> Headers</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/footers.html" target="_blank"><i class="fa fa-leaf"></i> Footers</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/features.html" target="_blank"><i class="fa fa-star"></i> Features <span class="label label-warning">Hot</span></a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/cta.html" target="_blank"><i class="fa fa-link"></i> CTA</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/counters.html" target="_blank"><i class="fa fa-circle-o-notch"></i> Counters</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/pricing.html" target="_blank"><i class="fa fa-dollar"></i> Pricing</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/team.html" target="_blank"><i class="fa fa-users"></i> Team</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/testimonials.html" target="_blank"><i class="fa fa-comment"></i> Testimonials</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/hover.html" target="_blank"><i class="fa fa-image"></i> Hover</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/elements/tables.html" target="_blank"><i class="fa fa-table"></i> Tables <span class="label label-red">New</span></a></li>
                      </div>

                    </div><!-- / .row -->
                  </ul><!-- / .dropdown-menu -->
                </li><!-- / Elements -->


                <!-- Pages -->
                <li class="dropdown mega-fw">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <div class="row">
                      
                      <!-- Introduction -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Introduction</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/about-1.html">Abouts Us 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/about-2.html">About Us 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/team-1.html">Team Members 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/team-2.html">Team Members 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/clients.html">Clients</a></li>
                      </div>

                      <!-- Contact -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Contact</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/contact-1.html">Contact Page 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/contact-2.html">Contact Page 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/contact-3.html">Contact Page 3</a></li>
                      </div>

                      <!-- Utility -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Utility</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/services-1.html">Services</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/faq-1.html">F.A.Q. Page 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/faq-2.html">F.A.Q. Page 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/login-1.html">Login Page 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/login-2.html">Login Page 2</a></li>
                      </div>

                      <!-- Miscellaneous -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Other</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/404.html">404 Page</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/maintenance.html">Maintenance Page</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/coming-soon-1.html">Coming Soon 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/coming-soon-2.html">Coming Soon 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blank.html">Blank Page</a></li>
                      </div>

                    </div><!-- / .row -->
                  </ul><!-- / .dropdown-menu -->
                </li><!-- / Pages -->
                

                <!-- Portfolio -->
                <li class="dropdown mega-fw">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Portfolio <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <div class="row">
                      
                      <!-- Full Width -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Full Width</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-fw-1col.html">Full Width 1 Column</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-fw-2col.html">Full Width 2 Columns</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-fw-3col.html">Full Width 3 Columns</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-fw-4col.html">Full Width 4 Columns</a></li>
                      </div>

                      <!-- Boxed -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Boxed</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-boxed-1col.html">Boxed 1 Columns</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-boxed-2col.html">Boxed 2 Columns</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-boxed-3col.html">Boxed 3 Columns</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-boxed-4col.html">Boxed 4 Columns</a></li>
                      </div>

                      <!-- Masonry -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Masonry</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-masonry-1.html">Masonry Layout 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-masonry-2.html">Masonry Layout 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-masonry-3.html">Masonry Layout 3</a></li>
                      </div>

                      <!-- Other -->
                      <div class="col-lg-3 mb-sm-30">
                        <li class="dropdown-header">Other</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-single-1.html">Portfolio Single 1</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-single-2.html">Portfolio Single 2</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-single-3.html">Portfolio Single 3</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/portfolio/portfolio-single-4.html">Portfolio Single 4</a></li>
                      </div>

                    </div><!-- / .row -->
                  </ul><!-- / .dropdown-menu -->
                </li><!-- / Portfolio -->
                

                <!-- Blog -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Blog <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-header">Blog</li>
                    <li role="separator" class="divider"></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-left-sidebar.html">Blog Left Sidebar</a></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-right-sidebar.html">Blog Right Sidebar</a></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-2col.html">Blog 2 Columns</a></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-3col.html">Blog 3 Columns</a></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-masonry-2col.html">Blog Masonry 2 Columns</a></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-masonry-3col.html">Blog Masonry 3 Columns</a></li>
                    <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/blog/blog-post.html">Blog Single</a></li>
                  </ul>
                </li><!-- / Blog -->


                <!-- Shop -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Shop <span class="caret"></span></a>
                  <ul class="dropdown-menu bg-solid">
                    <div class="row">
                      <div class="col-lg-7">
                        <li class="dropdown-header">Shop</li>
                        <li role="separator" class="divider"></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-right-sidebar.html">Shop Right Sidebar</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-left-sidebar.html">Shop Left Sidebar</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-4col.html">Shop 4 Columns</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html">Single Product</a></li>
                        <li><a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-checkout.html">Checkout Page</a></li>
                      </div>
                      <div class="col-lg-5 dropdown-banner">
                        <img src="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/assets/images/shop/baner-shop-dark.png" alt="Definity eCommerce update">
                      </div>
                    </div>
                  </ul>
                </li><!-- / Blog -->
              </ul><!-- / .nav .navbar-nav -->
              

              <!-- Navbar Links Right -->
              <ul class="nav navbar-nav navbar-right">

                <!-- Cart (bag icon + notification) -->
                <li class="dropdown cart-nav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="cart-notif">2</span><i class="linea-ecommerce-bag"></i> Cart</a>
                  <ul class="dropdown-menu cart-dropdown">
                    <li class="dropdown-header">Cart</li>
                    <li role="separator" class="divider cart-sep-top"></li>
                    <li>
                      <div class="cart-item">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                        <a href="#" class="cart-remove-btn"><span class="linea-arrows-square-remove"></span></a>
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Light Blue Suit</a>
                        <p class="cp-price">1 x $359.99</p>
                      </div>

                      <div class="cart-item">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                        <a href="#" class="cart-remove-btn"><span class="linea-arrows-square-remove"></span></a>
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Dark Blue Suit</a>
                        <p class="cp-price">1 x $459.99</p>
                      </div>
                    </li>
                    <li role="separator" class="divider cart-sep-bot"></li>
                    <li>
                      <h6 class="item-totals">Items Total: <span>$718.98</span></h6>
                    </li>
                    <li class="cart-btns">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-checkout.html" class="btn-ghost-light btn-block">View Cart</a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-checkout.html" class="btn btn-light btn-block">Checkout</a>
                    </li>

                  </ul>
                </li><!-- / Cart -->

                <!-- Search -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i> Search</a>
                  <ul class="dropdown-menu search-dropdown">
                    <li><form action="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/post"><input type="search" class="form-control" placeholder="Search..."></form></li>
                  </ul>
                </li><!-- / Search -->

                <!-- Languages -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EN <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">DE</a></li>
                    <li><a href="#">FR</a></li>
                    <li><a href="#">ES</a></li>
                  </ul>
                </li><!-- / Languages -->

              </ul><!-- / .nav .navbar-nav .navbar-right -->

            </div><!--/.navbar-collapse -->
          </div><!-- / .container -->
        </nav><!-- / .navbar -->


        <!-- ========== Page Title ========== -->

        <header class="page-title pt-large pt-dark pt-plax-lg-dark"
        data-stellar-background-ratio="0.4">
          <div class="container">
              <div class="row">

                <div class="col-sm-6">
                  <h1>Shop</h1>
                  <span class="subheading">Shop layout with sidebar</span>
                </div>
                <ol class="col-sm-6 text-right breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Elements</a></li>
                  <li class="active">Shop</li>
                </ol>

              </div>
            </div>
        </header>


        
        <!-- ========== Shop - (4 columns) ========== -->

        <div class="gray-bg">
          <div class="container section-shop">

            <div class="row">
              
              <!-- Shop Layout - (3 columns) -->
              <div class="col-md-9">

                <!-- Shop layout options -->
                <div class="row mb-50">
                  <div class="col-xs-12 col-sm-6 col-md-9 mb-sm-30">
                    <span>SHOWING 1–12 OF 24 RESULTS</span>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3 pull-right">
                    <select class="form-control" id="select-form">
                      <option>Default Sorting</option>
                      <option>Highest Price</option>
                      <option>Lowset Price</option>
                      <option>Newest First</option>
                    </select>
                  </div>
                </div><!-- / .row -->
                
                
                <div class="row">
                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <span class="label label-red sale-label">SALE</span>

                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 1"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 6"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 8"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Casual Gray Blazer</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price"><span class="price-cut">$287.99</span> $187.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-sm-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 2"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 9"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">White Suit</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$487.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-lg-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 1"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 2"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Dark Blue Suit</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$487.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-lg-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 7"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 4"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Gray Padded Jacket</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$487.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-lg-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <span class="label label-red sale-label">SALE</span>

                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 6"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350g" alt="Product Image 11"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Light Blue Blazer</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price"><span class="price-cut">$187.99</span> $97.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-sm-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 8"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 1"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Dark Gray Blazer</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$115.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-lg-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">

                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350g" alt="Product Image 10"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 2"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Black Jacket</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$127.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-sm-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <span class="label label-red sale-label">SALE</span>

                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350g" alt="Product Image 11"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 6"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Casual Blue Blazer</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price"><span class="price-cut">$250.99</span> $217.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-lg-3 -->


                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <!-- Product Actions (hover) -->
                        <a href="#" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350g" alt="Product Image 12"></a>
                          <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/263x350" alt="Product Image 4"></a>
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><h4 class="product-name">Black Jacket</h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$487.99</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-lg-3 -->
                </div><!-- / .row -->


                <!-- Pagination -->
                <div class="row">
                  <nav class="blog-pagination text-center">
                    <ul class="pagination">
                      <li>
                        <a href="#" aria-label="Previous">
                          <span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span>
                        </a>
                      </li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">...</a></li>
                      <li><a href="#">7</a></li>
                      <li>
                        <a href="#" aria-label="Next">
                          <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div><!-- / .row -->

              </div><!-- / .col-md-9 -->



              <!-- Shop Sidebar - (vertical) -->
              <div class="col-md-3">
                <aside class="shop-sidebar-vertical mb-sm-100">

                  <!-- Search Widget -->
                  <div class="shop-widget search-widget">
                    <div class="form-group">
                      <input type="search" placeholder="Search ..." class="form-control">
                      <button class="inside-input-btn"><i class="fa fa-search"></i></button>
                    </div>
                  </div>

                  <!-- Cart Widget -->
                  <div class="shop-widget cart-widget mb-sm-50">
                    <h5 class="header-widget">Cart</h5>
                    <div class="cart-item">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                      <a href="#" class="cart-remove-btn"><span class="linea-arrows-square-remove"></span></a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Light Blue Suit</a>
                      <p class="cp-price">1 x $359.99</p>
                    </div>

                    <div class="cart-item">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                      <a href="#" class="cart-remove-btn"><span class="linea-arrows-square-remove"></span></a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Dark Blue Suit</a>
                      <p class="cp-price">1 x $459.99</p>
                    </div>

                    <div class="cw-subtotal">
                      <h6 class="h-alt">SUBTOTAL: $718.98</h6>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-checkout.html" class="btn-ghost btn-small">View Cart</a>
                    </div>
                  </div><!-- / .cart-widget -->


                  <!-- Price Filter -->
                  <div class="shop-widget filter-widget">
                    <h5 class="header-widget">Filter by Price</h5>
                    <div id="shop-slider-range"></div>
                    <p>
                      <label for="amount">From:</label>
                      <input type="text" id="shop-slider-range-amount" readonly>
                    </p>
                  </div><!-- / .filter-widget -->
                  

                  <!-- Categories - Widget -->
                  <div class="shop-widget categories-widget">
                    <h5 class="header-widget">Shop Categories</h5>
                    <!-- Item 1 -->
                    <div class="widget-item">
                      <a href="#">Suits - <span>15</span></a>
                    </div>
                    <!-- Item 2 -->
                    <div class="widget-item">
                      <a href="#">T-Shirts - <span>6</span></a>
                    </div>
                    <!-- Item 3 -->
                    <div class="widget-item">
                      <a href="#">Pants - <span>12</span></a>
                    </div>
                    <!-- Item 4 -->
                    <div class="widget-item">
                      <a href="#">Accessories - <span>3</span></a>
                    </div>
                  </div><!-- / .categories-widget -->


                  <!-- Product - Widget -->
                  <div class="shop-widget product-widget">
                    <h5 class="header-widget">Bestsellers</h5>
                    <div class="cart-item">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Light Blue Suit</a>
                      <p class="cp-price"><span class="price-cut">$359.99</span> $259.99</p>
                    </div>

                    <div class="cart-item">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Dark Blue Suit</a>
                      <p class="cp-price">$459.99</p>
                    </div>

                    <div class="cart-item">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Midnight Blue Suit</a>
                      <p class="cp-price">$459.99</p>
                    </div>

                    <div class="cart-item">
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html"><img src="http://placehold.it/56x56" alt="Product Name" class="p-thumb"></a>
                      <a href="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/shop-single.html" class="cp-name">Navy Blue Suit</a>
                      <p class="cp-price">$459.99</p>
                    </div>
                  </div><!-- / .cart-widget -->

                  
                  <!-- Tags - Widget -->
                  <div class="shop-widget tags-widget">
                    <h5 class="header-widget">Tags</h5>
                    <ul class="tag-list">
                      <li><a href="#">Photography</a></li>
                      <li><a href="#">Design</a></li>
                      <li><a href="#">Development</a></li>
                      <li><a href="#">PHP</a></li>
                      <li><a href="#">UI/UX</a></li>
                      <li><a href="#">Design</a></li>
                      <li><a href="#">HTML5</a></li>
                    </ul>
                  </div>

                </aside><!-- / .shop-sidebar-vertical -->
              </div><!-- / .col-md-3 -->
            </div><!-- / .row -->

          </div><!-- / .contianer -->
        </div><!-- / .gray-bg -->



        <!-- ========== Footer Widgets ========== -->
        
        <footer class="footer-widgets">
          <div class="container section">
            <div class="row">

              <!-- About Us -->
              <div class="col-md-3">
                <div class="widget about-widget">
                  <h5 class="header-widget">About Us</h5>
                  <p>Lorem ipsum dolor sit amet, eiusmod consectetur adipisicing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>

                  <ul class="social-links">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                  </ul>
                </div><!-- / .widget -->
              </div><!-- / .col-md-3 -->

              <!-- Instagram Feed -->
              <div class="col-md-3">
                <div class="widget gallery-widget">
                  <h5 class="header-widget">Instagram Feed</h5>
                  <ul>

                    <li><a href="http://placehold.it/650x450" class="gallery-widget-lightbox"><img src="http://placehold.it/87x87/999/eee" alt="Instagram Image"><div class="hover-link"><span class="linea-arrows-plus"></span></div></a></li>

                    <li><a href="http://placehold.it/650x450" class="gallery-widget-lightbox"><img src="http://placehold.it/87x87" alt="Instagram Image"><div class="hover-link"><span class="linea-arrows-plus"></span></div></a></li>

                    <li><a href="http://placehold.it/650x450" class="gallery-widget-lightbox"><img src="http://placehold.it/87x87/999/eee" alt="Instagram Image"><div class="hover-link"><span class="linea-arrows-plus"></span></div></a></li>

                    <li><a href="http://placehold.it/650x450" class="gallery-widget-lightbox"><img src="http://placehold.it/87x87" alt="Instagram Image"><div class="hover-link"><span class="linea-arrows-plus"></span></div></a></li>

                    <li><a href="http://placehold.it/650x450" class="gallery-widget-lightbox"><img src="http://placehold.it/87x87/999/eee" alt="Instagram Image"><div class="hover-link"><span class="linea-arrows-plus"></span></div></a></li>

                    <li><a href="http://placehold.it/650x450" class="gallery-widget-lightbox"><img src="http://placehold.it/87x87" alt="Instagram Image"><div class="hover-link"><span class="linea-arrows-plus"></span></div></a></li>

                  </ul>
                </div><!-- / .widget -->
              </div><!-- / .col-md-3 -->

              <!-- Twitter Feed -->
              <div class="col-md-3">
                <div class="widget twitter-widget">
                  <h5 class="header-widget">Twitter Feed</h5>
                  <ul>
                    
                    <li>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <p>5 Reasons You Should Take a Sabbatical from Creative Work <a href="#">http://enva.to/NTa6F</a> by <a href="#">@envato</a> <span>- AUG 10</span></p>
                    </li>

                    <li>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <p>What is the enemy of <a href="#">#creativity</a>? <a href="#">http://enva.to/hVl5G</a>  [VIDEO] <br>by <a href="#">@envato</a> <span>- AUG 5</span></p>
                    </li>

                  </ul>
                </div><!-- / .widget -->
              </div><!-- / .col-md-3 -->

              <!-- Newsletter -->
              <div class="col-md-3">
                <div class="widget newsletter-widget">
                  <h5 class="header-widget">Newsletter</h5>
                  
                  <form action="file:///C|/Users/user/Desktop/SpecialTopic/套件/Definity_多合一樣板/Definity/pages/shop/post">
                    <div class="form-group">
                      <input type="email" name="w-newssletter" placeholder="Join our newsletter">
                      <button type="submit"><i class="fa fa-send-o"></i></button>
                    </div>
                  </form>

                </div><!-- / .widget -->
              </div><!-- / .col-md-3 -->

            </div><!-- / .row -->
          </div><!-- / .container -->


          <!-- Copyright -->
          <div class="copyright">
            <div class="container">
              <div class="row">
                
                <div class="col-md-6">
                  <small>&copy; 2015 Definity. Made by <a class="no-style-link" href="http://themeforest.net/user/octarinethemes" target="_blank">OctarineThemes</a></small>
                </div>

                <div class="col-md-6">
                  <small><a href="#page-top" class="pull-right to-the-top">To the top<i class="fa fa-angle-up"></i></a></small>
                </div>

              </div><!-- / .row -->
            </div><!-- / .container -->
          </div><!-- / .copyright -->

        </footer><!-- / .footer-links -->

    

        <!-- ========== Scripts ========== -->

        <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
        <script src="assets/js/vendor/google-fonts.js"></script>
        <script src="assets/js/vendor/jquery.easing.js"></script>
        <script src="assets/js/vendor/jquery.waypoints.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/vendor/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/js/vendor/smoothscroll.js"></script>
        <script src="assets/js/vendor/jquery.localScroll.min.js"></script>
        <script src="assets/js/vendor/jquery.scrollTo.min.js"></script>
        <script src="assets/js/vendor/jquery.stellar.min.js"></script>
        <script src="assets/js/vendor/jquery.parallax.js"></script>
        <script src="assets/js/vendor/slick.min.js"></script>
        <script src="assets/js/vendor/jquery.easypiechart.min.js"></script>
        <script src="assets/js/vendor/countup.min.js"></script>
        <script src="assets/js/vendor/isotope.min.js"></script>
        <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/vendor/jquery-ui.min.js"></script>
        <script src="assets/js/vendor/wow.min.js"></script>

        <!-- Definity JS -->
        <script src="assets/js/main.js"></script>
    </body>
</html>
