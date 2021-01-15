<?php 

require_once 'config.php';


class Auth extends Database {
	
	//Register New User...
	public function register($name, $email, $password) {
		$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);
		return true;
	}

	//Check if User already registered...
	public function user_exist($email) {
		$sql = "SELECT email FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	//Login Existing User...
	public function login($email) {
		$sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row; 
	}

	//Current Users In Session...
	public function currentUser($email) {
		$sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row; 
	}

	//Forgot Password...
	public function forgot_password($token, $email) {
		$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['token'=>$token,'email'=>$email]);

		return true;
	} 

	//Aqui vai dois metodos para autenticar as redefinição de senhas...
	//Reset Password User Auth...
	public function reset_pass_auth($email, $token){
		$sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 0";
		$stmt =$this->conn->prepare($sql);
		$stmt->execute(['email'=>$email, 'token'=>$token]);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	//Update new password...
	public function update_new_pass($pass, $email) {
		$sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 0";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['pass'=>$pass, 'email'=>$email]);
		return true;
	}

	//Add new Notas...
	public function add_new_note($uid, $title, $note) {
		$sql = "INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'title'=>$title, 'note'=>$note]);
		return true;
	}

	//Fetch All Notes of an user...
	public function get_notes($uid) {
		$sql = "SELECT * FROM notes WHERE uid = :uid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Edit note of an User...
	public function edit_note($id) {
		$sql = "SELECT * FROM notes WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	//Update note of an user...
	public function update_note($id, $title, $note) {
		$sql = "UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['title'=>$title, 'note'=>$note, 'id'=>$id]);

		return true;
	}

	//Delete a Note of an User...
	public function delete_note($id) {
		$sql = "DELETE FROM notes where id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	} 
}