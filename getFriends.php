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

$query = "SELECT * FROM friends WHERE sender_id ='".$userid."' OR friend_id='".$userid."';";
$result = $conn->query($query)->fetch_all();

$friendIDs = array();

foreach($result as $friend){
	//if friend request accepted
	if($friend[3] == '1'){
		//push the id to array that isn't ours
		if($friend[1] == $userid){
	                array_push($friendIDs, $friend[2]);
       		}else{
			array_push($friendIDs, $friend[1]);
		}
	}
}

$data = array();

//finally grab friend's data
foreach($friendIDs as $id){
	$query = "SELECT id,firstname,lastname,profile_picture_id FROM users WHERE id='".$id."';";
	$result = $conn->query($query)->fetch_assoc();
	array_push($data, $result);
}
die(json_encode($data));
?>
