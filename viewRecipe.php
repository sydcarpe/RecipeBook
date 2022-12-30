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

//getting recipeID information
$recipeID = htmlspecialchars($_POST['recipeID']);

//getting the recipe information
$getRecipesSQL = "SELECT * FROM Recipe WHERE id = $recipeID;";
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
			$recipeBookID = $row['bookID'];
		}
	}
}

//getting the recipeBook information
$getRecipeBookInfoSQL = "SELECT * FROM RecipeBook WHERE id = $recipeBookID;";
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
		<link rel="stylesheet" href="css/recipe.css">

		<!--Font stylesheets-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	</head>

	<body>
	<!--Nav bar information-->
		<div class='navBar'> 
			<form action='index.php'>
				<button type='submit'> Home </button>
			</form>

			<form action='viewRecipeBook.php' method='POST'>
				<?php
					echo "<input type='hidden' value='$recipeBookID' name='recipeBookID'/>"; //getting the recipeID number
					echo "<button type='submit'>" . $recipeBookTitle . "</button>";
				?>
			</form>
		</div>

		<div class='bodyContainer'>
			<div class='recipeContainer'>
				<h1> <?php echo $recipeTitle; ?> </h1>

				<!--
				<div class='editRecipeContainer'>
					<form action='editRecipe.php' method='POST'>					
						<button type='submit'>Edit Recipe</button>
						<input type='hidden' value = '<?php echo $recipeID; ?>' name='recipeID'/>
					</form>
				</div>
				-->

				<!--Displaying top recipe Info, picture, title-->
				<?php 
					echo "<div class='recipeInfo'>";
						echo "<p> servings: " . $servings . "</p>";
						echo "<p> cook time: " . $cookTime . "</p>";
						echo "<p>" . $recipeReview . "/5 </p>";
					echo "</div>";

					//showing the image
					echo "<img src='". $recipeImgLocation ."' />";
				?>

				<!--Ingredients section-->

				<div class='IngredientsSection'>
					<h3>Ingredients</h3>
					<ul>
						<?php
							//Get all the ingredients and steps
							$getIngreidentsSQL = "SELECT * FROM Ingredients WHERE recipeID = $recipeID;";
							$getIngreidents = mysqli_query($conn, $getIngreidentsSQL);
			
							if($getIngreidents){
								if($getIngreidents->num_rows > 0){
									while($row = $getIngreidents->fetch_assoc()){
										$ingreidentID = $row['id'];
										$ingreidentTitle = $row['title'];
										$ingreidentQuantity = $row['quantity'];
										$measurement = $row['measurement'];

										echo "<li>". $ingreidentQuantity . " " . $measurement . " " .  $ingreidentTitle . "</li>";
									}
								}
							}

						?>
					<ul>
				</div>

				<!--Steps section-->
				<div class="stepsContainer">
					<h3>Steps</h3>
					<ol>
						<?php 
							//get all the Steps
							$getStepsSQL = "SELECT * FROM Steps WHERE recipeID = $recipeID;";
							$getSteps = mysqli_query($conn, $getStepsSQL);

							if($getSteps){
								if($getSteps->num_rows > 0){
									while($row = $getSteps->fetch_assoc()){
										$stepID = $row['id'];
										$stepDetails = $row['details'];
										$count = $row['count'];

										echo "<li>" . $stepDetails . "</li>";
									}
								}
							}
						?>
		
					</ol>
				</div>

				<!--Notes section
				add edit notes section
				-->
				<div class='notesSection'>
					<h3>Notes </h3>
					<?php echo "<p>" . $recipeNotes . "</p>"; ?>
				</div>
				
			</div>
			
		
		</div>

		
		
	</body>

</html>