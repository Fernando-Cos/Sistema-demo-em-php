<?php 


class Database {
	
	const USERNAME = 'wellingthon9@gmail.com';
	const PASSWORD = '963852741f';


	private $dsn = "mysql:host=localhost;dbname=db_user_system";
	private $dbuser = "root";
	private $dbpass = "";

	public $conn;

	public function __construct() {
		try {
			$this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
		} catch ( PDOExeception $e) {
			echo "Erro ao tentar uma Conexão!!!: " . $e->getMessage();	
		}

		return $this->conn;
	}

	// Check Input
	public function test_input($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// Erro Sucess Menssagem Alert.
	public function showMessage($type, $message) {
		return '<div class = "alert alert-'.$type.' alert-dismissible">
					<button type = "button" class="close"
						data-dismiss="alert">&times;</button>
					<b class = "text-center">'.$message.'</b>	
				</div>';
	}
}
