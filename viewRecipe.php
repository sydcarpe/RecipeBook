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

		<?php 
			echo "<h1>" . $recipeTitle . "</h1>";
			echo "<img src='". $recipeImgLocation ."' />";
		
			echo "<p> servings: " . $servings . "</p>";
			echo "<p> cook time: " . $cookTime . "</p>";
			echo "<p> Your review: " . $recipeReview . "</p>";
		?>

		<!--Ingredients section-->
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

							echo "<li>". $ingreidentTitle . "</li>";
						}
					}
				}

			?>
		<ul>

		<!--Steps section-->
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
		
	</body>

</html>