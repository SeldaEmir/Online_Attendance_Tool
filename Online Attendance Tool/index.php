<br><br><br>
<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'header.php';
//include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
//	$user = new User();
	
	//Insert or update user data to the database
	$gpUserData = array(
		'oauth_provider'=> 'google',
		'oauth_uid'     => $gpUserProfile['id'],
		'first_name'    => $gpUserProfile['given_name'],
		'last_name'     => $gpUserProfile['family_name'],
		'email'         => $gpUserProfile['email'],
		);
//    $userData = $user->checkUser($gpUserData);

	$s = substr($gpUserProfile['email'], strpos($gpUserProfile['email'], "@") + 1); 
	if ($s=='gmail.com' OR $s=='std.sehir.edu.tr'){
	
		$userData = $gpUserData;
	//Storing user data into session
		$_SESSION['userData'] = $userData;
	}	
	
	//Render Lecturer data
	if(($s=='gmail.com') && !empty($userData)){
		$output = '<h1>Sehir Lecturer Profile Details </h1>';
		$output .= '<br/>Google ID : ' . $userData['oauth_uid'];
		$output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
		$output .= '<br/>Email : ' . $userData['email'];
		$output .= '<br/>Logged in with Lecturer Account';
		//$output .= '<br/>Logout from <a href="logout.php">Logout</a>'; 
		//$output .= '<br/><a href="addcourse.php">Add Course</a>'; 
		//$output .= '<br/><a href="listcourse.php">List Course</a>';
	}
	else if(($s=='std.sehir.edu.tr')&& !empty($userData)){
	
		$output = '<h1>Sehir Profile Details </h1>';
		$output .= '<br/>Google ID : ' . $userData['oauth_uid'];
		$output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
		$output .= '<br/>Email : ' . $userData['email'];
		$output .= '<br/>Logged in with : Sehir Account';
		//$output .= '<br/>Logout from <a href="logout.php">Logout</a>'; 
//		$output .= '<br/><a href="addcourse.php">Add Course</a>'; 
		//$output .= '<br/><a href="listcourse.php">List Course</a>';
	}
	else{
		$output = '<h3 style="color:red">You have to try login with Sehir account not with: ' .$gpUserProfile['email']. ' It is ' .$s.' Account </h3>';
	}
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<center><a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a></center>';
	echo "<center><b> Login with Sehir Account</b></center>";
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login with Sehir using PHP</title>
	<style type="text/css">
	h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
	</style>
</head>
<body>
	<div><?php echo $output; ?></div>
</body>
</html>