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

$maxRows_cn_House = 5;
$pageNum_cn_House = 0;
if (isset($_GET['pageNum_cn_House'])) {
  $pageNum_cn_House = $_GET['pageNum_cn_House'];
}
$startRow_cn_House = $pageNum_cn_House * $maxRows_cn_House;

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_House = "SELECT * FROM house ORDER BY Id DESC";
$query_limit_cn_House = sprintf("%s LIMIT %d, %d", $query_cn_House, $startRow_cn_House, $maxRows_cn_House);
$cn_House = mysql_query($query_limit_cn_House, $cn_tanzi) or die(mysql_error());
$row_cn_House = mysql_fetch_assoc($cn_House);

if (isset($_GET['totalRows_cn_House'])) {
  $totalRows_cn_House = $_GET['totalRows_cn_House'];
} else {
  $all_cn_House = mysql_query($query_cn_House);
  $totalRows_cn_House = mysql_num_rows($all_cn_House);
}
$totalPages_cn_House = ceil($totalRows_cn_House/$maxRows_cn_House)-1;

$maxRows_cn_Thing = 5;
$pageNum_cn_Thing = 0;
if (isset($_GET['pageNum_cn_Thing'])) {
  $pageNum_cn_Thing = $_GET['pageNum_cn_Thing'];
}
$startRow_cn_Thing = $pageNum_cn_Thing * $maxRows_cn_Thing;

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_Thing = "SELECT * FROM thing ORDER BY Id DESC";
$query_limit_cn_Thing = sprintf("%s LIMIT %d, %d", $query_cn_Thing, $startRow_cn_Thing, $maxRows_cn_Thing);
$cn_Thing = mysql_query($query_limit_cn_Thing, $cn_tanzi) or die(mysql_error());
$row_cn_Thing = mysql_fetch_assoc($cn_Thing);

if (isset($_GET['totalRows_cn_Thing'])) {
  $totalRows_cn_Thing = $_GET['totalRows_cn_Thing'];
} else {
  $all_cn_Thing = mysql_query($query_cn_Thing);
  $totalRows_cn_Thing = mysql_num_rows($all_cn_Thing);
}
$totalPages_cn_Thing = ceil($totalRows_cn_Thing/$maxRows_cn_Thing)-1;

$maxRows_cn_Home_img = 4;
$pageNum_cn_Home_img = 0;
if (isset($_GET['pageNum_cn_Home_img'])) {
  $pageNum_cn_Home_img = $_GET['pageNum_cn_Home_img'];
}
$startRow_cn_Home_img = $pageNum_cn_Home_img * $maxRows_cn_Home_img;

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_Home_img = "SELECT * FROM home_img ORDER BY Id ASC";
$query_limit_cn_Home_img = sprintf("%s LIMIT %d, %d", $query_cn_Home_img, $startRow_cn_Home_img, $maxRows_cn_Home_img);
$cn_Home_img = mysql_query($query_limit_cn_Home_img, $cn_tanzi) or die(mysql_error());
$row_cn_Home_img = mysql_fetch_assoc($cn_Home_img);

if (isset($_GET['totalRows_cn_Home_img'])) {
  $totalRows_cn_Home_img = $_GET['totalRows_cn_Home_img'];
} else {
  $all_cn_Home_img = mysql_query($query_cn_Home_img);
  $totalRows_cn_Home_img = mysql_num_rows($all_cn_Home_img);
}
$totalPages_cn_Home_img = ceil($totalRows_cn_Home_img/$maxRows_cn_Home_img)-1;

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_Home_footer = "SELECT * FROM home_footer";
$cn_Home_footer = mysql_query($query_cn_Home_footer, $cn_tanzi) or die(mysql_error());
$row_cn_Home_footer = mysql_fetch_assoc($cn_Home_footer);
$totalRows_cn_Home_footer = mysql_num_rows($cn_Home_footer);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_member = "SELECT * FROM member";
$cn_member = mysql_query($query_cn_member, $cn_tanzi) or die(mysql_error());
$row_cn_member = mysql_fetch_assoc($cn_member);
$totalRows_cn_member = mysql_num_rows($cn_member);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Login_id'])) {
  $loginUsername=$_POST['Login_id'];
  $password=$_POST['Passward'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index_member.php?Login_id=$_POST[Login_id]";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cn_tanzi, $cn_tanzi);
  
  $LoginRS__query=sprintf("SELECT Login_id, Passward FROM member WHERE Login_id=%s AND Passward=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $cn_tanzi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php 
$login_id=$_SESSION['MM_Username'];
$sql=mysql_query("SELECT * FROM `member` WHERE `Login_id`=$login_id "); 
$row=mysql_fetch_array($sql);
$_SESSION['Login_id']=$row['Login_id'];
$_SESSION['Name']=$row['Name'];
?>
<?php
   if(isset($_GET['Go_home'])){
        unset($_SESSION['looking']);
		unset($_SESSION['looking_num']);

		echo "<script>alert('謝謝光臨，歡迎下次再來'); location.href='index_member.php';</script>";	
       }
    ?>
<?php
$sql_show=mysql_query("SELECT * FROM `house` WHERE `Project`='1' "); 
$row_show=mysql_fetch_array($sql_show)or die(mysql_error());
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
                background-color: #f3f3f3;
                margin-top: -100px;
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
                color:cadetblue;
                line-height: 50px;
            }
            header h2{
                font-variant: small-caps;
                text-align: center;
                color:cadetblue;
               
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
                
                margin-top: 80px;
            }
            .main_menu li{
                
                display: inline-block;
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
            .main_menu a:havor{
                color: #59pd5d8;
            }
             
            .container{
                width: 30%;
                height: 500px;
                text-align: center;
                background-color:rgba(52,73,94,0.7);
                border-radius: 4px;
                margin-right: 6%;
                margin-top: 40px;
				margin-left: 65%
				
                
            }
            .table{
                width:70%;
				position: relative;
                
            }
            .container img{
                width: 100px;
                height: 100px;
                margin-top: 30px;
                margin-bottom: 30px;
				position: relative;
            }
            input[type="text"],input[type="password"]{
                height: 45px;
                width: 100%;
                font-size: 18px;
                border: none;
                margin-bottom: 20px;
                border-radius: 4px;
                background-color: #fff;
                padding-left: 30px;
            }
            
           
            a{
                color: #fff;
            }
            li a,dropdown-btn1 ,dropdown-btn2{
                display: inline-block;
                color: #fff;
                text-align: center;
                padding: 18px 22px;
                text-decoration: none;
            }
            li a:hover,.dropdown1:hover,.dropdown-btn1,.dropdown2:hover,.dropdown-btn2{
                
                color: #1ebb90;
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
                color: grey;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }
            .dropdown-menu1 a:hover,.dropdown-menu2 a:hover{
                background-color: #1ebb90;
                color: #fff;
            }
            .dropdown1:hover  .dropdown-menu1{
                display: block;
            }
            .dropdown2:hover  .dropdown-menu2{
                display: block;
            }
            
            .footerRight p{
                text-align: center;
            }
            .visitors p{
                text-align: right;
                margin-right: 100px;
            }
            .newstable2 {
                width: 98%;   
             	
            }
            .form-house{
                 width: 130%;
                height: 320px;
                text-align: center;
                background-color:darkkhaki;
                border-radius: 100px;
                margin-left: 30px;
                margin-top: -500px;
            }
        
            form{
                border-collapse: collapse;
            }
            table th{
                text-align: left;
                background-color: #3a6070;
                color: #fff;
                padding: 4px 30px 4px 8px;
            }
            table td{
                border: 1px solid #e3e3e3;
                padding: 4px 8px;
            }
            table tr:nth-child(odd) td{
                background-color:darkgrey;
            }
            .titleMore a{
                margin-left: 75%;
               
            }
            .form-thing{
                 width: 130%;
                height: 320px;
                text-align: center;
                background-color:cornflowerblue;
                border-radius: 100px;
                margin:0 auto;
                margin-left: 30px;
                
                margin-top: 50px;
            }
             .newstable {
                width: 100%;
                
                position: relative;
            }
           .titleMore1 a{
                margin-left: 75%;
               
            }
			#link a:hover{
				background-color: #4d4d4d;
			}
			#aside{
				
				margin-left:3%;
				width: 40%;
				
			}
			.forumTable{
				width:90%;
				
			}
       
			
		</style>
           
        
		
    </head>
    <body>
        
        <div id="wrapper">
            
            <nav>
                 <ul class="main_menu">
                    <li><a href="index_member.php">首頁</a></li>
                    <li class="dropdown1"><a class="dropdown-btn1" href="container2_1.php">關於我們</a>
                       <div class="dropdown-menu1">
                            <a href="#">社區簡介</a>
                            <a href="#">公共設施介紹</a>
                            <a href="#">管委會名單</a>
                            <a href="#">社區公約</a>
                        </div>
                    </li>
                    <li class="dropdown1"><a class="dropdown-btn1" href="container3_1.php">大樓公告</a>
                       <div class="dropdown-menu1">
                            <a href="#">公告訊息</a>
                            <a href="#">社區行事曆</a>
                        </div>
                    </li>
                    <li><a href="container4_1.php">設施預約</a></li>
                    
                    <li><a href="container5_1.php">維修通報</a></li>
                    <li class="dropdown2"><a class="dropdown-btn2" href="container6_1.php">綜合查詢</a>
                       <div class="dropdown-menu2">
                            <a href="#">郵件、包裹查詢</a>
                      
                            <a href="#">管理費查詢</a>
                        </div>
                    </li>
                    <li><a href="container7_1.php">留言板</a></li>
                    
                    <li><a href="container8_1.php">投票系統</a></li>
                    <li><a href="container9_1.php">房屋出租刊登</a></li>
                    <li><a href="upload1.php">上傳照片</a></li>  
                    <li><a href="login_out.php">登出</a></li>
                </ul>
                
            </nav>
           
            <br><br>
            <header>
                <h1>歡迎光臨</h1>
                <h2><?php echo $row_cn_Home_footer['Name'];?>&nbsp;公寓社區</h2>
            </header>
            <br>  
     
        </div>
         
</div>
		 
   

<!-----------------------圖片輪播--開始---------------------------->

<div class="row hidden-xs hidden-sm ">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  
	<div align="center" class="item active">
      <img src="travel/智慧社區.jpg" alt="智慧社區">
      <div class="carousel-caption">
        ...
      </div>
    </div>  
    <?php do { ?>
      <div align="center" class="item "> <img src="travel/<?php echo $row_cn_Home_img['Img']; ?>" alt="<?php echo $row_cn_Home_img['Img_name']; ?>">
        <div class="carousel-caption"> ... </div>
      </div>
      <?php } while ($row_cn_Home_img = mysql_fetch_assoc($cn_Home_img)); ?>
    
    
    
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
        <div class="container">
           <img src="travel/10.jpg">
           
           
         
            <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" id="login1">
                <br>
                <h2>住戶<a><?php echo $_SESSION['Login_id'];?></a>成功登入</h2>
                <br>
                <h2>歡迎<a><?php echo $_SESSION['Name'];?></a>回來</h2>
                <br>
                <h3>『離開時，請記得登出!』</h3>
               
            </form>
            
        </div>
       <div id="aside" class="row hidden-xs hidden-sm" >
        <div class="form-house" >
          
           <br>
            <h1>房屋租售公佈欄</h1>
            <div class="newstable2" align="center">
			
                <table class="forumTable">
                   
                    <tr>
                      <th width="250">房屋名稱</th>
                      <th width="77">坪數</th>
                      <th width="77">價格</th>
                      <th width="165">日期</th>
                      
                  </tr>
                    <?php do { ?>
                    <tr>
                      <td><?php echo $row_show['Title']; ?></td>
                      <td><?php echo $row_show['Pings']; ?></td>
                      <td><?php echo $row_show['Price']; ?></td>
                      <td><?php echo $row_show['Date']; ?></td>
                    </tr>
                    <?php } while ($row_show=mysql_fetch_array($sql_show)); ?>
                    
                </table>
                  
<br>
             <span class="titleMore"><a href="index_house.php">More</a></span>
          </div>
              
         
        </div>
        
        <div class="form-thing" >
           <br>
            <h1>公佈欄</h1>
            <div class="newstable" align="center">
				
				
               
                <table class="forumTable">
                    <tr>
                      <th width="77">事項</th>
                      <th width="77">日期</th>
                      <th width="370">備註</th>
                      
                      
                   
                    <?php do { ?>
                    <tr>
                      <td><?php echo $row_cn_Thing['Title']; ?></td>
                      <td><?php echo $row_cn_Thing['Date']; ?></td>
                      <td><?php echo $row_cn_Thing['Thing']; ?></td>
                      
                    </tr>
                    <?php } while ($row_cn_Thing = mysql_fetch_assoc($cn_Thing)); ?>
                    
                    
              </table>
                  
<br>
             <span class="titleMore1"><a href="container3_1.php">More</a></span>
          </div>
              

        </div>
</div>
         <footer>
        <br><br><br><br>		
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
    <script src="assets/lib/jquery/jquery.js"></script>

    <!--Bootstrap -->
    <script src="assets/lib/bootstrap/js/bootstrap.js"></script>


    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('.list-inline li > a').click(function() {
                    var activeForm = $(this).attr('href') + ' > form';
                    //console.log(activeForm);
                    $(activeForm).addClass('animated fadeIn');
                    //set timer to 1 seconds, after that, unload the animate animation
                    setTimeout(function() {
                        $(activeForm).removeClass('animated fadeIn');
                    }, 1000);
                });
            });
        })(jQuery);
    </script>  
</body>
</html>
<?php
mysql_free_result($cn_House);

mysql_free_result($cn_Thing);

mysql_free_result($cn_Home_img);

mysql_free_result($cn_Home_footer);

mysql_free_result($cn_member);
?>
