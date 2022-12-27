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

						
							echo "<input type='hidden' value='$recipeID' name='recipeID'/>"; //getting the recipeID number
							echo "<button type='submit'>" . $recipeTitle . "</button>";
						}
					}
				}
			?>
		</form>
		

	</body>

</html>