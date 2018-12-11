<?php include("Connections/connections.php");?>

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
$sql_count=mysql_query("SELECT * FROM `house` WHERE `Title` LIKE '%".$_GET['keyword']."%'"); 
$total_count=mysql_num_rows($sql_count);               //總筆數
$page_num=9; 										   //預設產品數
$total_page=ceil($total_count/$page_num);              //總共頁碼
$mod_num=fmod($total_count,$page_num);                 //取餘數

$start = 0;                                                    //起始資料序號
$end = $page_num;                                              //取得瀏覽頁數,沒有則設為第一頁


?>
<?php
  //產品


if(isset($_GET['page'])){
							$page=$_GET['page'];                                           //取得參數頁碼     
							if ($page!=""){	$page=$_GET['page'];}else{	$page=1;}    
							$begin = ($page-1) * $page_num;                                //開始頁碼
							$sql=mysql_query("SELECT * FROM `house` WHERE `Title` LIKE '%".$_GET['keyword']."%' ORDER BY `Id` ASC LIMIT $begin,$page_num");
					}else{
							$sql=mysql_query("SELECT * FROM `house` WHERE `Title` LIKE '%".$_GET['keyword']."%' ORDER BY `Id` ASC LIMIT $page_num");  
						 }




if(isset($_GET['start'],$_GET['end'])){
												$start = $_GET['start']+1;
												if($_GET['page'] == $total_page){
													   		$end = $total_count;																													
													}else{
															$end = $_GET['end']+1;
													}
									  }else{
										  		if($total_count<=$page_num){
																					$start=1;
																					$end=$total_count;
							
						  												  }else{
																					$start=1;
																					$end=$page_num;
																		  }
										   }	                          
 
?>
<?php
//類別
$sql_class=mysql_query("SELECT * FROM `house_class` ");
?>
<?php 
$query_count= count($_SESSION['looking']); 
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
        <title>房屋出租頁面</title>
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
        <!-- Range Slider -->
        <link rel="stylesheet" href="assets/styles/vendor/jquery-ui.min.css">
        <link rel="stylesheet" href="assets/styles/vendor/jquery-ui.structure.min.css">


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
                    $row_title=mysql_fetch_array($sql_title);
	                $class=$row_title['Class'];
	                $sql_class_2=mysql_query("SELECT * FROM `house_class` WHERE `Id`=$class ");
                    $row_class_2=mysql_fetch_array($sql_class_2);

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


        
        <!-- ========== Shop - (4 columns) ========== -->

        <div class="gray-bg">
          <div class="container section-shop">

            <div class="row">
              
              <!-- Shop Layout - (3 columns) -->
              <div class="col-md-9">

                <!-- Shop layout options -->
                <div class="row mb-50">
                  <div class="col-xs-12 col-sm-6 col-md-9 mb-sm-30">
                    <span>第<?php echo $start;?>–<?php echo $end;?>筆 ，共<?php echo $total_count;?>筆資料</span>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3 pull-right">
                    <select class="form-control" id="select-form">
                      <option>預設排序</option>
                      <option>高價排序</option>
                      <option>低價排序</option>
                      <option>最近新品</option>
                    </select>
                  </div>
                </div><!-- / .row -->
                
                <div class="row">
                <?php while ($row = mysql_fetch_array($sql)){?>

                  <!-- Shop Product -->
                  <div class="col-xs-12 col-sm-6 col-lg-4 mb-30">
                    <div class="shop-product-card">

                      <!-- Image/Slider -->
                      <div class="product-image-wrapper">
                        <span class="label label-red sale-label">SALE</span>

                        <!-- Product Actions (hover) -->
                        <a href="product_search.php?Id=<?php echo $row['Id']?>&keyword=<?php echo $_GET['keyword'];?>" class="buy-btn"><span class="linea-ecommerce-bag"></span></a>
                        <a href="#" class="fav-btn"><span class="linea-basic-star"></span></a>
                        
                        <!-- Product Main Image -->
                        <div class="shop-p-slider">
                          <a href="house_detail.php?Id=<?php echo $row['Id']?>"><img src="travel/263-350/<?php echo $row['IMG_1']?>" alt="Product Image 1"></a>
                         
                        </div>
                      </div>

                      <!-- Product Meta -->
                      <div class="product-meta">
                        <a href="house_detail.php?Id=<?php echo $row['Id']?>"><h4 class="product-name"><?php echo $row['Title']?></h4></a>
                        <span class="product-sep"></span>
                        <p class="product-price">$<?php echo $row['Price']?></p>
                        <p class="product-price"><?php echo $row['Pings']?>坪</p>
                      </div>

                    </div><!-- / .shop-product-card -->
                  </div><!-- / .col-sm-3 -->
				<?php }?>
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
                      
                      <?php 
					        
					        for($i=1;$i<=$total_page;$i++){
							$start=($i-1)*$page_num;
							$end=$start+$page_num-1;  
					   ?>
                      	<li><a href="house_search.php?page=<?php echo $i;?>&start=<?php echo $start;?>&end=<?php echo $end;?>&keyword=<?php echo $_GET['keyword']?>"><?php echo $i?></a></li>
                      <?php }?>
                      
                      
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
                     <form action="house_search.php">
                      <input type="search" name="keyword" placeholder="搜尋 ..." class="form-control">
                      <button class="inside-input-btn"><i class="fa fa-search"></i></button>
                      </form>
                    </div>
                   
                  </div>


                  <!-- Cart Widget -->
                  <div class="shop-widget cart-widget mb-sm-50">
                    <h5 class="header-widget">收藏房屋</h5>
                    <?php for($i=0;$i<$query_count;$i++){
                    $id=$_SESSION['looking'][$i];
                    $sql_title = mysql_query("SELECT * FROM `house` WHERE `Id`=$id");
                    $row_title=mysql_fetch_array($sql_title);
	                $class=$row_title['Class'];
	                $sql_class_2=mysql_query("SELECT * FROM `house_class` WHERE `Id`=$class ");
                    $row_class_2=mysql_fetch_array($sql_class_2);

                    ?>
              
                    <div class="cart-item">
                      
                      
                      <a href="house_detail.php?Id=<?php echo $row_title['Id']?>" class="cp-name">[<?php echo $row_class_2['Class_name'];?>]<?php echo $row_title["Title"];?></a>
                      <p class="cp-price">$<?php echo $row_title['Price'];?>/<?php echo $row_title['Pings'];?></p>
                    </div>
                    <?php }?>
                    <div class="cw-subtotal">
                      <a href="checkout.php" class="btn-ghost btn-small">觀看收藏房屋</a>
                    </div>
                  </div><!-- / .cart-widget -->
                  <!-- Categories - Widget -->
                  <div class="shop-widget categories-widget">
                    <h5 class="header-widget">房屋類別</h5>
                    <!-- Item -->
                    <?php while ($row_class = mysql_fetch_array($sql_class)){?>
                    <div class="widget-item">
                      <a href="index_house.php?h_class_Id=<?php echo $row_class['Id']?>"><?php echo $row_class['Class_name']?> - 
                      <span>
						  <?php 
                            $House_class_Id=$row_class['Id'];
							$sql_house=mysql_query("SELECT * FROM `house` WHERE `Class`=$House_class_Id ");                            $sql_count=mysql_num_rows($sql_house); 
							echo $sql_count;
                          ?>
                      </span>
                      </a>
                    </div>
                    <?php }?>
                    
                  </div><!-- / .categories-widget -->


                 
                </aside><!-- / .shop-sidebar-vertical -->
              </div><!-- / .col-md-3 -->
            </div><!-- / .row -->

          </div><!-- / .contianer -->
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
        <script src="assets/js/vendor/jquery-ui.min.js"></script>
        <script src="assets/js/vendor/wow.min.js"></script>

        <!-- Definity JS -->
        <script src="assets/js/main.js"></script>
    </body>
</html>
