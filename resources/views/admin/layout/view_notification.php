<?php
$conn = new mysqli("localhost","root","","ems_db");

$sql="UPDATE leaves SET status=1 WHERE status='PENDING'";	
$result=mysqli_query($conn, $sql);

// $sql="select * from comments ORDER BY id DESC limit 5";
// $result=mysqli_query($conn, $sql);

$response='';
while($row=mysqli_fetch_array($result)) {
	$response = $response . "<div class='notification-item'>" .
	"<div class='notification-subject'>". $row["name"] . "</div>" . 
	"<div class='notification-comment'>" . $row["leave_type"]  . "</div>" .
	"</div>";
}
if(!empty($response)) {
	print $response;
}


?>