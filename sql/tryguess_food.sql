CREATE DATABASE tryguess_food;

USE tryguess_food;

CREATE TABLE College
( College_ID INT UNSIGNED NOT NULL PRIMARY KEY,
  College_Name CHAR(50) NOT NULL
);

CREATE TABLE Student
( Student_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  First_Name CHAR(30) NOT NULL,
  Last_Name CHAR(30) NOT NULL,
  Password CHAR(20) NOT NULL,
  Faculty CHAR(100) NOT NULL,
  College_ID INT UNSIGNED NOT NULL,

  FOREIGN KEY (College_ID) REFERENCES College(College_ID)
);

CREATE TABLE Restaurant
( Restaurant_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Restaurant_Name CHAR(100) NOT NULL,
  Restaurant_Type CHAR(50) NOT NULL,
  Restaurant_hours CHAR(20) NOT NULL,
  College_ID INT UNSIGNED NOT NULL,

  FOREIGN KEY (College_ID) REFERENCES College(College_ID)
);

CREATE TABLE FoodOrder
( Order_ID CHAR(50) NOT NULL  PRIMARY KEY,
  Order_No CHAR(50) NOT NULL,
  Student_ID INT UNSIGNED NOT NULL,
  Order_Date DATE ,
  Pickup_Date DATE ,
  Order_Status CHAR(20) NOT NULL,
  Food_ID INT UNSIGNED NOT NULL,
  Restaurant_ID INT UNSIGNED NOT NULL,
  Quantity INT UNSIGNED,
  Total_Price FLOAT(4,2),

  FOREIGN KEY (Student_ID) REFERENCES Student(Student_ID),
  FOREIGN KEY (Food_ID) REFERENCES Food(Food_ID),
  FOREIGN KEY (Restaurant_ID) REFERENCES Restaurant(Restaurant_ID)
);

CREATE TABLE Food
(  Food_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   Restaurant_ID INT UNSIGNED NOT NULL,
   Food_Name CHAR(100) NOT NULL,
   Food_Price FLOAT(4,2),

   FOREIGN KEY (Restaurant_ID) REFERENCES Restaurant(Restaurant_ID)
);

CREATE TABLE Invious
(  Invious_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   Restaurant_ID INT UNSIGNED NOT NULL,
   Food_Name CHAR(100) NOT NULL,
   Food_Price FLOAT(4,2),

   FOREIGN KEY (Restaurant_ID) REFERENCES Restaurant(Restaurant_ID)
);