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

$query = "SELECT id FROM users WHERE  username='".$username."'";
$result = $conn->query($query)->fetch_assoc();

if(empty($result)){
	die('username');
}

$userid = $result['id'];

$friend_requests = array();

$query = "SELECT users.id, username, firstname, lastname, accepted FROM users RIGHT JOIN friends ON users.id = sender_id WHERE (friend_id = '".$userid."' AND accepted='0');";
$result = $conn->query($query);
while($row = $result->fetch_assoc()){
	$row['accepted'] = '2';
	array_push($friend_requests, $row);
}

die(json_encode($friend_requests));
?>
