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
$friendID = $data['id'];
$myUsername = $data['myUsername'];

$query = "SELECT id FROM users WHERE  username='".$myUsername."'";
$result = $conn->query($query)->fetch_assoc();

if(empty($result)){
	die('username');
}

$userID = $result['id'];

$query = "DELETE FROM friends WHERE (friend_id = '".$friendID."' AND sender_id = '".$userID."') OR (friend_id ='".$userID."' AND sender_id='".$friendID."');";
$conn->query($query);

die('removed-friend');
?>
