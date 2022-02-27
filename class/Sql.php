<?php  


class Sql extends PDO{

	private $conn;


	public function __construct(){

		
		
			$hostname = "localhost";
			$dbname = "dbphp7";
			$username = "root";
			$pw = "";

			$banco = 1;
			if ($banco == 1) {
				$pdoConfig = "mysql:dbname=$dbname; host=$hostname";
			}elseif ($banco == 2) {
				$pdoConfig = "sqlsrv:Database=$dbname;server=$hostname";
			}

			$this->conn = new PDO($pdoConfig, $username, $pw);




	}

	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statment, $key, $value);
		}
	}

	private function setParam($statment, $key, $value){echo 'entrei';
		$statment->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
		
	}

	public function select($rawQuery, $params = array()){
		$stmt = $this->query($rawQuery, $params);


		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
}