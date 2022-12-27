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
dateCreated date,
PRIMARY KEY (id),
FOREIGN KEY (userID) REFERENCES User(id)
);

CREATE TABLE Recipe(

);