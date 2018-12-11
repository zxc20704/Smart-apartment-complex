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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_BoardRec = 8;
$pageNum_BoardRec = 0;
if (isset($_GET['pageNum_BoardRec'])) {
  $pageNum_BoardRec = $_GET['pageNum_BoardRec'];
}
$startRow_BoardRec = $pageNum_BoardRec * $maxRows_BoardRec;

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_BoardRec = "SELECT * FROM board_main ORDER BY postdate DESC";
$query_limit_BoardRec = sprintf("%s LIMIT %d, %d", $query_BoardRec, $startRow_BoardRec, $maxRows_BoardRec);
$BoardRec = mysql_query($query_limit_BoardRec, $cn_tanzi) or die(mysql_error());
$row_BoardRec = mysql_fetch_assoc($BoardRec);

if (isset($_GET['totalRows_BoardRec'])) {
  $totalRows_BoardRec = $_GET['totalRows_BoardRec'];
} else {
  $all_BoardRec = mysql_query($query_BoardRec);
  $totalRows_BoardRec = mysql_num_rows($all_BoardRec);
}
$totalPages_BoardRec = ceil($totalRows_BoardRec/$maxRows_BoardRec)-1;

$queryString_BoardRec = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_BoardRec") == false && 
        stristr($param, "totalRows_BoardRec") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_BoardRec = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_BoardRec = sprintf("&totalRows_BoardRec=%d%s", $totalRows_BoardRec, $queryString_BoardRec);
?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO board_main (subject, name, email, face, content) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['face'], "text"),
                       GetSQLValueString($_POST['content'], "text"));

  mysql_select_db($database_cn_tanzi, $cn_tanzi);
  $Result1 = mysql_query($insertSQL, $cn_tanzi) or die(mysql_error());

  $insertGoTo = "container7_1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


?>
<?php


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
                background:url(travel/背景_8.jpg);
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
        
           
     <br><br><br><br> 
     <!---------------------------------------------------------------------------------------------------->
     <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" id="msg">
     
  <tr>
    <td><br /><table width="750" border="0" cellpadding="0" cellspacing="0">
      <h1>留言區:</h1>
      <tr>
        
        <td width="100%" align="center" valign="middle" bgcolor="#EEF2F7"><form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" onSubmit="MM_validateForm('subject','','R');MM_validateForm('name','','R');MM_validateForm('content','','R');MM_validateForm('email','','RisEmail');return document.MM_returnValue">
          <table width="100%" border="01" cellspacing="2" cellpadding="0" >
            <tr>
              <td bgcolor="#b3d9ff"><div align="right">標題</div></td>
              <td bgcolor="#b3d9ff">
                <div align="left">
                  <input name="subject" type="text" id="subject" size="30" />
                  </div>
              </td>
            </tr>
            
            <tr>
              <td bgcolor="#b3d9ff"><div align="right">帳號</div></td>
              <td bgcolor="#959595"><div align="left">
                <table width="200" border="1">
                  <tr>
                    <th scope="col"><?php echo $row['Login_id']; ?></th>
                  </tr>
              </table>
              </div></td>
            </tr>
            
            <tr>
              <td bgcolor="#b3d9ff"><div align="right">姓名</div></td>
              <td bgcolor="#b3d9ff"><div align="left">
                <input name="name" type="text" id="name"  size="30" />
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#b3d9ff"><div align="right">email</div></td>
              <td bgcolor="#b3d9ff"><div align="left">
                <input name="email" type="text" id="email"  size="30" />
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#b3d9ff"><div align="right">心情</div></td>
              <td bgcolor="#b3d9ff"><div align="left">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div align="center"><img src="webBoard/img/a.gif" width="85" height="78" /></div></td>
                    <td><div align="center"><img src="webBoard/img/b.gif" width="85" height="78" /></div></td>
                    
                  <tr>
                    <td><div align="center">
                      <label>
                        <input name="face" type="radio" id="radio" value="a" checked="checked" />
                        </label>
                      </div></td>
                    <td><div align="center"><input type="radio" name="face" id="radio" value="b" /></div></td>
                   
                    </tr>
                  </table>
                </div></td>
            </tr>
            <tr>
              <td bgcolor="#b3d9ff"><div align="right">留言</div></td>
              <td bgcolor="#b3d9ff"><div align="left">
                <textarea name="content" cols="50" rows="5" id="content"></textarea>
              </div></td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center">
                  <input type="submit" name="submit" id="submit" value="送出" />
               
                  <input type="reset" name="reset" id="reset" value="重設" />
                </div>
              </td>
              </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1">
        </form></td></tr>
      </table></td>
  </tr></table></td></tr> </table> 
     <br><br><br> 
    <!------------------------------------------------------------------------------------------------->
    <table width="752" border="0" align="center" cellpadding="0" cellspacing="0">
 
 
  <tr>
    <td colspan="2"> 
      <h1>預覽留言區:</h1>
      記錄 <?php echo ($startRow_BoardRec + 1) ?> 到 <?php echo min($startRow_BoardRec + $maxRows_BoardRec, $totalRows_BoardRec) ?> 共 <?php echo $totalRows_BoardRec ?>&nbsp;<table border="0">
       
    </table></td>
  </tr>
  <tr>
    <td colspan="2">
     
      <?php do { ?>
        <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" id="msg">
          <tr>
            <td><br /><table width="750" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="8" height="8"><img src="webBoard/img/m-hidariue.gif" width="8" height="8" /></td>
                <td height="8" colspan="2" background="webBoard/img/m-ue.gif">&nbsp;</td>
                <td width="1%" height="8"><img src="webBoard/img/m-migiue.gif" width="8" height="8" /></td>
                </tr>
              <tr>
                <td width="8" background="webBoard/img/m-hidari.gif"></td>
                <td width="150" align="center" valign="middle" bgcolor="#EEF2F7"><p><img src="webBoard/img/<?php echo $row_BoardRec['face']; ?>.gif"  width="85" height="78" alt="" />住戶名:</p>
                  <table width="200" border="1">
                    <tr>
                      <td><?php echo $row_BoardRec['name']; ?></td>
                    </tr>
                  </table>
                  <p></p></td>
                <td align="center" valign="top" bgcolor="#E6F7FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="66%" class="style2"><div align="left">&nbsp;<?php echo $row_BoardRec['subject']; ?></div></td>
                    <td width="34%"><?php echo $row_BoardRec['postdate']; ?></td>
                    </tr>
                  <tr>
                    <td colspan="2"><hr align="center" width="90%" size="1" /></td>
                    </tr>
                  <tr>
                    <td colspan="2"><div align="left" class="style3">&nbsp;<?php echo $row_BoardRec['content']; ?></div></td>
                    </tr>
                  <tr>
                    <td><div align="left">
                      <table width="465" height="74" border="1">
                        <tr>
                          <td width="570" height="20">大樓管理員:<?php echo $row_BoardRec['adminans']; ?></td>
                        </tr>
                      </table>
                    </div></td>
                    <td><div align="left"></div></td>
                    </tr>
                  </table>
                  <table width="99%" border="1" cellpadding="0" cellspacing="0" id="admin">
          
                  </table></td>
                <td width="8" background="webBoard/img/m-migi.gif"></td>
                </tr>
              <tr>
                <td width="8" height="8"><img src="webBoard/img/m-hidarisita.gif" width="8" height="8" /></td>
                <td height="8" colspan="2" background="webBoard/img/m-sita.gif"></td>
                <td height="8"><img src="webBoard/img/m-migisita.gif" width="8" height="8" /></td>
                </tr>
            </table></td>
          </tr>
  </table>
        <?php } while ($row_BoardRec = mysql_fetch_assoc($BoardRec)); ?></td>
  </tr>
  <tr>
    </table>
     <br><br><br><br><br><br><br>   
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