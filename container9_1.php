<?php include('Connections/cn_tanzi.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "house_add")) {
  $insertSQL = sprintf("INSERT INTO house (Title, `Class`, Name, Phone, Line_id, Pings, Price, `Date`, Detail, IMG_1, IMG_2, IMG_3, IMG_4, IMG_5, Member) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Class'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['Line_id'], "text"),
                       GetSQLValueString($_POST['Pings'], "double"),
                       GetSQLValueString($_POST['Price'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Detail'], "text"),
                       GetSQLValueString($_POST['IMG_1'], "text"),
                       GetSQLValueString($_POST['IMG_2'], "text"),
                       GetSQLValueString($_POST['IMG_3'], "text"),
                       GetSQLValueString($_POST['IMG_4'], "text"),
                       GetSQLValueString($_POST['IMG_5'], "text"),
					   GetSQLValueString($_SESSION['MM_Username'], "text"));

  mysql_select_db($database_cn_tanzi, $cn_tanzi);
  $Result1 = mysql_query($insertSQL, $cn_tanzi) or die(mysql_error());

  $insertGoTo = "container9_1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_Home_footer = "SELECT * FROM home_footer";
$cn_Home_footer = mysql_query($query_cn_Home_footer, $cn_tanzi) or die(mysql_error());
$row_cn_Home_footer = mysql_fetch_assoc($cn_Home_footer);
$totalRows_cn_Home_footer = mysql_num_rows($cn_Home_footer);

mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_member = "SELECT * FROM member ORDER BY Id ASC";
$cn_member = mysql_query($query_cn_member, $cn_tanzi) or die(mysql_error());
$row_cn_member = mysql_fetch_assoc($cn_member);
$totalRows_cn_member = mysql_num_rows($cn_member);
?>
<?php 
$login_id=$_SESSION['MM_Username'];
$sql=mysql_query("SELECT * FROM `member` WHERE `Login_id`=$login_id "); 
$row=mysql_fetch_array($sql);
?>
<?php 

$sql_class=mysql_query("SELECT * FROM `house_class` "); 
$row_class=mysql_fetch_array($sql_class);
?>
<?php 

$sql_house=mysql_query("SELECT * FROM `house` WHERE `Member`=$login_id"); 
$row_house=mysql_fetch_array($sql_house);
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
				background:url(travel/背景_1.jpg);
                
               
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
			body h4{
				color:white;
				
			}
			#footer{
				background-color: white;
				
			}
			#link a:hover{
                background-color: #4d4d4d;
                
            }
			table a{
				color:black;
			}
			
         </style>
         <!-- Google Web Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

		
        <!-------------------------------------------------------------------------------->
		<!-- Bootstrap -->
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.css">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="assets/lib/metismenu/metisMenu.css">
    
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="assets/lib/onoffcanvas/onoffcanvas.css">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/lib/animate.css/animate.css">

		

		

		

		

        
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
            <div class="row">
              
              <div class="col-md-12 col-lg-offset-2 col-lg-8">
                <div class="form-wrapper">
                  <div class="from-header">
                    <h1>需出租房屋基本資料填寫:</h1>
                    <br>
                  </div>
 <form action="<?php echo $editFormAction; ?>" id="house_add" name="house_add" method="POST">
             <div class="row ws-m">
              <div class="col-md-5">
                <!-- Name -->
                <div class="form-group">
                  <p value="<?php echo $row['Login_id'];?>" type="text" class="form-control" name="Member" id="Member" ><?php echo $row['Login_id'];?></p>
                  <label for="inpt-pass-forms">刊登帳號</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Title" id="Title" placeholder="">
                  <label for="inpt-name-forms">標題</label>
                </div>
                <div class="form-group">
                  
                  <select name="Class" type="text" class="form-control" id="Class">
                    <option>請選擇</option>
                    <?php do {?>
                    <option><?php echo $row_class['Id']?></option>
                    <?php }while($row_class=mysql_fetch_array($sql_class));?>
                    
                  </select>
                  <label for="select-form">房屋類型(1:租屋/2:售屋)</label>
                </div>
                <div class="form-group">
                  <input type="double" class="form-control" name="Pings" id="Pings" placeholder="坪">
                  <label for="inpt-name-forms">坪數</label>
                </div>
                 <div class="form-group">
                  <input type="text" class="form-control" name="Price" id="Price" placeholder="元">
                  <label for="inpt-name-forms">價錢</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Name" id="Name" placeholder="">
                  <label for="inpt-email-forms">聯絡姓名</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Phone" id="Phone" placeholder="">
                  <label for="inpt-email-forms">聯絡手機/電話</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Line_id" id="Line_id" placeholder="(可不填)">
                  <label for="inpt-email-forms">聯絡 Line ID</label>
                </div>
                
              </div><!-- / .col-md-4 -->
              
              
              <div class="col-md-12 col-lg-offset-2 col-md-5">  
			   <div class="form-group">
                  <input type="text" class="form-control" name="IMG_1" id="IMG_1" placeholder="Ex.圖片名稱.jpg">
                  <label for="inpt-name-forms">圖片一 (出租首頁點選圖)</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="IMG_2" id="IMG_2" placeholder="Ex.圖片名稱.jpg">
                  <label for="inpt-name-forms">圖片二 (出租詳細頁面展示圖一)</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="IMG_3" id="IMG_3" placeholder="Ex.圖片名稱.jpg(可不填)">
                  <label for="inpt-name-forms">圖片二 (出租詳細頁面展示圖二)</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="IMG_4" id="IMG_4" placeholder="Ex.圖片名稱.jpg(可不填)">
                  <label for="inpt-name-forms">圖片三 (出租詳細頁面展示圖三)</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="IMG_5" id="IMG_5" placeholder="Ex.圖片名稱.jpg">
                  <label for="inpt-name-forms">圖片四 (房屋收藏紀錄頁面展示圖四)</label>
                </div>
               </div>
               
               
                <div class="form-group">
                  <textarea class="form-control" name="Detail" id="Detail" rows="9" placeholder="大略描述需出租房屋的概況"></textarea>
                  <label for="txt-forms">出租房屋描述</label>
                </div> 
              
              <div class="col-md-offset-10 ">
                  <input type="submit" value="送出" name="submit" id="submit" class="btn">
                  <input name="Date" type="hidden" id="Date" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
             <input type="hidden" name="MM_insert" value="fix_add">
             <input type="hidden" name="MM_insert" value="house_add">
            </form>
                   <!------------------------------------------------------------------------->
                  
                   <!--------------------------------------------------------------------------------------->
                    
                    <br>
                    <div class="form-group">
                      <h1><p>已刊登房屋紀錄表:</p></h1>
                      
                    </div>
					 <div id="collapse4" class="body">
                
                    <br>
                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th></th>
                          <th>房屋照片</th>
                          <th>房屋名稱</th>
                          <th>房屋類別</th>
                          <th>房屋價格</th>
                          <th>房屋坪數</th>
                          
                          <th>刪除</th>
                        </tr>
                        </thead>
                      
                      <tbody>
                        <?php 
						  $i=1;
						  if(isset($row_house['Class'])){
						  $house_class=$row_house['Class'];
                          $sql_house_class=mysql_query("SELECT * FROM `house_class` WHERE `Id`=$house_class"); 
                          $row_house_class=mysql_fetch_assoc($sql_house_class)or die(mysql_error());
						  }
						  do{
                        
                          ?>
                        <tr>
                         <td><?php echo $i; $i++;?></td>
                          <td><img src="travel/56-56/<?php echo $row_house['IMG_5'];?>"/></td>
                          <td><?php echo $row_house['Title']; ?></td>
                          <td><?php 
							  if(isset($row_house['Class'])){
							  echo $row_house_class['Class_name']; 
							  }
							  ?></td>
                          <td><?php echo $row_house['Price']; ?></td>
                          <td><?php echo $row_house['Pings']; ?></td>
                         
                          <td><a href="admin/public/house_del.php?Id=<?php echo $row_house['Id']; ?>">刪除</a></td>
                        </tr>
                        <?php }while($row_house=mysql_fetch_array($sql_house));?>
                  </tbody>                </table>
                    
                  <br>
            </div>
                    

                 
                </div>
              </div>

            </div>
         <br><br><br><br>
        
       
    <!------------------------------------------------------------------------------------------------------->
     
    
    <!-------------------------------------------------------------------------------------------------------->
       
   	


	<!-------------------------------------------------------------------------------------------------------------
	<!--------------------------------------------------------------------------------------------------->
	


<div id="footer"> 
    <footer >
   <br><br>     	
 <div class="row">
	
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

?><?php
mysql_free_result($cn_member);
?>