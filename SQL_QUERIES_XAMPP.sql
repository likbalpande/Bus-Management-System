CREATE DATABASE IF NOT EXISTS Bus_Service_System;
USE Bus_Service_System;
CREATE TABLE IF NOT EXISTS users(
	userId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(25) NOT NULL UNIQUE,
	pass_word VARCHAR(255) NOT NULL,
    email VARCHAR(25),
    firstName VARCHAR(25) NOT NULL,
    lastName VARCHAR(25),
    busPass BIT(1) DEFAULT(0),
    busPassId VARCHAR(25),
    userToken VARCHAR(255)
);

#checking if the use exists with given _email
Select userId from users where email='email'; 

#checking if the use exists with given _username
Select userId from users where userName='likhilesh'; 

#Inserting user__otherway
#INSERT INTO users(userId, userName, pass_word, firstName, lastName) VALUES(UUID(),'likhilesh', 'Pass123', 'Likhilesh', 'Balpande'); 
#userId VARCHAR(255) NOT NULL PRIMARY KEY,

#Inserting user easy way
INSERT INTO users(userName, pass_word, firstName, lastName) VALUES('likhilesh', 'Password', 'Likhilesh', 'Balpande'); 
INSERT INTO users(userName, pass_word, firstName, lastName,userToken) VALUES('Arun', 'abcd', 'Arun', 'Bhatt',UUID()); 
INSERT INTO users(userName, pass_word, firstName, lastName,email,userToken) VALUES('manoj', '1234', 'Manoj', '','manoj@gmail.com',UUID()); 

#Places Table
CREATE TABLE IF NOT EXISTS places(
	placeId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    placeName VARCHAR(50) NOT NULL UNIQUE
);
INSERT INTO places(placeName) VALUES('Nagpur'),('Pune'),('Kolhapur'),('Hubli'),('Dharwad'),('Banglore');


#Buses Table
CREATE TABLE IF NOT EXISTS buses(
	busId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    numberPlate VARCHAR(50) NOT NULL UNIQUE,
    capacity INT default(30) 
);
INSERT INTO buses(numberPlate) VALUES('MH31AK1234'),('MH62RS4567');
INSERT INTO buses(numberPlate) VALUES('KA121234'),('KA10ML6789');

#Routes Table
CREATE TABLE IF NOT EXISTS routes(
	routeId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    startingPoint INT,
    endingPoint INT,
    startingTime DATETIME,
    endingTime DATETIME,
	travelTime INT,
    fare INT,
    busId INT,
    routeStatus INT DEFAULT(1),
    numberOfBookings INT DEFAULT(0),
    FOREIGN KEY(busId) REFERENCES buses(busId) ON DELETE SET NULL,
    FOREIGN KEY(startingPoint) REFERENCES places(placeId) ON DELETE SET NULL,
    FOREIGN KEY(endingPoint) REFERENCES places(placeId) ON DELETE SET NULL
);

#insert into routes table
INSERT INTO routes(startingPoint,endingPoint,startingTime,endingTime,travelTime,fare,busId) VALUES(2,6,'2022-10-05 8:00','2022-10-05 21:00',780,1450,2);
INSERT INTO routes(startingPoint,endingPoint,startingTime,endingTime,travelTime,fare,busId) VALUES(3,4,'2022-10-05 10:00','2022-10-05 16:00',360,550,3),(3,4,'2022-10-05 12:00','2022-10-05 17:00',300,750,4);



#Payment Type Table
CREATE TABLE IF NOT EXISTS payment_type(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

#insert into Payment Type Table
INSERT INTO payment_type(name) VALUES('Cash'),('Debit Card'),('Credit Card'),('UPI');

#customer table
CREATE TABLE IF NOT EXISTS customers(
	customerId VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255),
    phoneNumber VARCHAR(13),
    bookingId INT,
    seatAlloted INT,
    FOREIGN KEY(bookingId) REFERENCES bookings(bookingId) ON DELETE SET NULL
);

INSERT INTO customers(customerId,name,phoneNumber,bookingId,seatAlloted) values('1_1','Cus1','123456',1,9);


#Availability Table
CREATE TABLE IF NOT EXISTS availabile(
	routeId INT UNIQUE PRIMARY KEY,
        seat1 VARCHAR(255),
        seat2 VARCHAR(255),
        seat3 VARCHAR(255),
        seat4 VARCHAR(255),
        seat5 VARCHAR(255),
        seat6 VARCHAR(255),
        seat7 VARCHAR(255),
        seat8 VARCHAR(255),
        seat9 VARCHAR(255),
        seat10 VARCHAR(255),
        FOREIGN KEY(routeId) REFERENCES routes(routeId) ON DELETE SET NULL,
	FOREIGN KEY(seat1) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat2) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat3) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat4) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat5) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat6) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat7) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat8) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat9) REFERENCES customers(customerId) ON DELETE SET NULL,
    FOREIGN KEY(seat10) REFERENCES customers(customerId) ON DELETE SET NULL
);


#Booking Table
CREATE TABLE IF NOT EXISTS bookings(
	bookingId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    routeId INT,
    userId INT,
	numberOfSeats INT DEFAULT(1),
    paymentType INT,
    bookingDate DATETIME DEFAULT(now()),
    FOREIGN KEY(routeId) REFERENCES routes(routeId) ON DELETE SET NULL,
    FOREIGN KEY(userId) REFERENCES users(userId) ON DELETE SET NULL,
    FOREIGN KEY(paymentType) REFERENCES payment_type(id) ON DELETE SET NULL
);

#make a booking
INSERT INTO bookings(routeId,userId,paymentType) values(1,878,4);

#check if the route exists in availability table
SELECT routeId from availability where routeId = 1;

#Make the corrosponding entry in availability table
INSERT INTO availability(routeId) VALUES(1);

UPDATE availability SET seat1=878 WHERE routeId = 1;

UPDATE availability SET seat4=NULL WHERE routeId = 1;

