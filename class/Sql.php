<?php  


class Sql extends PDO{

	private $conn;
	private $tipoBanco;

	public function getTipoBanco(){
		return $this->tipoBanco;
	}

	public function __construct(){

			$this->tipoBanco = 1;
		
			$hostname = "localhost";
			$dbname = "dbphp7";
			$username = "dbphp7";
			$pw = "170352";

			if ($this->tipoBanco == 1) {
				$pdoConfig = "mysql:dbname=$dbname; host=$hostname";
			}elseif ($this->tipoBanco == 2) {
				$pdoConfig = "sqlsrv:Database=$dbname;server=$hostname";
			}

			$this->conn = new PDO($pdoConfig, $username, $pw);




	}

	private function setParams($statement, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value);
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