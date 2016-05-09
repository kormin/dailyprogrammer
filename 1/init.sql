/**
 * Database creation script
 * Author: Tom Abao
 * Date Created: May 3, 2016
 * Description: This script currently utilizes mysql commands
 * http://php.net/manual/en/language.operators.execution.php
 */

CREATE DATABASE IF NOT EXISTS `calendar`;
use `calendar`;

CREATE TABLE IF NOT EXISTS `events` (
	`id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	`month` INT NOT NULL,
	`day` INT NOT NULL,
	`year` INT NOT NULL,
	`event` varchar(800) NOT NULL
);

-- INSERT INTO `events` (`month`,`day`,`year`,`event`) VALUE (1,2,2016,"hello world");