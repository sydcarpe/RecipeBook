CREATE TABLE User(
id int NOT NULL AUTO_INCREMENT,
fname varchar(255) NOT NULL,
lname varchar(255) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE RecipeBook(
id INT NOT NULL AUTO_INCREMENT,
title varchar(255) NOT NULL,
userID INT NOT NULL,
dateCreated date NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (userID) REFERENCES User(id)
);

CREATE TABLE Recipe(
id INT NOT NULL AUTO_INCREMENT,
title varchar(255) NOT NULL,
dateCreated date NOT NULL,
servings INT,
cookTime TIME,
review INT,
notes TEXT,
userID INT NOT NULL,
bookID INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (userID) REFERENCES User(id),
FOREIGN KEY (bookID) REFERENCES RecipeBook(id)
);

CREATE TABLE Ingredients(
id INT NOT NULL AUTO_INCREMENT,
title varchar(255) NOT NULL, 
quantity DECIMAL,
measurement varchar(50),
recipeID INT NOT NULL, 
PRIMARY KEY (id),
FOREIGN KEY (recipeID) REFERENCES Recipe(id)
);

CREATE TABLE Steps(
id INT NOT NULL AUTO_INCREMENT, 
details TEXT,
count INT,
recipeID INT,
PRIMARY KEY (id),
FOREIGN KEY (recipeID) REFERENCES Recipe(id)
);

INSERT INTO User(fname, lname)
VALUES ("Sydney", "Carpenter");

INSERT INTO RecipeBook(title, userID, dateCreated)
VALUES ("My First Recipe Book", 1, '2022-12-27');

INSERT INTO Recipe(title, dateCreated, servings, cookTime, review, notes, userID, bookID)
VALUES ("Fried Egg", '2022-12-27', 1, '00:02:00', 5, "Cooks REALLY fast!", 1, 1);

INSERT INTO Ingredients(title, quantity, measurement ,recipeID)
VALUES ("Egg", 1, "", 1),
		("Oil", 1, "tablespoon", 1);

INSERT INTO Steps(details, recipeID, count)
VALUES ("Crack an egg into a small bowl or ramekin and place it near the stove. Warm your skillet over medium-high heat until it’s hot enough that a drop of water sizzles rapidly on contact.", 1),
	("Reduce the heat to medium and add the olive oil to the pan. Gently tilt the pan around so the olive oil covers the base of the pan. The olive oil should be so warm that it shimmers on the pan (if not, give it a little more time to warm up).", 1),
	("Carefully pour the egg into the skillet and watch out for hot oil splatters ", 1),
	("Let the egg cook, gently tilting the pan occasionally to redistribute the oil, until the edges are crisp and golden and the yolk is cooked to your liking, about 2 minutes for runny yolks or 2 ½ to 3 minutes for medium yolks.", 1),
	("Transfer the cooked egg(s) to a plate. If you’d like to cook more eggs in the same skillet, add another drizzle of olive oil, leave the heat at medium ", 1);
