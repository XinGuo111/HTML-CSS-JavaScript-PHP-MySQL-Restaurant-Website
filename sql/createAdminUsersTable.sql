CREATE TABLE adminusers(
	AdminID int not null AUTO_INCREMENT,
	Username VARCHAR(50),
	Password VARCHAR(50),
        Lastlogin DATE,
	PRIMARY KEY (AdminID)
	);

INSERT INTO adminusers (Username,Password)
   VALUES ('admin','passme');