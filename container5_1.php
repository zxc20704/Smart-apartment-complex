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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fix_add")) {
  $insertSQL = sprintf("INSERT INTO fix (Name, Location, `Date`, Detail, Member) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Detail'], "text"),
                       GetSQLValueString($_SESSION['MM_Username'], "text"));

  mysql_select_db($database_cn_tanzi, $cn_tanzi);
  $Result1 = mysql_query($insertSQL, $cn_tanzi) or die(mysql_error());

  $insertGoTo = "container5_1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_cn_admin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_cn_admin = $_SESSION['MM_Username'];
}
mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_admin = sprintf("SELECT * FROM `admin` WHERE Login_id = %s", GetSQLValueString($colname_cn_admin, "text"));
$cn_admin = mysql_query($query_cn_admin, $cn_tanzi) or die(mysql_error());
$row_cn_admin = mysql_fetch_assoc($cn_admin);
$totalRows_cn_admin = mysql_num_rows($cn_admin);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_home_footer = "SELECT * FROM home_footer";
$cn_home_footer = mysql_query($query_cn_home_footer, $cn_tanzi) or die(mysql_error());
$row_cn_home_footer = mysql_fetch_assoc($cn_home_footer);
$totalRows_cn_home_footer = mysql_num_rows($cn_home_footer);
?>
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
?>
<?php 
$login_id=$_SESSION['MM_Username'];
$sql=mysql_query("SELECT * FROM `member` WHERE `Login_id`=$login_id "); 
$row=mysql_fetch_array($sql);
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
            body{
                background:url(travel/背景_3.jpg);
            }
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
            a{
                color: #fff;
            }
			body h4{
				color:white;
				
			}
			#footer{
				background-color: white;
				
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
        
           
        
    <!----------------------------------------------------------------------------------------------------------->
    		<br><br>
    		<h1>&nbsp;&nbsp;&nbsp;&nbsp;公物維修</h1>
				 
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;為維護社區的生活品質，請大家同心協力!</h2>
            <br><br><br><br>
             <form action="<?php echo $editFormAction; ?>" id="fix_add" name="fix_add" method="POST">
             <div class="row ws-m">
              <div class="col-md-offset-2 col-md-4">
                <!-- Name -->
                <div class="form-group">
                  <p value="<?php echo $row['Login_id'];?>" type="text" class="form-control" name="Member" id="Member" ><?php echo $row['Login_id'];?></p>
                  <label for="inpt-pass-forms">通報帳號</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Name" id="Name" placeholder="物品名稱">
                  <label for="inpt-name-forms">維修項目</label>
                </div>
                <!-- Email -->
                <div class="form-group">
                  <input type="text" class="form-control" name="Location" id="Location" placeholder="大略位置">
                  <label for="inpt-email-forms">需維修物品位置</label>
                </div>
                <!-- Password -->
                
              </div><!-- / .col-md-4 -->

              <div class="col-md-4">
                <!-- Textarea -->
                <div class="form-group">
                  <textarea class="form-control" name="Detail" id="Detail" rows="9" placeholder="大略描述物品損壞狀況"></textarea>
                  <label for="txt-forms">細節</label>
                </div> 
              </div><!-- / .col-md-4 -->
              <div class="col-md-offset-9 col-md-4">
                  <input type="submit" value="送出" name="submit" id="submit" class="btn">
                  <input name="Date" type="hidden" id="Date" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
             <input type="hidden" name="MM_insert" value="fix_add">
             <br><br><br><br>
            </form>
         
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






?>
<?php

?>