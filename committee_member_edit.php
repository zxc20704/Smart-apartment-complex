<?php require_once('../../Connections/cn_tanzi.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "committee_member_edit")) {
  $updateSQL = sprintf("UPDATE committee_member SET Img=%s, Name=%s, Office=%s WHERE Id=%s",
                       GetSQLValueString($_POST['Img'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Office'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_cn_tanzi, $cn_tanzi);
  $Result1 = mysql_query($updateSQL, $cn_tanzi) or die(mysql_error());

  $updateGoTo = "about_us.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

$colname_cn_committee_member = "-1";
if (isset($_GET['Id'])) {
  $colname_cn_committee_member = $_GET['Id'];
}
mysql_select_db($database_cn_tanzi, $cn_tanzi);
$query_cn_committee_member = sprintf("SELECT * FROM committee_member WHERE Id = %s", GetSQLValueString($colname_cn_committee_member, "int"));
$cn_committee_member = mysql_query($query_cn_committee_member, $cn_tanzi) or die(mysql_error());
$row_cn_committee_member = mysql_fetch_assoc($cn_committee_member);
$totalRows_cn_committee_member = mysql_num_rows($cn_committee_member);
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>管理者後台</title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    
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



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!--For Development Only. Not required -->
    <script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "/assets/"
        };
    </script>
    <link rel="stylesheet" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>

  </head>

        <body class="  ">
            <div class="bg-dark dk" id="wrap">
                <div id="top">
                    <!-- .navbar -->
                    <nav class="navbar navbar-inverse navbar-static-top">
                        <div class="container-fluid">
                    
                    
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <header class="navbar-header">
                    
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="index_back.php" class="navbar-brand"><img src="assets/img/logo.jpg" alt=""></a>
                    
                            </header>
                    
                    
                    
                            <div class="topnav">
                                <div class="btn-group">
                                    <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
                                       class="btn btn-default btn-sm" id="toggleFullScreen">
                                        <i class="glyphicon glyphicon-fullscreen"></i>
                                    </a>
                                </div>
                                <div class="btn-group"> </div>
                                <div class="btn-group">
                                    <a href="../../index.php" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
                                       class="btn btn-metis-1 btn-sm">
                                        <i class="fa fa-power-off"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"
                                       class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                    
                            </div>
                    
                    
                    
                    
                            <div class="collapse navbar-collapse navbar-ex1-collapse">
                    
                                <!-- .nav -->
                                <ul class="nav navbar-nav">
                                    <li><a href="index_back.php">管理者後台</a></li>
                                   
                                </ul>
                                <!-- /.nav -->
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                    <!-- /.navbar -->
                        <header class="head">
                                <div class="search-bar"> <!-- /.main-search -->                                </div>
                                <!-- /.search-bar -->
                            <div class="main-bar">
                                <h3>
              <i class="fa fa-home"></i>&nbsp;
            Backstage
          </h3>
                            </div>
                            <!-- /.main-bar -->
                        </header>
                        <!-- /.head -->
                </div>
                <!-- /#top -->
                    <div id="left">
                        <div class="media user-media bg-dark dker">
                            <div class="user-media-toggleHover">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="user-wrapper bg-dark">
                                <a class="user-link" href="">
                                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/10.jpg">
                                    <span class="label label-danger user-label">16</span>
                                </a>
                        
                                <div class="media-body">
                                    <h5 class="media-heading"><?php echo $row_cn_admin['Name']; ?></h5>
                                    <ul class="list-unstyled user-info">
                                        <li><a href=""><?php echo $row_cn_admin['Login_id']; ?></a></li>
                                        <li><?php echo $row_cn_home_footer['Name']; ?><br>
                                            <small><i class="fa fa-calendar"></i>&nbsp;<?php echo $row_cn_home_footer['Address']; ?></small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- #menu -->
                        <ul id="menu" class="bg-blue dker">
                                   <li class="nav-divider"></li>
                                  <li class="nav-header">Menu-更新、更改網頁區</li>
                                  <li class="nav-divider"></li>
                                  <li class="">
                                    <a href="index_house.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;首頁-房屋出租表</span>
                                    </a>
                                  </li>
                                    <li class="">
                                    <a href="index_thing.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;首頁-公佈欄</span>
                                    </a>
                                  </li>
                                    <li class="">
                                    <a href="index_home_img.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;首頁-圖片</span>
                                    </a>
                                  </li>
                                    <li class="">
                                    <a href="index_home_footer.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;首頁-頁尾資訊</span>
                                    </a>
                                  </li>
                                    <li class="">
                                    <a href="about_us.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;關於我們</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="announcement.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;大樓公告</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="reserve.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;設施預約</span>
                                    </a>
                                  </li>
                                   <li class="">
                                    <a href="fix.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;維修通報</span>
                                    </a>
                                  </li> 
                                   <li class="">
                                    <a href="inquire.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;綜合查詢</span>
                                    </a>
                                  </li>
                                   <li class="">
                                    <a href="message.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;留言板</span>
                                    </a>
                                  </li>
                                   <li class="">
                                    <a href="vote.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;投票系統</span>
                                    </a>
                                  </li>
                                  <li class="nav-divider"></li>
                                  <li class="nav-header">Menu-管理區</li>
                                  <li class="nav-divider"></li>
                                   <li class="">
                                    <a href="account_manage.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;住戶帳密管理</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="property_manage.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;設施管理</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="house_manage.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;房屋出租管理-房屋出租首頁資訊</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="house_manage_detail.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;房屋出租管理-房屋詳細頁面資訊</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="house_manage_img.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;房屋出租管理-房屋圖片</span>
                                    </a>
                                  </li>
                            
                            <li class="nav-divider"></li>
                                  <li class="nav-header">Menu-辨識管理區</li>
                                  <li class="nav-divider"></li>
                                    <li class="">
                                    <a href="residents_manage.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;住戶管理</span>
                                    </a>
                                  </li>
                                    <li class="">
                                    <a href="non_residents_manage.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;非住戶管理</span>
                                    </a>
                                  </li>
                                    <li class="">
                                    <a href="exec_python.php">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;執行住戶辨識系統</span>
                                    </a>
                                  </li>
                      </ul>
                        <!-- /#menu -->
                    </div>
                    <!-- /#left -->
                <div id="content">
                    <div class="outer">
                        <div class="inner bg-light lter">
                          <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="fa fa-table"></i></div>
              <h5>社區管委會主要幹部</h5>
              
            </header>
            <div id="collapse4" class="body">
              <form action="<?php echo $editFormAction; ?>" id="committee_member_edit" name="committee_member_edit" method="POST">
                <table width="70%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td><label for="Img">圖片:</label>
                      <input name="Img" type="text" id="Img" value="<?php echo $row_cn_committee_member['Img']; ?>"></td>
                    </tr>
                    <tr>
                      <td><label for="Name">管委會幹部姓名:</label>
                      <input name="Name" type="text" id="Name" value="<?php echo $row_cn_committee_member['Name']; ?>"></td>
                    </tr>
                     <tr>
                      <td><label for="Office">管委會幹部職位:</label>
                      	<input name="Office" type="text" id="Office" value="<?php echo $row_cn_committee_member['Office']; ?>">
                      </td>
                     
                    </tr>
                    
                  </tbody>
                </table>
                <br>
                <input type="submit" name="submit" id="submit" value="送出">
                
                <input name="Id" type="hidden" id="Id" form="committee_member_edit" value="<?php echo $row_cn_committee_member['Id']; ?>">
                
                <input type="hidden" name="MM_update" value="committee_member_edit">
              </form>
              <p>&nbsp;</p>
                
            </div>
        </div>
    </div>
                        </div>
                        <!-- /.inner -->
                    </div>
                    <!-- /.outer -->
                </div>
                <!-- /#content -->

                    <div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
                        <a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
                        <br>
                        <br>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong> Best check yo self, you're not looking too good.
                        </div>
                        <!-- .well well-small -->
                        <div class="well well-small dark">
                            <ul class="list-unstyled">
                                <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span></li>
                                <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span></li>
                                <li>Popularity <span class="dynamicbar pull-right">Loading..</span></li>
                                <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span></li>
                            </ul>
                        </div>
                        <!-- /.well well-small -->
                        <!-- .well well-small -->
                        <div class="well well-small dark">
                            <button class="btn btn-block">Default</button>
                            <button class="btn btn-primary btn-block">Primary</button>
                            <button class="btn btn-info btn-block">Info</button>
                            <button class="btn btn-success btn-block">Success</button>
                            <button class="btn btn-danger btn-block">Danger</button>
                            <button class="btn btn-warning btn-block">Warning</button>
                            <button class="btn btn-inverse btn-block">Inverse</button>
                            <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
                            <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
                            <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
                            <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
                            <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
                            <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
                        </div>
                        <!-- /.well well-small -->
                        <!-- .well well-small -->
                        <div class="well well-small dark">
                            <span>Default</span><span class="pull-right"><small>20%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                            </div>
                            <span>Success</span><span class="pull-right"><small>40%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                            </div>
                            <span>warning</span><span class="pull-right"><small>60%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
                            </div>
                            <span>Danger</span><span class="pull-right"><small>80%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /#right -->
            </div>
            <!-- /#wrap -->
            <footer class="Footer bg-dark dker">
                <p>Copyright © 2017 &nbsp;<?php echo $row_cn_home_footer['Name']; ?>社區. &nbsp;All rights reserved.</p>
            </footer>
            
            <!--jQuery -->
            <script src="assets/lib/jquery/jquery.js"></script>


            <!--Bootstrap -->
            <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
            <!-- MetisMenu -->
            <script src="assets/lib/metismenu/metisMenu.js"></script>
            <!-- onoffcanvas -->
            <script src="assets/lib/onoffcanvas/onoffcanvas.js"></script>
            <!-- Screenfull -->
            <script src="assets/lib/screenfull/screenfull.js"></script>


            <!-- Metis core scripts -->
            <script src="assets/js/core.js"></script>
            <!-- Metis demo scripts -->
            <script src="assets/js/app.js"></script>


            <script src="assets/js/style-switcher.js"></script>
            <!------------------------------------------------------------------------------------------->
             <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.10/ckeditor.js"></script>
        </body>

</html>
<?php
mysql_free_result($cn_admin);

mysql_free_result($cn_home_footer);

mysql_free_result($cn_committee_member);
?>
