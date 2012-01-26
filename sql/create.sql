CREATE TABLE users (
    ID int(10) PRIMARY KEY auto_increment,
    Username varchar(50) NOT NULL,
    Password varchar(35) NOT NULL,
    PasswordSalt varchar(5) NOT NULL,
    FirstName varchar(50) NOT NULL,
    LastName varchar(50) NOT NULL,
    EmailAddress varchar(150) NOT NULL,
    YubiKey tinyint(1) NOT NULL DEFAULT 0,
    YubiKeyServer int(5) NULL DEFAULT 0,
    DateC timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    LastLogin timestamp NULL,
    Admin tinyint(1) NOT NULL DEFAULT 0,
    Disabled tinyint(1) NOT NULL DEFAULT 0
) ENGINE = InnoDB;

CREATE TABLE yubikey_servers (
    ID int(5) PRIMARY KEY auto_increment,
    ServerURL varchar(150) NOT NULL,
    APIID varchar(50) NOT NULL,
    APIKey varchar(50) NOT NULL,
    Enabled tinyint(1) NOT NULL DEFAULT 1
) ENGINE = InnoDB;

CREATE TABLE yubikey_authkeys (
    ID int(10) PRIMARY KEY auto_increment,
    UserID int(10) NOT NULL, # Need to make this a foreign key.
    KeyID varchar(12) NOT NULL,
    Enabled tinyint(1) NOT NULL DEFAULT 1
) ENGINE = InnoDB;

CREATE TABLE projects (
    ID int(10) PRIMARY KEY auto_increment,
    UserID int(10) NOT NULL, # Need to make this a foreign key.
    ProjectName varchar(50) NOT NULL,
    IssueEnable tinyint(1) NOT NULL DEFAULT 0,
    TodoEnable tinyint(1) NOT NULL DEFAULT 0
) ENGINE = InnoDB;

ALTER TABLE users ADD INDEX (YubiKeyServer);
ALTER TABLE users ADD FOREIGN KEY (YubiKeyServer) REFERENCES yubikey_servers(ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE yubikey_authkeys ADD INDEX (UserID);
ALTER TABLE yubikey_authkeys ADD FOREIGN KEY (UserID) REFERENCES users(ID) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE projects ADD INDEX (UserID);
ALTER TABLE projects ADD FOREIGN KEY (UserID) REFERENCES users(ID) ON DELETE CASCADE ON UPDATE CASCADE;