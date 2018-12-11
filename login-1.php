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
  $MM_redirectLoginSuccess = "admin/public/index_back.php";
  $MM_redirectLoginFailed = "login-1.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cn_tanzi, $cn_tanzi);
  
  $LoginRS__query=sprintf("SELECT Login_id, Password FROM `admin` WHERE Login_id=%s AND Password=%s",
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
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>管理員登入頁面</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets\styles\vendor/bootstrap.min.css">
       
        <!-- Definity CSS -->
        <link rel="stylesheet" href="assets\styles\main.css">
       
    </head>
    <body id="page-top">
        
       
        <div class="login-1">
          
            
            <div class="container">
              <div class="row">
                <div class="col-md-offset-3 col-md-6">
                  
                  <!-- Log in -->
                  <div class="panel-group" id="login-accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel top-panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a role="button" data-toggle="collapse" data-parent="#login-accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            管理員登入
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">

                          <div class="form-login">
                            <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" id="login">
                              <!-- Username -->
                              <div class="form-group">
                                <input type="text" id="Login_id" class="form-control" placeholder="輸入帳號" name="Login_id">
                                <label for="Login_id">帳號</label>
                              </div>
                              <!-- Password -->
                              <div class="form-group">
                                <input type="password" id="Passward" class="form-control" placeholder="輸入密碼" name="Passward">
                                <label for="Passward">密碼</label>
                               
                              </div>
                              <!-- Submit -->
                              <input type="submit" value="登入" class="btn">
                            </form>
                           
                          </div><!-- / .form-wrapper -->
							<br><br><br><br>
                        </div><!-- / .panel-body -->
                      </div><!-- / .panel-collapse -->
                    </div><!-- / .panel -->
                   
                  </div><!-- / #login-accordion .panel-group -->


                </div><!-- / .col-md-6 -->
              </div><!-- / .row -->
            </div><!-- / .container -->

          </div><!-- / .bg-overlay -->
        </div><!-- / .bg-login -->

        
        <script src="assets\js\vendor\jquery.waypoints.min.js"></script>
       
       
    </body>
</html>
