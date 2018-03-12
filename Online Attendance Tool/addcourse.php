<br><br><br>
<?php
//Include GP config file
require_once "./connection.php";

include_once 'gpConfig.php';
include_once 'header.php';

$s = $_SESSION['userData']['email'];

echo "<html><body>
<form action='savecourse.php' method='POST'>
<center><table>
<tr><td> UserName : </td><td>";
echo $_SESSION['userData']['email'];
echo "</td></tr>
<tr><td> Course Code : </td><td><input type='text' name='ccode' id='ccode' /></td></tr>
<tr><td> Course Name : </td><td><input type='text' name='cname' id='cname' /></td></tr>
<tr><td> Semester : </td><td><input type='text' name='semester' id='semester' /></td></tr>
<tr><td> # of Week : </td><td><input type='text' name='week_number' id='week_number' /></td></tr>
<tr><td> Weekly Hour : </td><td><input type='text' name='weekly_hour' id='weekly_hour' /></td></tr>
<tr><td>Filename:</td><td><input type='file' name='file' id='file'/></td></tr>
<tr><td><input type='submit' value='Submit' /> </td><td><input type='reset' value='Clear' /></td></tr>

</table></center>
</form>";
/*

echo "<center><table><tr><td><b>Course List</b></td></tr>";

$result = mysql_query("SELECT * FROM courses where username = '".$s."'");
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		echo "<tr><td>";

		echo "<a href='addpic.php?ccode=".$row{'course_code'}."'>";
		echo $row{'course_code'};
		echo "</a>";
		echo "</td><tr>";
		}
echo "</table></center>";
*/
echo "</body></html>";

?>