<br><br><br>
<html><body><center>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Course Code</th>
<th class="text-left">Images</th>
<th class="text-left">Students</th>
</tr>
</thead>
<?php
//Include GP config file
require_once "./connection.php";
include_once 'gpConfig.php';
include_once 'header.php';

$s = $_SESSION['userData']['email'];
$result = mysql_query("SELECT * FROM courses where username = '".$s."'");
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		echo "<tr>";
		echo "<td>";
		echo $row{'course_code'};
		echo "</td>";
		echo "<td>";
		echo "<a href='addpic.php?ccode=".$row{'course_code'}."'>";
		echo "Manage Images";
		echo "</a>";
		echo "</td>";
		echo "<td>";
		echo "<a href='listStudents.php?courseCode=".$row{'course_code'}."'>";
		echo "See Students";
		echo "</a>";
		echo "</td>";
		echo "</tr>";
		}
echo "</table></center></body></html>";



?>
