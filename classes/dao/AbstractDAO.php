<?php
/**
 * Abstract class for all DAO domain objects.
 * 
 * @author josivanSilva(Developer);
 *
 */
abstract class AbstractDAO {
		
	private $config;
	
	public function __construct() {
		$this->config = new Config();
	}
	
	public function __destruct() {
		$this->disconnect();
		/*foreach ($this as $key => $value) {
			unset ($this->$key);
        }*/
	}
	
	public function connect(){
		try {
			$this->connection = new PDO ($this->config->__get("db.type").":host=".$this->config->__get("db.host").";port=".$this->config->__get("db.port").";dbname=".$this->config->__get("db.name"), $this->config->__get("db.user"), $this->config->__get("db.pwd"));
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		} catch (PDOException $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}		
		return ($this->connection);
	}
	
	public function disconnect() {
		$this->connection = null;
	}
	
	public function insertDb ($sql) {
		$connection = $this->connect ();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			$rs = $connection->lastInsertId() or die (print_r($stmt->errorInfo(), true));			
			//$rs = $connection->lastInsertId();
		} catch (Exception $e) {
			die (print_r($stmt->errorInfo(), true));
		}
		$this->__destruct();
		return $rs;
    }
    
	public function queryDb ($sql) {
    	$connection = $this->connect();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			$rowCount = $stmt->rowCount();
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}
		$this->__destruct();
		return $rowCount;
    }
    
	public function selectDb ($sql, $class = null){
		$connection = $this->connect();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			if (isset ($class)) {
				$rs = $stmt->fetchAll (PDO::FETCH_CLASS, $class);								
			} else {
				$rs = $stmt->fetchAll (PDO::FETCH_OBJ);
			}	
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}		
		$this->__destruct();
		return $rs;
    }
    
	public function selectBlobDb ($sql, $class = null){
		$connection = $this->connect();
		try {
			$stmt = $connection->prepare ($sql);
			$stmt->execute ();
			
			/*** set the fetch mode to associative array ***/
        	$stmt->setFetchMode (PDO::FETCH_ASSOC);
			
			/*** set the header for the image ***/
        	//$array = $stmt->fetch();
        	
			if (isset ($class)) {
				$rs = $stmt->fetchAll (PDO::FETCH_CLASS, $class);								
			} else {
				$rs = $stmt->fetchAll (PDO::FETCH_OBJ);
			}
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}		
		$this->__destruct();
		return $rs;
    }
    
    public function rowCount ($sql) {
    	$stmt = NULL;
		$connection = $this->connect();
		try {
			if ($stmt = $connection->query ($sql)) {
				$rowCount = $stmt->fetchColumn();
			} else {
				$rowCount = 0;
			}
		} catch (Exception $e) {
			die ("Error: <code>" . $e->getMessage() . "</code>");
		}
		$this->__destruct();
		return $rowCount;
    } 
    
}
?>