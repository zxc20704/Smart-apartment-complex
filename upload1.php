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
      ---------------------------------------------------------------------------
        <form action="upload1.php" method="post" enctype="multipart/form-data">
                <table width="70%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                   
                    請選取要上傳的檔案:<br/>
                    <tr>  
                        <input type="file" name="fileUpload" /><br />
                        <input type="submit" value="送出資料" />  
                    </tr> 
               
                     
                  </tbody>
                </table>
                   </form>
                        
                        

<?php 
                        
                        

                        
                        
                        $name =iconv("UTF-8","BIG-5",$_FILES["fileUpload"]["name"]);
                        $type =$_FILES["fileUpload"]["type"];
                        $size =$_FILES["fileUpload"]["size"];
                        $tmp_name =$_FILES["fileUpload"]["tmp_name"];
                        $space="-";
                        
                      if($_FILES["fileUpload"]["error"]==0){
                          if(move_uploaded_file($tmp_name,"./admin/public/01/".$login_id.$space.$name)){
                              $sizekb=round($size/1024,2);
                              
                              $chi_name=iconv("BIG-5","UTF-8",$name);
                              echo "上傳成功<br/>";
                              echo "檔案名稱:".$login_id.$space.$chi_name."<br />";
                              echo "檔案類型:".$type."<br />";
                              echo "檔案大小:".$sizekb."KB<br />";
                              
                              
                              
                          }else{
                              echo "檔案未上傳，請重新上傳動作";
                              echo "<a href='javascript:window.history.back();'>回上一頁</a>";
                              
                          }
                          
                      }
                
                        
                $nowdate = date( 'Y-m-d H:i:s'); 
                $conn = mysql_connect("127.0.0.1", "root","s10423560912"); 
                mysql_select_db("tanzi",$conn); 
                mysql_query("Insert Into member_photo(Login_id,Img_name) Values ('$login_id','$login_id-$name')"); 
                 
                
                ?>
                   --------------------------------------------------
           
            
	
	
	
      

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

    
                   
               