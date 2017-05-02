<?php

// Created by
// http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/

class DB{
	private $dbh;
	private $error;

	private $stmt;


	public function __construct(){
		$dsn = "mysql:host=" . DATABASE_SERVER . ";dbname=" . DATABASE_NAME;
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		);

		try {
			$this->dbh = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	/**
	 * Query
	 * @param $query
	 */
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	/**
	 * Bind
	 * @param $param
	 * @param $value
	 * @param null $type
	 */
	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	/**
	 * Execute
	 * @return mixed
	 */
	public function execute(){
		return $this->stmt->execute();
	}

	/**
	 * Result Set
	 * @return mixed
	 */
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Single
	 * @return mixed
	 */
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Row Count
	 * @return mixed
	 */
	public function rowCount(){
		return $this->stmt->rowCount();
	}

	/**
	 * Last Insert Id
	 * @return string
	 */
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}

	/**
	 *
	 * Transactions
	 *
	 */
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}

	public function endTransaction(){
		return $this->dbh->commit();
	}

	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}

	/**
	 * Debug Dump Parameters
	 * @return mixed
	 */
	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}
}