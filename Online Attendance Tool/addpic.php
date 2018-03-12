<html>
<head>
<style>
/*
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 100px;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: 70px;
}

div.desc {
    padding: 15px;
    text-align: center;
}*/
div.gallery {
	/*
    margin: 5px;
    border: 1px solid #ccc;
    width: 100px;*/


    border: 1px solid #ccc;
    width:95px;
    height:90px;
    margin:5px;
    display:inline-block

}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: 60px;
}

div.desc {
    padding: 3px;
    text-align: center;
}

div.c750 {
    padding:20px;
    white-space:nowrap;
    overflow-x:scroll;
    height:80%;

}

div.top{
   height:0%;
}

div.bottom{
   height:0%;
}

div.formfalan{
	height:5%;
}


</style>
</head>
<br><br><br>
<?php
//Include GP config file
require_once "./connection.php";

include_once 'gpConfig.php';
include_once 'header.php';
$user=$_SESSION['userData']['email'];

$code = $_GET['ccode']; 
?>
<body>

<form action='upload.php' method='post' enctype='multipart/form-data'><table border=1>
<div class="formfalan">
<input type="hidden" name = "ccode" value = "<?php echo $code ?>">
<input type="file" name="image" />
<input type="submit" value="Upload Image" name="submit">
<input type="submit" value="Delete Image" name="submit">
<br>
<br>
</div>
<?php
$result = mysql_query("SELECT * FROM courses where course_code = '".$code."' && username = '".$user."'");
if(isset($result)) {
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	echo "<div class='top'></div>";
	echo "<div class='c750'>";

		for ($k=1;$k<=$row{'weekly_hour'};$k++){
			echo "<div>";
	for ($i=1;$i<=$row{'week_number'};$i++){

		
			if(file_exists ( "./images1/".$code."/".$i."w_".$k."c.jpg" )){
				$isTagged = mysql_num_rows(mysql_query("SELECT * FROM tags where  classCode = '".$code."' and  image = '".$i."w_".$k."c.jpg"."' and taggedStudent = '".$user."' "));
				if($isTagged>0){
					$isChecked = "checked=\"checked\"";
				}else{
					$isChecked ="";
				}
				echo "\t\t\t\t<div class=\"gallery\">\r\n\t\t\t\t  <a  href=\"tagImage.php?ccode=".$i."w_".$k."c.jpg&code=".$code."\">\r\n\t\t\t\t    <img src=\"./images1/".$code."/".$i."w_".$k."c.jpg\" alt=\"Mountains\" width=\"300\" height=\"200\">\r\n\t\t\t\t  </a>\r\n\t\t\t\t  <div class=\"desc\"><input type='radio' name='week' value = '".$i."w_".$k."c'/> W:".$i."  Ln:".$k." </div>\r\n\t\t\t\t</div>";
			}else{
				echo "\t\t\t\t<div class=\"gallery\">\r\n\t\t\t\t     <img src=\"./images/no_image.png\" alt=\"Mountains\" width=\"300\" height=\"200\">\r\n\t\t\t\t   <div class=\"desc\"><input type='radio' name='week' value = '".$i."w_".$k."c'/> W:".$i."  L:".$k." </div>\r\n\t\t\t\t</div>";
			}
		}
		echo "</div>";
	}
	echo "<div class='bottom'></div>";
	echo "</div>";
}
?>

</form>

</body>
</html>