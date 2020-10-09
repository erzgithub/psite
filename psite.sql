CREATE DATABASE  IF NOT EXISTS psite2;
use psite2;
CREATE TABLE IF NOT EXISTS tbl_persons(
	ID INT  AUTO_INCREMENT,
	FirstName VARCHAR(50) ,
	MiddleName VARCHAR(2),
	LastName VARCHAR(50) ,
	Gender VARCHAR(50) ,
	Email VARCHAR(50),
	Address LONGTEXT ,
	TelephoneNo VARCHAR(20) ,
	CellphoneNo VARCHAR(15) ,
	School VARCHAR(255) ,
	Individual VARCHAR(150) ,
	Institutional VARCHAR(150) ,
	Region VARCHAR(20),
	DateRegistered DATE,
	Signature LONGTEXT,
	isPicked INT,
	VotePoints INT,
	TotalVotes INT,
	isCandidate INT,
	Password VARCHAR(255),
	AllowedToVote INT,
	hasVoted INT,
	PRIMARY KEY(ID)
)Engine=InnoDb Default Charset=utf8;

CREATE TABLE IF NOT EXISTS tbl_profiles(
	ID INT  AUTO_INCREMENT,
	ImageID INT,
	Image LONGBLOB,
	PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT Charset=utf8;

CREATE TABLE IF NOT EXISTS tbl_votehistory(
	ID INT  AUTO_INCREMENT,
	voterID INT,
	VoterName VARCHAR(255),
	CandidateID INT,
	CandidateName VARCHAR(255),
	PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT Charset=utf8;

CREATE TABLE IF NOT EXISTS tbl_regions(
	ID INT  AUTO_INCREMENT,
	RegionName VARCHAR(255),
	PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT Charset=utf8;


CREATE TABLE IF NOT EXISTS tbl_uadmin(
	ID INT  AUTO_INCREMENT,
	Username VARCHAR(255),
	Password CHAR(128),
	salt CHAR(128),
	PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT Charset=utf8;

CREATE TABLE IF NOT EXISTS tbl_settings(
	ID INT  AUTO_INCREMENT,
	SettingName VARCHAR(255),
	SettingValue INT,
	PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT Charset=utf8;

CREATE TABLE IF NOT EXISTS tbl_login_attempts(
	ID INT  AUTO_INCREMENT,
	User_ID INT,
	Time VARCHAR(30),
	PRIMARY KEY(ID)
)Engine=InnoDb DEFAULT Charset=utf8;