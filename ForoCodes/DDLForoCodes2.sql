--Category(P·catID, catName, catDesc)
--Usr(P·userID, userName, userPasswrd, userMail, userDate, userLevel)
--Topic(P·topicID, topicSubject, topicDate, F·catID -> Category, F·userID -> User)
--Reply(P·replyID, replyContent, replyDate, F·topicID -> Topic, F·userID -> User)

CREATE DATABASE foroCodes2;
USE foroCodes2;

CREATE TABLE Category(
	catID INT(2) NOT NULL AUTO_INCREMENT,
	catName VARCHAR(40) NOT NULL,
	catDesc VARCHAR(120),
	PRIMARY KEY (catID)
);

CREATE TABLE Usr(
	userID INT(8) NOT NULL AUTO_INCREMENT,
	username VARCHAR(30) NOT NULL,
	userPasswrd VARCHAR(32) NOT NULL,
	userMail VARCHAR(50) NOT NULL,
	userDate DATETIME,
	userLevel INT(1) NOT NULL,
	PRIMARY KEY (userID)
);

CREATE TABLE Topic(
	topicID INT(4) NOT NULL AUTO_INCREMENT,
	topicName VARCHAR(40) NOT NULL,
	catID INT(2) NOT NULL,
	userID INT(8) NOT NULL,
	topicDate DATETIME NOT NULL,
	PRIMARY KEY (topicID),
	FOREIGN KEY (catID) REFERENCES Category (catID),
	FOREIGN KEY (userID) REFERENCES Usr (userID)
);

CREATE TABLE Reply(
	replyID INT (10) NOT NULL AUTO_INCREMENT,
	topicID INT(4) NOT NULL,
	userID INT(8) NOT NULL,
	replyContent VARCHAR(300) NOT NULL,
	replyDate DATETIME NOT NULL,
	PRIMARY KEY (replyID),
	FOREIGN KEY (topicID) REFERENCES Topic (topicID),
	FOREIGN KEY (userID) REFERENCES Usr (userID)
);


INSERT INTO category (catName, catDesc) VALUES ('Software', 'Rinconsito del Software');
INSERT INTO category (catName, catDesc) VALUES ('Hardware', 'La parte dura');
INSERT INTO category (catName, catDesc) VALUES ('Manga', 'UwU');

INSERT INTO usr (username, userPasswrd, userMail, userLevel) VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 1);