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
		<!--TODO
		*display user name
		*display all recipeBooks that the user owns
			*when clicked, take to ViewRecipeBook.php
		*add new recipeBooks
			*when clicked take to createRecipeBook.php
		-->
		<h1> <?php echo $recipeBookTitle; ?> </h1>
		<div class='recipeBookContainer'>
			<div class='individualRecipe'>
				<form action='viewRecipe.php' method='POST'>
				<!--Displaying all the recipes that are in this recipe book and getting recipe information-->
					<?php 
						$getRecipesSQL = "SELECT * FROM Recipe WHERE bookID = $recipeBookID;";
						$getRecipes = mysqli_query($conn, $getRecipesSQL);

						if($getRecipes){
							if($getRecipes->num_rows > 0){
								while($row = $getRecipes->fetch_assoc()){
									$recipeID = $row['id'];
									$recipeTitle = $row['title'];
									$recipeCreated = $row['dateCreated'];
									$servings = $row['servings'];
									$cookTime = $row['cookTime'];
									$recipeReview = $row['review'];
									$recipeNotes = $row['notes'];
									$recipeImgLocation = $row['imgLocation'];

						
									echo "<input type='hidden' value='$recipeID' name='recipeID'/>"; //getting the recipeID number
									echo "<button type='submit'> <img src='". $recipeImgLocation ."' </button>";
									echo "<h3>". $recipeTitle ."</h3>";
								}
							}
						}
					?>
				</form>
			</div>
		</div>
		
		<form action='createNewRecipe.php' method='POST'>
			<input type='hidden' value='<?php echo $recipeBookID; ?>' name='recipeBookID'/>
			<button type='submit' class='newRecipeBtn'>Create New Recipe</button>
		</form>

	</body>

</html>