CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `projects` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `ProjectName` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `PasswordSalt` varchar(5) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailAddress` varchar(150) NOT NULL,
  `YubiKey` tinyint(1) NOT NULL DEFAULT '0',
  `YubiKeyRequired` tinyint(1) NOT NULL DEFAULT '0',
  `DateC` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogin` timestamp NULL DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `Disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `yubikey_authkeys` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `ServerID` int(5) NOT NULL,
  `KeyID` varchar(12) NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`),
  KEY `ServerID` (`ServerID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `yubikey_servers` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `ServerURL` varchar(150) NOT NULL,
  `ClientID` int(10) NOT NULL,
  `ClientKey` varchar(50) NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB;


ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `yubikey_authkeys`
  ADD CONSTRAINT `yubikey_authkeys_ibfk_2` FOREIGN KEY (`ServerID`) REFERENCES `yubikey_servers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yubikey_authkeys_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;