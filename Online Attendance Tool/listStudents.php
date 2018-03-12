<br><br><br>
<html><body><center>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Student Name</th>
<th class="text-left">Attendance</th>
</tr>
</thead>
<?php 
require_once "./connection.php";
include_once 'gpConfig.php';
include_once 'header.php';
$courseCode = $_GET['courseCode'];
$course = mysql_fetch_assoc( mysql_query(" SELECT * FROM courses where course_code = '".$courseCode."' "));
$queryResult = mysql_query(" SELECT * FROM list where course_code = '".$courseCode."' ");
$currentUploadedImageCount = mysql_num_rows(mysql_query("SELECT * FROM picture where    code = '".$courseCode."'  "));

while( $row = mysql_fetch_assoc( $queryResult)){
	$currentAttendanceCount = mysql_num_rows(mysql_query("SELECT * FROM tags where   taggedStudent = '".$row['e_mail']."' and classCode = '".$courseCode."' "));
	$resultArray[] = array("attendanceCount"=>$currentAttendanceCount, "lessonCount" => $currentUploadedImageCount, "studentName" => $row['e_mail']) ;
}
if(isset($resultArray)){
	foreach ($resultArray as $student) {
		//echo"asdasd";
		echo "<tr>";
		echo"<td>";
		echo $student['studentName'];
		echo "</td>";
		echo "<td>";
		if($student['lessonCount']!=0){
			echo "%".floor($student['attendanceCount'] / $student['lessonCount']*100);
		}
		else{
			echo "%0";
		}
		echo "</td>";
		echo "</tr>";
	}
}
?>
</table>
</center>
</body>
</html>




