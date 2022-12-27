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
		<h1>Welcome <?php echo $fname; ?> </h1>

		<h3>Your recipe books</h3>
		<?php
			//Getting Recipe Book information from user id
			$getRecipeBooksSQL = "SELECT * FROM RecipeBook
									WHERE userID = $currUser;"; 
			$getRecipeBooks = mysqli_query($conn, $getRecipeBooksSQL);
			if($getRecipeBooks){
				if($getRecipeBooks->num_rows > 0){
					while ($row = $getRecipeBooks->fetch_assoc()){
						$recipeBookID = $row['id'];
						$recipeBookTitle = $row['title'];
						$dateCreatedBook = $row['dateCreated'];
						
						//displays each recipebook the user owns and allows the user to click and take to ViewRecipeBook.php
						echo "<input type='hidden' value='$recipeBookID' id='recipeBookID'/>"; //getting the recipeBook ID number
						echo "<a href='ViewRecipeBook.php'>" . $recipeBookTitle . "</a>";
						
					}
				}
			}

		?>
		

	</body>

</html>