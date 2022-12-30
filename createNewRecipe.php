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

//getting recipeBookID information
$recipeBookID = htmlspecialchars($_POST['recipeBookID']);

//getting Recipe Book information from id
$getRecipeBookInfoSQL = "SELECT * FROM RecipeBook
						WHERE id = $recipeBookID;";
$getRecipeBookInfo = mysqli_query($conn, $getRecipeBookInfoSQL);
if($getRecipeBookInfo){
	if($getRecipeBookInfo->num_rows > 0){
		while($row = $getRecipeBookInfo->fetch_assoc()){
			$recipeBookTitle = $row['title'];
			$dateCreatedBook = $row['dateCreated'];
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head> 
		<link rel="stylesheet" href="css/index.css" >

		<!--Font stylesheets-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	</head>

	<body>
		<form action='insertNewRecipe.php' method='POST'>
			<input type='text' name='recipeName' placeholder='Recipe Name' required/>* 
			</br>
			<input type='text' name='recipeServings' placeholder='Servings'/>
			</br>
			<!--Need to change this to be time lapsed-->
			<input type='text' name='recipeCookTime' placeholder='Cook Time'/>


		</form>

	</body>

</html>