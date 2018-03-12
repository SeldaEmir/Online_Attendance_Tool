<?php
require_once "./connection.php";
include_once 'gpConfig.php';
//echo "asd";
//var_dump($_GET);
$classCode = $_GET['code'];
$image = $_GET['image'];

$queryResult = mysql_query("SELECT * FROM tags where  classCode = '".$classCode."' and  image = '".$image."' ");
//$row = mysql_fetch_array($queryResult,MYSQL_ASSOC);
while( $row = mysql_fetch_assoc( $queryResult)){
    $new_array[] = $row; // Inside while loop
}
if(isset($new_array)){
	echo json_encode($new_array);
}
else{
	echo "[]";
}

?>
