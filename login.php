<?php

$servername = 'localhost';
$username = 'app';
$password = 'Andr0id43v3r';
$dbname = 'AAA';

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
	die("Connection Failed:" . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'),true);
$username = $data['username'];
$password = $data['password'];

$query = "SELECT password FROM users WHERE username ='".$username."'";
$result = $conn->query($query)->fetch_assoc();

if(empty($result)){
	die('username');
}


if(sha1($password) != $result['password']){
	die('password');
}

//update last login
$query = "UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE username='".$username."';";
$conn->query($query);

die('success');
?>
