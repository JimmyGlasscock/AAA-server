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
$firstname = $data['firstname'];
$lastname = $data['lastname'];
$email = $data['email'];

$query = "SELECT id FROM users WHERE username ='".$username."'";
$result = $conn->query($query)->fetch_all();

if(!empty($result)){
	die('username');
}

$query = "INSERT INTO users (username, password, firstname, lastname, email) VALUES ('".$username."','".sha1($password)."','".$firstname."','".$lastname."','".$email."');";
$conn->query($query);

die('success');
?>
