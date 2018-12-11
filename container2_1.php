<?php require_once('Connections/cn_tanzi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_Home_footer = "SELECT * FROM home_footer";
$cn_Home_footer = mysql_query($query_cn_Home_footer, $cn_tanzi) or die(mysql_error());
$row_cn_Home_footer = mysql_fetch_assoc($cn_Home_footer);
$totalRows_cn_Home_footer = mysql_num_rows($cn_Home_footer);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_social_introduction = "SELECT * FROM social_introduction ORDER BY Id ASC";
$cn_social_introduction = mysql_query($query_cn_social_introduction, $cn_tanzi) or die(mysql_error());
$row_cn_social_introduction = mysql_fetch_assoc($cn_social_introduction);
$totalRows_cn_social_introduction = mysql_num_rows($cn_social_introduction);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_store = "SELECT * FROM store ORDER BY Id ASC";
$cn_store = mysql_query($query_cn_store, $cn_tanzi) or die(mysql_error());
$row_cn_store = mysql_fetch_assoc($cn_store);
$totalRows_cn_store = mysql_num_rows($cn_store);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_commitee_member = "SELECT * FROM committee_member ORDER BY Id ASC";
$cn_commitee_member = mysql_query($query_cn_commitee_member, $cn_tanzi) or die(mysql_error());
$row_cn_commitee_member = mysql_fetch_assoc($cn_commitee_member);
$totalRows_cn_commitee_member = mysql_num_rows($cn_commitee_member);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_Rules = "SELECT * FROM rules ORDER BY Id ASC";
$cn_Rules = mysql_query($query_cn_Rules, $cn_tanzi) or die(mysql_error());
$row_cn_Rules = mysql_fetch_assoc($cn_Rules);
$totalRows_cn_Rules = mysql_num_rows($cn_Rules);
?>
<?php 
$login_id=$_SESSION['MM_Username'];
$sql=mysql_query("SELECT * FROM `member` WHERE `Login_id`=$login_id "); 
$row=mysql_fetch_array($sql);
?>
<?php 
$sql_fitness=mysql_query("SELECT * FROM `property` WHERE `Class`='健身房' && `Project`='1' ORDER BY `Id` ASC LIMIT 5"); 
$row_fitness=mysql_fetch_array($sql_fitness);
?>
<?php 
$sql_play=mysql_query("SELECT * FROM `property` WHERE `Class`='遊樂設施' && `Project`='1' ORDER BY `Id` ASC LIMIT 5"); 
$row_play=mysql_fetch_array($sql_play);
?>
<DOCPYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>社區管理站</title>
          <link href="css/index.css" rel="stylesheet" type="text/css">
        <link href="css/font.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <style>
            
            #wrapper{
                width: 100%;
                margin: 0 auto;
                background-color:cornflowerblue;
                margin-top:0px;
                padding: 32px;
            }
            header{
                background-color: #59pd5d8;
                height: 200px;
                padding: 4px;
            }
			body h4{
				color:white;
				
			}
            header h1{
                text-transform: uppercase;
                text-align: center;
                color:black;
                line-height: 50px;
            }
            header h2{
                font-variant: small-caps;
                text-align: center;
                color:black;
            }
            .main_menu{
                 padding: 5px 0 5px 0;
                text-align: left;
                line-height: 32px;
                width:1160px;
                background-color: #818181;
			}
            ul.main_menu{
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                
                margin-top: -20px;
            }
            .main_menu li{
                
                display:inline-block;
                padding: 0 10px 0 10px;
                font-size: 20px;
            }
            .main_menu a{
                display: block;
                text-decoration: none;
                color: #fff;
                padding: 8px;
                font-variant: small-caps;
                
                -o-transition:.5s;
                -ms-transition:.5s;
                -moz-transition:.5s;
                -webkit-transition:.5s;
                transition:.5s;
            }
            
			 a{
                color: #fff;
            }
            .main_menu a:havor{
                color: #59pd5d8;
            }
        
            li a,dropdown-btn1 ,dropdown-btn2{
                display: inline-block;
                color: #fff;
                text-align: center;
                padding: 18px 22px;
                text-decoration: none;
            }
            li a:hover,.dropdown1:hover,.dropdown-btn1,.dropdown2:hover,.dropdown-btn2{
                
                color:#1ebb90;
            }
            li.dropdown1{
               display: inline-block; 
            }
            li.dropdown2{
               display: inline-block; 
            }
            .dropdown-menu1,.dropdown-menu2{
                display: none;
                position: absolute;
                background-color: #f5f5f5;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
            }
            .dropdown-menu1 a,.dropdown-menu2 a{
                color:grey;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }
            .dropdown-menu1 a:hover,.dropdown-menu2 a:hover{
                background-color:#1ebb90;
                color: #fff;
            }
            .dropdown1:hover  .dropdown-menu1{
                display: block;
            }
            .dropdown2:hover  .dropdown-menu2{
                display: block;
            }
            
            .visitors p{
                text-align: right;
                margin-right: 100px;
            }
             .form1{
                 width: 180px;
                height: 500px;
                text-align: center;
                background-color:cornflowerblue;
                border-radius: 10px;
                margin:0 auto;
                margin-left:70px;
                margin-top: 40px;
            }
			 
			.footerRight p{
				text-align:center;				
			}
			 
            
            #link a:hover{
                background-color: #4d4d4d;
                
            }
            .main_menu a:hover{
                background-color: #4d4d4d;
                
            }
           
            a{
                color: #fff;
            }
			#footer{
				background-color: white;
				
			}
         </style>
         <!-- Google Web Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

		<!-- Font Awesome Version - 4.7.0 -->
		<link href="paradise/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">

		<!-- Bootstrap Style Sheet Version - 3.3.7 -->
		<link href="paradise/css/bootstrap.min.css" rel="stylesheet" media="all">

		<!-- Animation Style Sheet Version - 3.5.2  -->
		<link href="paradise/css/animate.min.css" rel="stylesheet" media="all">

		<!-- Paradise Slider Main Style Sheet -->
		<link href="paradise/css/js_list_051.css" rel="stylesheet" media="all">
        <!-------------------------------------------------------------------------------->
		
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>

		<!-- Font Awesome Version - 4.7.0 -->
		<link href="paradise/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">

		<!-- Bootstrap Style Sheet Version - 3.3.7 -->
		<link href="paradise/css/bootstrap.min.css" rel="stylesheet" media="all">

		<!-- Animation Style Sheet Version - 3.5.2  -->
		<link href="paradise/css/animate.min.css" rel="stylesheet" media="all">

		<!-- Paradise Slider Main Style Sheet -->
		<link href="paradise/css/full_width_images_layers_019.css" rel="stylesheet" media="all">
        
        <!-------------------------------------------------------------------------------->

			<!-- Google Web Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700' rel='stylesheet' type='text/css'>

		<!-- Font Awesome Version - 4.7.0 -->
		<link href="paradise/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">

		<!-- Bootstrap Style Sheet Version - 3.3.7 -->
		<link href="paradise/css/bootstrap.min.css" rel="stylesheet" media="all">

		<!-- Paradise Slider Main Style Sheet -->
		<link href="paradise/css/team_086.css" rel="stylesheet" media="all">
        
        <!------------------------------------------------------------------------------------------------------>   
      <!-- Google Web Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>

		<!-- Font Awesome Version - 4.7.0 -->
		<link href="paradise/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">

		<!-- Bootstrap Style Sheet Version - 3.3.7 -->
		<link href="paradise/css/bootstrap.min.css" rel="stylesheet" media="all">

		<!-- Paradise Slider Main Style Sheet -->
		<link href="paradise/css/x_014_post.css" rel="stylesheet" media="all">

       <!------------------------------------------------------------------------------------------------>    
      
        <link rel="stylesheet" href="assets/styles/main.css">
        

       
   
    </head>
    <body>
    	 
    	
        <div id="wrapper">
            
            <nav>
                <ul class="main_menu">
                    <li><a href="index_member.php">首頁</a></li>
                    <li class="dropdown1"><a class="dropdown-btn1" href="container2_1.php">關於我們</a>
                       
                    </li>
                    <li class="dropdown1"><a class="dropdown-btn1" href="container3_1.php">大樓公告</a>
                       
                    </li>
                    <li><a href="container4_1.php">設施預約</a></li>
                    
                    <li><a href="container5_1.php">維修通報</a></li>
                    <li class="dropdown2"><a class="dropdown-btn2" href="container6_1.php">綜合查詢</a>
                       
                    </li>
                    <li><a href="container7_1.php">留言板</a></li>
                    
                    <li><a href="container8_1.php">投票系統</a></li>
                    <li><a href="container9_1.php">房屋出租刊登</a></li>
                    <li><a href="upload1.php">上傳照片</a></li>
                    <li><a href="login_out.php">登出</a></li>
                </ul>
                <!-- Navbar Links -->
         
            </nav>
             <div id="navbar" class="navbar-collapse collapse page-scroll navbar-left">
            <ul class="nav navbar-nav">
              <li><a href="#home">社區簡介<span class="sr-only"></span></a></li>
              <li><a href="#about">公共設備介紹<span class="sr-only"></span></a></li>
              <li><a href="#services">管委會名單<span class="sr-only"></span></a></li>
              <li><a href="#features">社區公約<span class="sr-only"></span></a></li>
              
            </ul><!-- / .nav .navbar-nav -->              
          </div><!--/.navbar-collapse -->
 			
           <br>       
            <header>
            	<br>
                <h1>歡迎光臨</h1>
                <h2><?php echo $row_cn_Home_footer['Name'];?>&nbsp;公寓社區</h2>

            </header>
             <ul class="nav navbar-nav navbar-right">

                 <h4>歡迎 <?php echo $row['Name'];?> 登入</h4>
                 <h5>離開時請記得登出!</h5>
              </ul><!-- / .nav .navbar-nav .navbar-right -->
      <br><br>
          
             </div>
        
           
            <!-- Paradise Slider -->
	<div id="fw_il_019" class="carousel slide ps_control_bradiustrans swipe_x ps_easeOutQuint" data-ride="carousel" data-pause="hover" data-interval="4000" data-duration="2000">

		<!-- Wrapper For Slides -->
		<div id="home" class="carousel-inner" role="listbox">

			<!-- First Slide -->
			
			<div class="item active">
				
				<!-- row -->
				<div class="row">
					<!-- Image -->
					<div class="col-xs-5">
						<img src="travel\空拍.jpg" alt="fw_il_019_01" data-animation="animated fadeIn" /><!1000*1000>
					</div>
					<!-- Text -->
					<div class="col-xs-6">
						<!-- Slide Text Layer -->
						<div class="fw_il_019_slide">
							<h1 id="#2" >建立社區文化</h1>
							<h1 id="#2" >凝聚社區共識</h1>
							
							<h1 id="#2" >建構社區生命共同體的概念</h1>
							
							
					  </div> <!-- /fw_il_019_slide -->
					</div>
				</div> <!-- /row -->
				
			</div>
			 
			<!-- End of Slide -->
            			<!-- Second Slide -->
            			<?php do { ?>
			              <div class="item">
			                <!-- row -->
			                <div class="row">
			                  <!-- Image -->
			                  <div class="col-xs-5"> <img src="travel\<?php echo $row_cn_social_introduction['Img']; ?>" alt="fw_il_019_02" data-animation="animated fadeIn" /> </div>
			                  <!-- Text -->
			                  <div class="col-xs-6">
			                    <!-- Slide Text Layer -->
			                    <div class="fw_il_019_slide fw_il_019_slide_center">
			                      <h1><?php echo $row_cn_social_introduction['Title']?></h1>
			                      <p><?php echo $row_cn_social_introduction['Article']; ?></p>
		                        </div>
			                    <!-- /fw_il_019_slide -->
		                      </div>
		                    </div>
			                <!-- /row -->
		                </div>
			             <?php } while ($row_cn_social_introduction = mysql_fetch_assoc($cn_social_introduction)); ?>


			

		</div> <!-- End of Wrapper For Slides -->
		
		<!-- Left Control -->
		<a class="left carousel-control" href="#fw_il_019" role="button" data-slide="prev">
			<span class="fa fa-long-arrow-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>

		<!-- Right Control -->
		<a class="right carousel-control" href="#fw_il_019" role="button" data-slide="next">
			<span class="fa fa-long-arrow-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>

	</div> <!-- End Paradise Slider -->
    <!----------------------------------------------------------------------------------------------------------->
    
     <div class="row hidden-xs hidden-sm">
 	<div class="col-xs-12"><h2 class="title_border"><strong>附近商家</strong></h2></div>
    <?php do { ?>
    <div class="col-xs-6 col-sm-4 col-md-2">
    	<img class="img-thumbnail" src="store_img/<?php echo $row_cn_store['Img']; ?>" title="<?php echo $row_cn_store['Name']; ?>" alt="<?php echo $row_cn_store['Name']; ?>"/>
        <p class="text-center title_caption"><strong><a href="#" title="<?php echo $row_cn_store['Name']; ?>"><?php echo $row_cn_store['Name']; ?></a></strong></p>
    
    </div>
     <?php } while ($row_cn_store = mysql_fetch_assoc($cn_store)); ?>
   
    
   
    
 </div>      
    <!------------------------------------------------------------------------------------------------------->
    	<!-- Paradise Slider -->
	<div id="js_list_051" class="carousel slide ps_indicators_square_dots ps_control_square_txt thumb_scroll_x swipe_x ps_slowSpeedy" data-ride="carousel" data-pause="hover" data-interval="3000" data-duration="2000">

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#js_list_051" data-slide-to="0" class="active"></li>
			<li data-target="#js_list_051" data-slide-to="1"></li>
			<li data-target="#js_list_051" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper For Slides -->
		<div id="about" class="carousel-inner" role="listbox">
			<div class="item active">
				<!-- Slide Background -->
				<img src="travel\公共設備.jpg" alt="js_list_051_01" />
                <!1732*1155>
				<!-- List Layer -->
				<div class="js_list_simple">
					<h1 data-animation="animated fadeInRight">公共設備簡介</h1> <!-- Heading -->
					
					 <!-- Buttton -->
				</div><!-- /List Layer -->
			</div><!-- /item -->
			<!-- First Slide -->
			<div class="item">
				<!-- Slide Background -->
				<img src="travel\<?php echo $row_fitness['Class_picture']?>" alt="社區健身房" />
                <!1732*1155>
				<!-- List Layer -->
				<div class="js_list_simple">
					<h1 data-animation="animated fadeInRight">健身房</h1> <!-- Heading -->
					<ul> <!-- List -->
						<?php do {?>
						<li data-animation="animated fadeInRight"><?php echo $row_fitness['Name']?></li>
						<?php } while ($row_fitness=mysql_fetch_array($sql_fitness)) ;?>
					</ul>
					 <!-- Buttton -->
				</div><!-- /List Layer -->
			</div><!-- /item -->
			
			<div class="item">
				<!-- Slide Background -->
				<img src="travel\<?php echo $row_play['Class_picture']?>" alt="社區遊樂設施" />
                <!1732*1155>
				<!-- List Layer -->
				<div class="js_list_simple js_list_simple_right">
					<h1 data-animation="animated fadeInLeft">遊樂設施</h1> <!-- Heading -->
					<ul> <!-- List -->
						<?php do {?>
						<li data-animation="animated fadeInLeft"><?php echo $row_play['Name']?></li>
						<?php } while ($row_play=mysql_fetch_array($sql_play)) ;?>
					</ul>
					 <!-- Buttton -->
				</div><!-- /List Layer -->
			</div><!-- /item -->


		</div><!-- End of Wrapper For Slides -->

		<!-- Left Control -->
		<a class="left carousel-control" href="#js_list_051" role="button" data-slide="prev">
			<span class="fa fa-long-arrow-left" aria-hidden="true"><span>pre</span></span>
			<span class="sr-only">Previous</span>
		</a>

		<!-- Right Control -->
		<a class="right carousel-control" href="#js_list_051" role="button" data-slide="next">
			<span class="fa fa-long-arrow-right" aria-hidden="true"><span>nex</span></span>
			<span class="sr-only">Next</span>
		</a>

	</div> <!-- End Paradise Slider -->   
    
        <!-------------------------------------------------------------------------------------------------------->
       
   		<!-- Paradise Slider -->
	<div id="team_086_mov_1_col_4" class="carousel slide team_086 team_086_control_button four_coloumns swipe_x ps_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">

		<!-- Header of Slider -->
		<div id="services"class="team_086_header">
			<h1>社區管理委員會主要幹部</h1>
		</div>
		<!-- /Header of Slider -->
		
		<!-- Wrapper For Slides -->
		

			<!-- 1st Box -->
			<?php do { ?>
			<div class="item ">
				<div class="col-xs-12 col-sm-6 col-md-3 team_086_grid"> <!-- Grid -->
					<div class="team_086_wrapper"> <!-- Wrapper -->

						<!-- Image -->
						<img src="travel/<?php echo $row_cn_commitee_member['Img']; ?>" alt="team_086_01">
						 <!-- Text Content -->
						<div class="team_086_content team_086_content_col_4">
							<h5>姓名:<?php echo $row_cn_commitee_member['Name']; ?></h5>
							<h6><?php echo $row_cn_commitee_member['Office']; ?></h6>
						</div> <!-- /Text Content -->

					</div> <!-- /.team_086_wrapper -->
				</div> <!-- /.team_086_grid -->
			</div> <!-- /item -->
			<!-- End of 1st Box -->
			<?php } while ($row_cn_commitee_member = mysql_fetch_assoc($cn_commitee_member)); ?>
			
			
		 <!-- End of Wrapper For Slides -->
			
		
	</div> <!-- End Paradise Slider -->


	<!-------------------------------------------------------------------------------------------------------------
	<!--------------------------------------------------------------------------------------------------->
	
	
	
        <section id="features" class="container ft-steps-numbers">
            <div >
				<br><br>
              <header class="sec-heading ws-s">
                <h1>我們的社區公約</h1>
                <h2><span class="subheading">人人遵守，社區變得更美麗</span></h2>
              </header>
              
              <?php $i=1; do {?>
              
              <!-- Step 1 -->
              <div class="col-lg-4 col-md-6 mb-sm-100 ft-item wow fadeIn" data-wow-duration="1s">
               
                <span class="ft-nbr"><?php echo $i; $i=$i+1;?></span>
                <h3><?php echo $row_cn_Rules['Title']; ?></h3>
                <p><?php echo $row_cn_Rules['Article']; ?></p>
                <br><br><br><br>
                
              </div>
                
				<?php } while ($row_cn_Rules = mysql_fetch_assoc($cn_Rules)); ?>
                
            </div><!-- / .row -->
          
        </section><!-- / .container -->


<div id="footer">
        <footer>
        	<br><br>
 <div class="row" id="footer">
	
    <section id="subnav">
    	<ul class="list-inline text-center small">
            <li><strong><a title="其他連結">其他連結</a></strong></li>
    		<li><strong><a title="聯絡我們">聯絡我們</a></strong></li>
   	 		<li><strong><a title="隱私政策">隱私政策</a></strong></li>
    		<li><strong><a title="優良評鑑">優良評鑑</a></strong></li>
        </ul>
    </section>
    
    <section id="social">
    	  <div class="footerRight">
                <p>社區名稱：<?php echo $row_cn_Home_footer['Name']; ?>社區</p>
		        <p>聯絡電話：<?php echo $row_cn_Home_footer['Phone']; ?></p>
		        <p>Email：<?php echo $row_cn_Home_footer['E_mail']; ?></p>
		        <p>地址：<?php echo $row_cn_Home_footer['Address']; ?></p>
		        
		        
	        </div>
	
	        <div class="visitors">
		        
	        </div>
    	<ul class="list-inline text-center" id="link">
        	<li><a href="https://www.facebook.com/"><img src="svg/facebook.svg" width="80px" title="facebook" alt="facebook"></a></li>
            <li><a href="https://tw.yahoo.com/"><img src="svg/yahoo.png" width="80px" title="yahoo" alt="yahoo"></a></li>
            <li><a href="https://www.youtube.com/"><img src="svg/youtube.svg" width="80px" title="youtube" alt="youtube"></a></li>
            <li><a href="https://www.instagram.com/"><img src="svg/instagram.svg" width="80px" title="instagram" alt="instagram"></a></li>
        </ul>
    </section>
    
    <section>
    	  
    	<div class="col-xs-12 text-center small" id="copyright">
    		Copyright © 2017 &nbsp;<?php echo $row_cn_Home_footer['Name']; ?>社區. &nbsp;All rights reserved.
    		&nbsp;網站圖片皆為專題使用，非使用在商業用途上!
    	</div>
	</section>
 </div>

	        
	      
	            <br class="CLEAR">
        </footer>
        </div>
   <!-- jQuery Version - 3.2.1 -->
	<script src="paradise/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap JS File Version - 3.3.7 -->
	<script src="paradise/js/bootstrap.min.js"></script>

	<!-- Touch Swipe JS File Version - 1.6.18 -->
	<script src="paradise/js/jquery.touchSwipe.min.js"></script>

	<!-- Paradise Slider Main JS File -->
	<script src="paradise/js/paradise_slider_min.js"></script>
    <!---------------------------------------------------------------------------->
  


    
    <!-- ========== Scripts ========== -->
        <script src="assets/js/vendor/jquery.easing.js"></script>
        <script src="assets/js/vendor/jquery.localScroll.min.js"></script>
        <script src="assets/js/vendor/jquery.scrollTo.min.js"></script>
        <script src="assets/js/main.js"></script>
   
    </body>
</html>
<?php
mysql_free_result($cn_Home_footer);

mysql_free_result($cn_social_introduction);

mysql_free_result($cn_store);

mysql_free_result($cn_commitee_member);
?>
<?php
mysql_free_result($cn_Rules);
?>