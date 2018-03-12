<?php
require_once "./connection.php";
include_once 'gpConfig.php';

extract($_POST);

$s = $_SESSION['userData']['email'];

$myfile = fopen($file, "rb") or die("Unable to open file!");


while($row = fgets($myfile)) {
  list(  $name, $surname, $ID, $e_mail  ) = explode( ",", $row );
  $email=trim($e_mail);
  mysql_query("INSERT INTO list (course_code,name,surname,ID,e_mail) VALUES ('$ccode','$name','$surname','$ID','$email')");
  
}
fclose($myfile);


mysql_query("INSERT INTO courses (username, course_name, course_code, semester, week_number, weekly_hour) VALUES ('$s','$cname','$ccode','$semester','$week_number','$weekly_hour')");
echo "You have succesfully saved your course. To add picture your courses please click <a href='addcourse.php'>here</a> ";
mkdir("images1/".$ccode);




?>
