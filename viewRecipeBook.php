<?php
// This page is what the user will see when they click on a recipe book, this will display all the recipes in this specific book
$servername = "localhost";
$username = "root";
$password = "Tuna!Fish99";
$db = "recipebook";

session_start();
$conn = new mysqli($servername, $username, $password, $db);

$currUser = 1; //hard coded for now
$sql = "SELECT * FROM User
		WHERE id = $currUser;";
$result = mysqli_query($conn, $sql);

if($conn->connect_errno){
	echo "Error Connecting";
}

//Getting user information
$getUserInfoSQL = "SELECT * FROM User WHERE id = $currUser;";
$getUserInfo = mysqli_query($conn, $getUserInfoSQL);
if($getUserInfo){
	if($getUserInfo->num_rows > 0){
		while($row = $getUserInfo->fetch_assoc()){
			$fname = $row['fname'];
			$lname = $row['lname'];
		}
	}
}
?>