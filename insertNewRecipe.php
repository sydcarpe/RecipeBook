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

//getting todays date
$currentDate = date('Y-m-d');

//getting the inserting information from the users
$recipeBookID = htmlspecialchars($_POST['recipeBookID']);
$recipeName = htmlspecialchars($_POST['recipeName']);
$recipeServings = htmlspecialchars($_POST['recipeServings']);
$recipeCookTime = htmlspecialchars($_POST['recipeCookTime']);
$recipeReview = htmlspecialchars($_POST['recipeReview']);
$recipeNotes = htmlspecialchars($_POST['recipeNotes']);
$recipeImg = htmlspecialchars($_POST['recipeImg']);

//checking if this is blank. Don't know if i need it
/*
if($recipeServings = ""|| trim($recipeServings) == ''){
	$recipeServings = NULL;
}
if($recipeServings = ""|| trim($recipeServings) == ''){
	$recipeServings = NULL;
}
if($recipeServings = ""|| trim($recipeServings) == ''){
	$recipeServings = NULL;
}
*/

$insertRecipeSQL = "INSERT INTO Recipe(title, dateCreated, servings, cookTime, review, notes, userID, bookID)
					VALUES ('$recipeName', '$currentDate', $recipeServings, '$recipeCookTime', $recipeReview, '$recipeNotes', $currUser, $recipeBookID);";

$insertRecipe = mysqli_query($conn, $insertRecipeSQL);

if($insertRecipe){
	echo "SORRY FOR PARTY ROCKIN! It worked";
} else {
	echo "ERROR: " . $insertRecipe -> error;
}
?>