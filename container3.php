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

$maxRows_cn_thing = 9;
$pageNum_cn_thing = 0;
if (isset($_GET['pageNum_cn_thing'])) {
  $pageNum_cn_thing = $_GET['pageNum_cn_thing'];
}
$startRow_cn_thing = $pageNum_cn_thing * $maxRows_cn_thing;

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_thing = "SELECT * FROM thing ORDER BY Id DESC";
$query_limit_cn_thing = sprintf("%s LIMIT %d, %d", $query_cn_thing, $startRow_cn_thing, $maxRows_cn_thing);
$cn_thing = mysql_query($query_limit_cn_thing, $cn_tanzi) or die(mysql_error());
$row_cn_thing = mysql_fetch_assoc($cn_thing);

if (isset($_GET['totalRows_cn_thing'])) {
  $totalRows_cn_thing = $_GET['totalRows_cn_thing'];
} else {
  $all_cn_thing = mysql_query($query_cn_thing);
  $totalRows_cn_thing = mysql_num_rows($all_cn_thing);
}
$totalPages_cn_thing = ceil($totalRows_cn_thing/$maxRows_cn_thing)-1;
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
                width:1215px;
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
            .main_menu a:hover{
                background-color: #4d4d4d;
                
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
			 
            
            a{
                color: #fff;
            }
			#footer{
				background-color: white;
				
			}
			#link a:hover{
                background-color: #4d4d4d;
                
            }
         </style>
         <!-- Google Web Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
		
		
        <!-------------------------------------------------------------------------------->
	    
        <!-------------------------------------------------------------------------------->

		
        
        <!------------------------------------------------------------------------------------------------------>   
  

       <!------------------------------------------------------------------------------------------------>    
      
        <link rel="stylesheet" href="assets/styles/main.css">
        

       
   
    </head>
    <body>
    	 
    	
        <div id="wrapper">
            
            <nav>
                <ul class="main_menu">
                    <li><a href="index.php">首頁</a></li>
                    <li class="dropdown1"><a class="dropdown-btn1" href="container2.php">關於我們</a>
                       
                    </li>
                    <li class="dropdown1"><a class="dropdown-btn1" href="container3.php">大樓公告</a>
                       
                    </li>
                    <li><a href="#">設施預約</a></li>
                    
                    <li><a href="#">維修通報</a></li>
                    <li class="dropdown2"><a class="dropdown-btn2" href="#">綜合查詢</a>
                       
                    </li>
                    <li><a href="#">留言板</a></li>
                    
                    <li><a href="#">投票系統</a></li>
                    <li><a href="#">房屋出租刊登</a></li>
                    <li><a href="#">上傳照片</a></li>
                    <li><a href="login-1.php">管理員登入</a></li>
                </ul>
                <!-- Navbar Links -->
         
            </nav>
             <div id="navbar" class="navbar-collapse collapse page-scroll navbar-left">
            <ul class="nav navbar-nav">
              <li><a href="#message">公告訊息<span class="sr-only"></span></a></li>
              <li><a href="#calendar">社區行事曆<span class="sr-only"></span></a></li>
              
              
            </ul><!-- / .nav .navbar-nav -->              
          </div><!--/.navbar-collapse -->
        </nav><!-- / .navbar -->
           <br>       
            <header>
            	<br>
                <h1>歡迎光臨</h1>
                <h2><?php echo $row_cn_Home_footer['Name'];?>&nbsp;公寓社區</h2>

            </header>
            <br><br>
		 </div>
          
          <section class="container testimonials-3col" id="message">
			  <br><br><br>
            

              
                <h1>公告訊息</h1>
				 
                <h2><span class="subheading">社區重要通知，請務必密切注意!</span></h2>
              
				<br>              
              <?php do { ?>
              <div class="col-md-4 mb-sm-50">
                <div class="t-item wow fadeIn" data-wow-duration="1s">
                  <img src="travel/訊息.png" alt="Testimonial">
                  <blockquote>
                    <p><?php echo $row_cn_thing['Detail']; ?></p>
                   <br>
                      <cite><?php echo $row_cn_thing['Title']; ?></cite>
                      <h6><?php echo $row_cn_thing['Date']; ?></h6>
                  </blockquote>
                  <span class="et-quote t-icon"></span>
                </div><!-- / .t-item -->
                <br><br>
              </div><!-- / .col-md-4 -->
              <?php } while ($row_cn_thing = mysql_fetch_assoc($cn_thing)); ?>
             
          </section><!-- / .container -->
 
    <!----------------------------------------------------------------------------------------------------------->
     
     <div id="calendar" class="container testimonials-3col">
     <br><br>
      <div class="from-header">
        <h1>社區行事曆</h1>
        <h3><p>讓大家更能了解社區動態消息</p></h3>
        <br>
      </div>
      <iframe src="https://calendar.google.com/calendar/embed?src=q8e9se1lq42o4ds0chk586c580%40group.calendar.google.com&ctz=Asia/Taipei" style="border: 0" width=100% height=100% frameborder="0" scrolling="no"></iframe>
      <br><br><br><br><br><br>
     </div> 
     
    <!------------------------------------------------------------------------------------------------------->
     


        
    <!-------------------------------------------------------------------------------------------------------->
       
   	


	<!-------------------------------------------------------------------------------------------------------------
	<!--------------------------------------------------------------------------------------------------->
	


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
    	<ul class="list-inline text-center">
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
     <!----------------------------------------------------------------------------------------------------------> 
       


            
    </body>
</html>
<?php
mysql_free_result($cn_Home_footer);
?>
<?php
mysql_free_result($cn_thing);
?>