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
	function getPdo() {
		try {
			$dbh = new PDO($this->getDsn(), $this->getUser(), $this->getPass(), $this->getOpts());
			return $dbh;
		} catch (PDOException $e) {
			if ($e->getCode() == 1049) {
				return $e;
			}else{
				echo $e->getMessage();
			}
		}
	}
	function setConn() {
		$this->dbh = $this->getPdo();
		if ($this->dbh instanceof PDOException) {
			if($this->dbh->getCode() == 1049) {
				$this->setDsnNoDbname();
				$this->dbh = $this->getPdo();
			}
		}
	}
	function execSql($loc) {
		$sql = file_get_contents($loc);
		if ($sql === false) {
			echo "Sql file not found";
		}
		try {
			$res = $this->dbh->exec($sql);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	function createDb() {
		// if( 1== 1049) {
		// 	$tp = $this->dbInfo['dbname'];
		// 	$this->dbInfo['dbname'] = null;
		// 	$this->setDsn();
		// 	$this->dbInfo['dbname'] = $tp;
		// }
		$str = 'CREATE DATABASE IF NOT EXISTS `'.$this->dbInfo['dbname'].'`;';
		$this->dbh->exec($str);
		// $sth = $this->dbh->prepare($str);
		// $sth->execute();
	}
	function createTable($cols) {
	/*
		$str = "CREATE TABLE IF NOT EXISTS
			`table`
			(`col1`, `col2`)
		;";
	*/
		$str = 'CREATE TABLE IF NOT EXISTS `'.$dbInfo['table'].'` ('.$cols.');';
		$sth = $this->dbh->prepare($str);
		$sth->execute();
	}
	function select($cols, $opt=null) {
	/*
		$str = "SELECT 
			(`col1`, `col2`)
			FROM
			table
			(:col1, :col2)
		;";
	*/
		$str = 'SELECT '.$cols.' FROM `'.$this->dbInfo['table'].'` '.$opt.';';
		$sth = $this->dbh->query($str);
		return $sth;
	}
	function insert($cols, $val) {
	/*
		$sql = "
			INSERT INTO 
				table
				(col1, col2)
				VALUES
				(:col1, :col2)
		;";
		$arr = array(
			':col1' => $col1,
			':col2' => $col2
		);
		$sth = $this->dbh->prepare($sql);
		$sth->execute($arr);
	*/
		$str = 'INSERT INTO `'.$this->dbInfo['table'].'` ('.$cols.') '.'VALUE ('.$val.');';
		// echo "<br>$str<br>";
		$sth = $this->dbh->prepare($str);
		$sth->execute();
	}
	function update($colVal, $cond) {
		$str = 'UPDATE `'.$this->dbInfo['table'].'` SET '.$colVal.' WHERE '.$cond.';';
		// echo "<br>$str<br>";
		$sth = $this->dbh->prepare($str);
		$sth->execute();
	}
	function delete($cond) {
		$str = 'DELETE FROM `'.$this->dbInfo['table'].'` WHERE '.$cond.';';
		$sth = $this->dbh->prepare($str);
		$sth->execute();
	}
	function getSqlFile($file) {
		$str = PATH.'/'.$file;
		$sth = file_get_contents($str);
		$this->dbh->exec($sth);
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
	$dbconn->setConn();
	$dbconn->execSql($sqlFile);
	// $dbconn->createDb();
	// $dbconn->createTable('events','`id` INT AUTO_INCREMENT NOT NULL,`month` INT NOT NULL,`day` INT NOT NULL,`year` INT NOT NULL,`event` varchar(800) NOT NULL');
	return $dbconn;
}

function srch($dbconn) {
	$sth = $dbconn->select('`id`,`month`,`day`,`year`,`event`');
	$arr = $sth->fetchAll(PDO::FETCH_ASSOC);
	return $arr;
	foreach ($arr as $i => $val) {
		foreach ($val as $i1 => $val2) {
			echo "<p>$val2</p>";
		}
	}
	// print_r($arr);
}

function add($dbconn, $cols, $val) {
	// INSERT INTO `events` (`month`,`day`,`year`,`event`) VALUE (1,2,2016,"hello world");
	// $dbconn->insert('`month`,`day`,`year`,`event`','3,7,2016,"world"');
	$dbconn->insert($cols, $val);
}

function monthConv($val) {
	$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	if ($opt == 'txt') { // converts month to text
		foreach ($month as $i => $v) {
			if ($i+1 == $val) {
				return $v;
			}
		}
	}elseif ($opt == 'num') { // converts month to num
		foreach ($month as $i => $v) {
			if($v == $val) {
				return $i+1;
			}
		}
	}
}