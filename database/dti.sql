CREATE DATABASE IF NOT EXISTS Persons;
USE Persons;
CREATE TABLE IF NOT EXISTS tbl_persons(
	ID INT AUTO_INCREMENT,
	FirstName VARCHAR(255),
	LastName VARCHAR(255),
	OfficeOrCompany VARCHAR(255),
	Position VARCHAR(255),
	EmailAddress VARCHAR(255),
	TrackNo INT(11),
	Classification VARCHAR(255),
	DateRegistered DATETIME,
	TimeRegistered VARCHAR(50),
	PersonSign LONGTEXT,
	PRIMARY KEY(ID)
);
CREATE TABLE IF NOT EXISTS tbl_classification(
	ID INT AUTO_INCREMENT,
	Classification VARCHAR(255),
	Description LONGTEXT,
	PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS tbl_persons(
		ID INT AUTO_INCREMENT,
		FirstName VARCHAR(200) NOT NULL,
		LastName VARCHAR(200) NOT NULL,
		Coop VARCHAR(200),
		Designation VARCHAR(200),
		EducationalAttaintment VARCHAR(255),
		Course VARCHAR(255),
		Gender VARCHAR(50),
		PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT CHARSET=UTF8;