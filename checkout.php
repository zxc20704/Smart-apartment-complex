<?php include("Connections/connections.php");?>
<?php
if(empty($_SESSION['looking'])){
									$_SESSION['looking']= array();//建立陣列;
								}
								
if(isset($_GET['Id'])){
	if(in_array($_GET['Id'],$_SESSION['looking'])){
	                                         
	                                         }else{
			                                       $house_id = $_GET['Id'];
			                                       array_push($_SESSION['looking'],"$house_id");
			
			                                       $_SESSION['looking_num'] = count($_SESSION['looking']);
	                                              }
	                  }


?>
<?php
if(isset($_GET['del'],$_GET['key'])){
                         
                                      $key=$_GET['key'];
                                      unset($_SESSION['looking'][$key]);
                                      $_SESSION['looking']=array_values($_SESSION['looking']);
                                      $query_count= count($_SESSION['looking']);   
                                      $_SESSION['looking_num'] =  $query_count;                                
                             
                  }else{
                         $query_count= count($_SESSION['looking']);
                       }
$sub_total=0;
?>

<?php
 if(isset($_POST['del'])){
	 
		unset($_SESSION['looking']);
		unset($_SESSION['looking_num']);

		echo "<script>alert('成功清除所有收藏'); location.href='checkout.php';</script>";							
	 }
?>

<?php
$sql_rand=mysql_query("SELECT * FROM `house` ORDER BY RAND() LIMIT 4")or die(mysql_error()); 
?>

 <?php
   $path=$_SERVER['PHP_SELF'];
   $path_parts=pathinfo($path);
   $file_name=$path_parts['filename'];  //輸出結果:myweb
   if($file_name!="checkout"){ $query_count= count($_SESSION['looking']); /*資料數*/}
        
   ?>

<?php 

$sql_name=mysql_query("SELECT * FROM `home_footer`"); 
$row_name=mysql_fetch_array($sql_name);

?>     
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>收藏房屋頁面</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/styles/vendor/bootstrap.min.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="assets/fonts/et-lineicons/css/style.css">
        <link rel="stylesheet" href="assets/fonts/linea-font/css/linea-font.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome/css/font-awesome.min.css">
        <!-- Slider -->
        <link rel="stylesheet" href="assets/styles/vendor/slick.css">
        <!-- Lightbox -->
        <link rel="stylesheet" href="assets/styles/vendor/magnific-popup.css">
        <!-- Animate.css -->
        <link rel="stylesheet" href="assets/styles/vendor/animate.css">


        <!-- Definity CSS -->
        <link rel="stylesheet" href="assets/styles/main.css">
        <link rel="stylesheet" href="assets/styles/responsive.css">

        <!-- JS -->
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar">
        
       
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
             <?php if(isset($_SESSION['Login_id'])){?> 
                <h3> 
                 <li class="dropdown">
                 <a href="index_member.php?Go_home" ><i class="linea-basic-home"></i>回到社區管理網站 </a>
                </h3>
               <?php }else{?>
                <h3> 
                 <li class="dropdown">
                 <a href="index.php?Go_home" ><i class="linea-basic-home"></i>回到社區管理網站 </a>
                </h3>
               
               <?php }?>
            </div><!-- / .navbar-header -->

            <!-- Navbar Links -->
            <div id="navbar" class="navbar-collapse collapse">
              
              

              <!-- Navbar Links Right -->
              <ul class="nav navbar-nav navbar-right">
			     <?php if(isset($_SESSION['Login_id'])){?>  
            	 <!-- 會員 -->
                 <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="et-happy"></i> <?php echo $_SESSION['Name'];?></a>
                 
                 <?php }?>
                 </li><!-- / 會員 -->
                  <li class="dropdown">
                  <a href="index_house.php" class="dropdown-toggle"><i class="linea-basic-webpage"></i> 房屋出租首頁</a>
                <!-- Cart (bag icon + notification) -->
                <li class="dropdown cart-nav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="cart-notif">
				  <?php 
				  if(isset($_SESSION['looking_num'])){
					  echo $_SESSION['looking_num'];
					  }else{
				      echo 0;
					       }
					  ?>
                      </span><i class="linea-ecommerce-bag"></i> 收藏房屋</a>
                      
                  <ul class="dropdown-menu cart-dropdown">
                    <li class="dropdown-header">房屋</li>
                    <li role="separator" class="divider cart-sep-top"></li>
                
                    <?php for($i=0;$i<$query_count;$i++){
                    $id=$_SESSION['looking'][$i];
                    $sql_title = mysql_query("SELECT * FROM `house` WHERE `Id`=$id");
                    $row_title=mysql_fetch_assoc($sql_title);
	                $class=$row_title['Class'];
	                $sql_class_2=mysql_query("SELECT * FROM `house_class` WHERE `Id`=$class ");
                    $row_class_2=mysql_fetch_assoc($sql_class_2);

                    ?>
              
                   <li >
                    <div class="cart-item">
                   
                    
                    <a href="#" class="cp-name">[<?php echo $row_class_2['Class_name']; ?>]<?php echo $row_title['Title']; ?></a>
                    <p class="cp-price">$<?php echo $row_title['Price'];?>/<?php echo $row_title['Pings'];?>坪</p>
                    
                   </div>
 
              
                  </li>
               <?php }?>
               <li role="separator" class="divider cart-sep-bot"></li>
                   
                    <li class="cart-btns">
                      <a href="checkout.php" class="btn-ghost-light btn-block">觀看收藏房屋</a>
                      <a href="index_house.php?Clear" class="btn btn-light btn-block">清除收藏</a>
                    </li>

                  </ul>
                </li><!-- / Cart -->
                
                <!-- Search -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i> 房屋搜尋</a>
                  <ul class="dropdown-menu search-dropdown">
                    <li><form action="house_search.php"><input name="keyword" type="search" class="form-control" id="keyword" placeholder="搜尋..."></form></li>
                  </ul>
                </li><!-- / Search -->

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
                  <h1>出租房屋</h1>
                  <br>
                  <h1>各式房屋供您選擇</h1>
                  <span class="subheading">您值得擁有最好的房屋</span>
                </div>
               
              </div>
            </div>
        </header>


        
        <!-- ========== Cart Items - (checkout table) ========== -->

        <div class="container section" >
                
          <div class="row">

            <!-- Checkout Table -->
            <div class="col-md-offset-1 col-md-10 ws-m">
              <h1>您所選的房屋收藏:</h1>
               <br>
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>房屋照片</th>
                      <th>房屋名稱</th>
                      <th>房屋類別</th>
                      <th>房屋價格</th>
                      <th>房屋坪數</th>
                      <th>屋主姓名</th>
                      <th>屋主電話/手機</th>
                      <th>屋主LINE ID</th>
                      <th>刪除</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php for($i=0;$i<$query_count;$i++){
				   $id=$_SESSION['looking'][$i];
				   $sql = mysql_query("SELECT * FROM `house` WHERE `Id`=$id");
				   $row=mysql_fetch_assoc($sql);
				   $sub_total=$sub_total+$row['Price'];
				   $class=$row['Class'];
                   $sql_class=mysql_query("SELECT * FROM `house_class` WHERE `Id`=$class ");
                   $row_class=mysql_fetch_assoc($sql_class);
				  ?>
                  
                    <tr>
                      <td><?php echo $i+1;?></td>
                      <td><a href="house_detail.php?Id=<?php echo $row['Id']?>"><img src="travel/56-56/<?php echo $row['IMG_5'];?>" width="72" height="95" alt=""/></a></td>
                      <td><a href="house_detail.php?Id=<?php echo $row['Id']?>"><?php echo $row['Title'];?></a></td>
                      <td><?php echo $row_class['Class_name'];?></td>
                      <td class="td-product-options">$<?php echo $row['Price'];?></td>
                      <td class="td-product-qty"><?php echo $row['Pings'];?>坪</td>
                      <td><?php echo $row['Name'];?></td>
                      <td><?php echo $row['Phone'];?></td>
                      <td><?php echo $row['Line_id'];?></td>
                      <td>
                      <a href="checkout.php?del=y&key=<?php echo $i;?>"><span class="linea-arrows-square-remove"></span></a>
                       
                      </td>
                      
                    </tr>
				 <?php }?>

                   
                  </tbody>
                </table><!-- / .checkout-table -->
                <form action="checkout.php" method="post" id="order"> 
				 <div class="col-md-offset-10">
                  
                  <input name="del" type="hidden" id="del" value="1">               
                   
                  <input type="submit" class="btn checkout-btn" value="清除收藏">
                 
                </div>
               </form> 
            </div><!-- / .col-lg-9 -->
            
            
          </div><!-- / .row -->
          
        </div><!-- / .container -->

		<!----------------------------------------------------------------------------------->
        

        <!-- ========== Related Items - (products section) ========== -->

        <div class="gray-bg">
          <div class="container section">

            <div class="row">
              <header class="sec-heading">
                <h2>相關房屋</h2>
              </header>

              <!-- Shop Product -->
              <?php while($row_rand=mysql_fetch_assoc($sql_rand)){?>
              
              <div class="col-xs-12 col-sm-6 col-lg-3">
                <div class="shop-product-card">

                  <!-- Image/Slider -->
                  <div class="product-image-wrapper">
                    <span class="label label-red sale-label">SALE</span>

                    <!-- Product Actions (hover) -->
                    <a href="checkout.php?Id=<?php echo $row_rand['Id']?>" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                    <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                    
                    <!-- Product Main Image -->
                    <div class="shop-p-slider">
                      <a href="house_detail.php?Id=<?php echo $row_rand['Id']?>"><img src="travel/263-350/<?php echo $row_rand['IMG_1']?>" alt="Product Image 1"></a>
                      
                    </div>
                  </div>

                  <!-- Product Meta -->
                  <div class="product-meta">
                    <a href="house_detail.php"><h4 class="product-name"><?php echo $row_rand['Title']?></h4></a>
                    <span class="product-sep"></span>
                    <p class="product-price">$<?php echo $row_rand['Price']?></p>
                    <p class="product-price"><?php echo $row_rand['Pings']?>坪</p>
                  </div>

                </div><!-- / .shop-product-card -->
              </div><!-- / .col-sm-3 -->
				<?php }?>

              
            </div><!-- / .row -->
          </div><!-- / .container -->
        </div><!-- / .gray-bg -->


		<footer>
    		 <!-- Copyright -->
          <div class="copyright">
            <div class="container">
              <div class="row">
                
                <div class="col-md-6">
                  <small><a class="">Copyright &copy; 2017. Made by </a><a class="to-the-top"  target="_blank"><?php echo $row_name['Name']?>.</a><a> 網站圖片皆專題使用，非用在商業用途!</a></small>
                   
                </div>
				
                <div class="col-md-6">
                  <small><a href="#page-top" class="pull-right to-the-top">To the top<i class="fa fa-angle-up"></i></a></small>
                </div>

              </div><!-- / .row -->
            </div><!-- / .container -->
          </div><!-- / .copyright -->
    	</footer>
       
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
        <script src="assets/js/vendor/wow.min.js"></script>

        <!-- Definity JS -->
        <script src="assets/js/main.js"></script>
    </body>
</html>
