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

//Step(details)
$nextStepDesc = htmlspecialchars($_POST['step']);

//inserting the step into the next step
//first have to get the amount of steps for the current recipe

$getCurrStepsSQL = "SELECT COUNT(id) FROM Steps WHERE recipeID = $recipeID;";
$getCurrSteps = mysqli_query($conn, $getCurrStepsSQL);

if($getCurrSteps){
	if($getCurrSteps->num_rows > 0){
		while($row= $getCurrSteps->fetch_assoc()){
			$numOfSteps = $row['COUNT(id)'];
			echo "Num of curr steps: " . $numOfSteps . "</br>";
		}
	}
}

//setting the next step to be the very last step in the list
//else sets the num to 1 if this is the first step inputed. 
if($numOfSteps >= 1){
	$nextStepNum = $numOfSteps + 1;
	echo "Next Step: " . $nextStepNum . "</br>";
} else{
	$nextStepNum = 1;
	echo "Next Step: " . $nextStepNum . "</br>";
}


//inserting the Steps
$insertStepsSQL = "INSERT INTO Steps(details, recipeID, count)
					VALUES('$nextStepDesc', $recipeID, $nextStepNum);";
$insertSteps = mysqli_query($conn, $insertStepsSQL);

if($insertSteps){
	//  header('Location: editRecipe.php?=2');
	//exit();
}



?>