<?php
header('Content-Type: text/html; charset=utf8');
$host='120.110.113.99';
$name='root';
$pwd='s10423560912';
$db='tanzi';
$con=mysql_connect($host,$name,$pwd) or die("connection failed");
mysql_select_db($db,$con) or die("db selection failed");

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

 $result=mysql_query("SELECT * FROM house",$con);//user資料表名稱

 while($row=mysql_fetch_assoc($result)){
 $tmp[]=$row;
 }
$cart = array("contents" => ($tmp));
 echo json_encode($cart);
 mysql_close($con);
?>