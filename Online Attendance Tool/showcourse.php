<br><br><br>
<?php
//Include GP config file
require_once "./connection.php";

include_once 'gpConfig.php';
include_once 'header.php';
?>
<html>
<head>
<style>
div.gallery {

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
    height:80%;
}

div.top{
   height:0%;
}

div.bottom{
   height:0%;
}


</style>
</head>

</html>

<?php
$user=$_SESSION['userData']['email'];
//echo $user;
$code = $_GET['ccode']; 

//echo $code;
$result = mysql_query("SELECT * FROM courses where course_code = '".$code."'");
//$result = mysql_query("SELECT * FROM courses where course_code = '".$code."' && username = '".$user."'");
if(isset($result)) {

	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$wn=$row{'week_number'};
	$wh=$row{'weekly_hour'};	
	$rowspan=$wn*$wh;
	echo "<html><body>
	<table border=1>";
	echo "<div class='top'></div>";
	echo "<div class='c750'>";
	for ($k=1;$k<=$wh;$k++){
		echo "<div>";
	for ($i=1;$i<=$wn;$i++){
		
			if(file_exists ( "./images1/".$code."/".$i."w_".$k."c.jpg" )){
				$isTagged = mysql_num_rows(mysql_query("SELECT * FROM tags where  classCode = '".$code."' and  image = '".$i."w_".$k."c.jpg"."' and taggedStudent = '".$user."' "));
				if($isTagged>0){
					$isChecked = "checked=\"checked\"";
				}else{
					$isChecked ="";
				}
				//echo "ISTAGGED:".$isTagged;
				echo "\t\t\t\t<div class=\"gallery\">\r\n\t\t\t\t  <a  href=\"tagImage.php?ccode=".$i."w_".$k."c.jpg&code=".$code."\">\r\n\t\t\t\t    <img src=\"./images1/".$code."/".$i."w_".$k."c.jpg\" alt=\"Mountains\" width=\"300\" height=\"200\">\r\n\t\t\t\t  </a>\r\n\t\t\t\t  <div class=\"desc\"><input type=\"checkbox\" $isChecked 
				disabled> W:".$i."  L:".$k." </div>\r\n\t\t\t\t</div>";
			}else{
				echo "\t\t\t\t<div class=\"gallery\">\r\n\t\t\t\t     <img src=\"./images/no_image.png\" alt=\"Mountains\" width=\"300\" height=\"200\">\r\n\t\t\t\t   <div class=\"desc\"><input type=\"checkbox\" 
				disabled> W:".$i."  L:".$k." </div>\r\n\t\t\t\t</div>";
			}

			}
			echo "</div>";
		}
		echo "<div class='bottom'></div>";
		echo "</div>";
	echo "</tr></table>";
}

//echo "<a href='logout.php'>Logout</a>"; 
//echo "<br>";
//echo "<a href='listcourse.php'>Back</a>"; 
?>



</body>
</html>