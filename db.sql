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

INSERT INTO User(fname, lname)
VALUES ("Sydney", "Carpenter");

INSERT INTO RecipeBook(title, userID, dateCreated)
VALUES ("My First Recipe Book", 1, '2022-12-27');

INSERT INTO Recipe(title, dateCreated, servings, cookTime, review, notes, userID, bookID)
VALUES ("Fried Egg", '2022-12-27', 1, '00:02:00', 5, "Cooks REALLY fast!", 1, 1);

INSERT INTO Ingredients(title, quantity, measurement ,recipeID)
VALUES ("Egg", 1, "", 1),
		("Oil", 1, "tablespoon", 1);