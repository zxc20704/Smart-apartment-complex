<?php include("Connections/connections.php");?>
<?php
session_unset(); //全部釋出
echo "<script>alert('登出成功'); location.href='index.php';</script>";
 
?>