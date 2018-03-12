<br><br><br>
<?php
//Include GP config file
require_once "./connection.php";
include_once 'gpConfig.php';
include_once 'header.php';
$s = $_SESSION['userData']['email'];
$p = substr($_SESSION['userData']['email'], strpos($_SESSION['userData']['email'], "@") + 1);
echo "<html><body><center>";
?>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Course Code</th>
<th class="text-left">Attendance</th>
</tr>
</thead>
<tbody class="table-hover">
<?php 
if(($p=='std.sehir.edu.tr') && !empty($s)){
	$result = mysql_query("SELECT * FROM list where e_mail = '".$s."'");
}else {
		$result = mysql_query("SELECT * FROM courses where username = '".$s."'");
}
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	echo "<tr>";
	echo "<td>";
	echo "<a href='showcourse.php?ccode=".$row{'course_code'}."'>";
	echo $row{'course_code'};
	echo "</a>";
	echo "</td>";
	$currentUploadedImageCount = mysql_num_rows(mysql_query("SELECT * FROM picture where    code = '".$row['course_code']."'  "));
	$currentAttendanceCount = mysql_num_rows(mysql_query("SELECT * FROM tags where   taggedStudent = '".$s."' and classCode = '".$row['course_code']."' "));
	if($currentUploadedImageCount>0){
	$attendance = "%".floor($currentAttendanceCount / $currentUploadedImageCount*100);
	}else{
		$attendance = "%0";
	}
	//echo $currentUploadedImageCount;
	echo "<td>";
	echo $attendance;
	echo "</td>" ;
	echo "</tr>";
}
?>
</tbody>
</table>
<?php
echo "</center></body></html>";
?>