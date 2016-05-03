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
	function setDbInfo($dbInfo) {
		foreach ($dbInfo as $key => $value) {
			$this->dbInfo[$key] = $value;
		}
	}
	function setDsnNoDbname() {
		if ($this->dbInfo['driver'] == 'mysql') {
			$this->dsn = "mysql:host=".$this->dbInfo['host'].";charset=".$this->dbInfo['charset'];
		}
	}
	function setDsn() {
		if ($this->dbInfo['driver'] == 'mysql') {
			$this->dsn = "mysql:host=".$this->dbInfo['host'].";dbname=".$this->dbInfo['dbname'].";charset=".$this->dbInfo['charset'];
		}else if($this->dbInfo['driver'] == 'sqlite') {
			$this->dsn = "sqlite:".$this->dbInfo['path']."/".$this->dbInfo['dbname'].".sqlite3";
		}else if($this->dbInfo['driver'] == 'pgsql') {
			$this->dsn = "pgsql:host=".$this->dbInfo['host'].";port=".$this->dbInfo['port'].";dbname=".$this->dbInfo['dbname'].";user=".$this->dbInfo['user'].";password=".$this->dbInfo['pass'].";";
		}else{
			echo "Your database driver is unavailable.";
		}
	}
	function setOpts($opts) {
		$this->opts = $opts;
	}
	function getDsn() {
		return $this->dsn;
	}
	function getUser() {
		return $this->dbInfo['user'];
	}
	function getPass() {
		return $this->dbInfo['pass'];
	}
	function getOpts() {
		return $this->opts;
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
