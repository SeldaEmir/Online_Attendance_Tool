<?php
require_once "./connection.php";
include_once 'gpConfig.php';
//echo "asd";
//var_dump($_GET);
$taggedStudent = $_GET['user'];
$classCode = $_GET['code'];
$image = $_GET['image'];
$tagPosId = $_GET['id'];
if(isset($_SESSION['userData']['email']) && (strpos($_SESSION['userData']['email'], 'gmail.com') !== false)  ){
	$result = "Teachers cant tag!";

}
else if(mysql_num_rows(mysql_query("SELECT * FROM tags where  classCode = '".$classCode."' and  image = '".$image."' and tagPosId = '".$tagPosId."' "))>0) {
	$result = "This face already tagged!";
}
else if (mysql_num_rows(mysql_query("SELECT * FROM tags where  classCode = '".$classCode."' and  image = '".$image."' and taggedStudent = '".$taggedStudent."' "))>0){
	$result = "You cant tag yourself on more than once!";
}
else{
	
	if(mysql_query(" INSERT INTO tags (taggedStudent,classCode,image,tagPosId) VALUES ('$taggedStudent','$classCode','$image','$tagPosId')")){
		$result = "Your tag has been added successfully!";
	}else{
		$result = "Failed to add tag!";
	}
}
echo $result;
?>
