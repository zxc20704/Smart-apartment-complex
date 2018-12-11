<?php  

	$uptypes=array('/image/jpg',  //上傳文件類型列表  
	'image/jpeg',  
	'image/png',  
	'image/pjpeg',  
	'image/gif',  
	'image/bmp',  
	'application/x-shockwave-flash',  
	'image/x-png');  
	 
	$max_file_size=5000000;   //上傳文件大小限制, 單位BYTE  
	$destination_folder="./01/"; //上傳文件路徑  
	$watermark=0;   //是否附加水印(1為加水印,其他為不加水印);  
	$watertype=1;   //水印類型(1為文字,2為圖片)  
	$waterposition=2;   //水印位置(1為左下角,2為右下角,3為左上角,4為右上角,5為居中);  
	$waterstring="beelzebub.no-ip.biz"; //水印字符串  
	$waterimg="xplore.gif";  //水印圖片  
	$imgpreview=1;   //是否生成預覽圖(1為生成,其他為不生成);  
	$imgpreviewsize=1/2;  //縮略圖比例  
	?>  
	<html>  
	<head> 
	<title>查看圖片</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=big5"> 
	<style type="text/css">body,td{font-family:tahoma,verdana,arial;font-size:11px;line-height:15px;background-color:white;color:#666666;margin-left:20px;} 
	strong{font-size:12px;} 
	a:link{color:#0066CC;} 
	a:hover{color:#FF6600;} 
	a:visited{color:#003366;} 
	a:active{color:#9DCC00;} 
	table.itable{} 
	td.irows{height:20px;background:url("index.php?i=dots") repeat-x bottom}</style> 
	</head> 
	<body text="ffcc00" bgcolor="000000" link="ff0000"> 
	<center><form enctype="multipart/form-data" method="post" name="upform">  
	上傳文件: <br><br><br> 
	<input name="upfile" type="file"  style="width:200;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff" size="17">  
	<input type="submit" value="上傳" style="width:30;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff" size="17"><br><br><br>  
	允許上傳的文件類型為:jpg|jpeg|png|pjpeg|gif|bmp|x-png|swf <br><br> 
	
	<font color=green>上傳文件大小限制 5000 KB</font><br> 
	<font color=green>圖片不可有中文、否則將上傳失敗</font><br> 
	<a href="javascript:window.history.back();">回上一頁</a> 
	</form>  
	 
	<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST')  
	{  
	if (!is_uploaded_file($_FILES["upfile"][tmp_name]))  
	//是否存在文件  
	{   
	echo "<font color='red'>文件不存在！</font>";  
	exit;  
	}  
	 
	$file = $_FILES["upfile"];  
	if($max_file_size < $file["size"])  
	//檢查文件大小  
	{  
	echo "<font color='red'>文件太大！</font>";  
	exit;  
	  }  
	 
	if(!in_array($file["type"], $uptypes))  
	//檢查文件類型  
	{  
	echo "<font color='red'>只能上傳圖像文件或Flash！</font>";  
	exit;   
	}  
	 
	if(!file_exists($destination_folder))  
	mkdir($destination_folder);  
	
    $login_id=$_SESSION['MM_Username'];
    
        
	$filename=$file["tmp_name"];  
	$image_size = getimagesize($filename);   
	$pinfo=pathinfo($file["name"]);  
	$ftype=$pinfo[extension];  
	$destination = $destination_folder.time().".".$ftype;  
	if (file_exists($destination) && $overwrite != true)  
	{  
	     echo "<font color='red'>同名文件已經存在了！</a>";  
	     exit;  
	  }  
	   
	if(!move_uploaded_file ($filename, $destination))  
	{  
	   echo "<font color='red'>移動文件出錯！</a>";  
	     exit;  
	  }  
	 
	$pinfo=pathinfo($destination);  
	$fname=$pinfo[basename];  
	echo " <font color=red>已經成功上傳</font><br>文件網址:<a href=".$destination_folder.$fname."><font color=blue>$url".$destination_folder.$fname."</font></a><br>"; 
	echo " 寬度:".$image_size[0];  
	echo " 長度:".$image_size[1];  
	if($watermark==1)  
	{  
	$iinfo=getimagesize($destination,$iinfo);  
	$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
	$white=imagecolorallocate($nimage,255,255,255);  
	$black=imagecolorallocate($nimage,0,0,0);  
	$red=imagecolorallocate($nimage,255,0,0);  
	imagefill($nimage,0,0,$white);  
	switch ($iinfo[2])  
	{  
	case 1:  
	$simage =imagecreatefromgif($destination);  
	break;  
	case 2:  
	$simage =imagecreatefromjpeg($destination);  
	break;  
	case 3:  
	$simage =imagecreatefrompng($destination);  
	break;  
	case 6:  
	$simage =imagecreatefromwbmp($destination);  
	break;  
	default:  
	die("<font color='red'>不能上傳此類型文件！</a>");  
	exit;  
	}  
	 
	imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
	imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
	 
	switch($watertype)  
	{  
	case 1:  //加水印字符串  
	imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);  
	break;  
	case 2:  //加水印圖片  
	$simage1 =imagecreatefromgif("xplore.gif");  
	imagecopy($nimage,$simage1,0,0,0,0,85,15);  
	imagedestroy($simage1);  
	break;  
	}   
	 
	switch ($iinfo[2])  
	{  
	case 1:  
	//imagegif($nimage, $destination);  
	imagejpeg($nimage, $destination);  
	break;  
	case 2:  
	imagejpeg($nimage, $destination);  
	break;  
	case 3:  
	imagepng($nimage, $destination);  
	break;  
	case 6:  
	imagewbmp($nimage, $destination);  
	//imagejpeg($nimage, $destination);  
	break;  
	}  
	 
	//覆蓋原上傳文件  
	imagedestroy($nimage);  
	imagedestroy($simage);  
	}  
	 
	if($imgpreview==1)  
	{  
	echo "<br>圖片預覽:<br>";  
	echo "<a href=\"".$destination."\" target='_blank'><img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);  
	echo " alt=\"圖片預覽:\r文件名:".$destination."\" border='0'></a>";  
	}  
	}  

        
$nowdate = date( 'Y-m-d H:i:s'); 
$conn = mysql_connect("127.0.0.1", "root","s10423560912"); 
mysql_select_db("tanzi",$conn); 
mysql_query("Insert Into member_address(Login_id,Img_name,Address) Values ('$login_id','$destination','$filename')"); 
        
	?> 
	</center>  
	</body>  
	</html> 
