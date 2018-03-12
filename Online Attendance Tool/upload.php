<?php
include_once 'gpConfig.php';
require_once "./connection.php";
include_once 'header.php';

extract($_POST);
//var_dump($_POST);
$target_dir = "images1/".$ccode."/".$week;
//echo $target_dir;
//exit;
if($submit=='Delete Image'){
	$filename=$target_dir.".jpg";
	$pic_name=$week.".jpg";
	unlink($filename);
	mysql_query("DELETE FROM picture where code = '".$ccode."' && name = '".$pic_name."' limit 1");
	mysql_query("DELETE FROM tags where classCode = '".$ccode."' && image = '".$pic_name."' limit 1");
	
} else if(isset($_FILES['image'])){
		$errors= array();
		$file_name = $_FILES['image']['name'];
		$file_size =$_FILES['image']['size'];
		$file_tmp =$_FILES['image']['tmp_name'];
		$file_type=$_FILES['image']['type'];
		$tmp=explode('.',$_FILES['image']['name']);		
		$file_ext=strtolower(end($tmp));
		
		$expensions= array("jpeg","jpg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 5097152){
		$errors[]='File size should no more than 5 MB';
		}			
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"images1/".$ccode."/".$week.".jpg");
					$week1 ="".$week.".jpg";
					//echo "DELETE FROM picture where code = '".$ccode."' and name = '".$week."'";
			mysql_query("DELETE FROM picture where code = '".$ccode."' and name = '".$week.".jpg' limit 1");
			mysql_query("DELETE FROM tags where classCode = '".$ccode."' && image = '".$target_dir."'.jpg' limit 1");
			mysql_query("INSERT INTO picture (name,code) VALUES ('$week1','$ccode')");

			echo "Success";
		}else{
			print_r($errors);
		}
	}
	echo "<br>";
	echo "<a href='logout.php'>Logout</a>"; 
	echo "<br>";
	echo "<a href='addcourse.php'>Add Another Course</a>"; 
	echo "<br>";
	echo "<a href='addpic.php?ccode=".$ccode."'>Add Another Pic</a>";
?>