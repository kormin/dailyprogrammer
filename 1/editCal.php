<?php
/**
* Database Connection Information Class
* Author: Tom Abao
* Date Created: May 2, 2016
* Good practice: http://php.net/manual/en/pdo.prepared-statements.php
*/
require_once('../../assets/index.php');

class PdoDb
{
	private $dbInfo = array();
	private $dsn;
	private $opts = array();
	public $dbh;
	function __construct($dbInfo, $opts) {
		$this->setDbInfo($dbInfo);
		$this->setDsn();
		$this->setOpts($opts);
	}
}

function dbConf(){
	$dbInfo['host'] = 'localhost';
	$dbInfo['dbname'] = 'calendar';
	$dbInfo['charset'] ='utf8mb4';
	$dbInfo['user'] = 'root';
	$dbInfo['pass'] = 'root';
	$dbInfo['driver'] = 'mysql';
	$dbInfo['table'] = 'events';
	$sqlFile = 'init.sql';
	$opts = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false
	];
	$dbconn = new PdoDb($dbInfo, $opts);
	return $dbconn;
}
