<?php
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


//getting the inserting information from the users
$recipeID = htmlspecialchars($_POST['recipeID']);
echo $recipeID;
$nextStep = htmlspecialchars($_POST['step']);

//inserting the step into the next step
//first have to get the amount of steps for the current recipe

$getCurrStepsSQL = "SELECT COUNT(id) FROM Steps WHERE recipeID = 1;";
$getCurrSteps = mysqli_query($conn, $getCurrStepsSQL);

if($getCurrSteps){
	if($getCurrSteps->num_rows > 0){
		while($row= $getCurrSteps->fetch_assoc()){
			$numOfSteps = $row['COUNT(id)'];
		}
	}
}

//echo $numOfSteps;


?>