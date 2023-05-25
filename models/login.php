<?php
class Login
{
	private $conn;
	private $table_name = "users";
	public function __construct($db)
	{
		$this->conn = $db;
	}
	
	function login($secret_key)
	{
		$secret_arr=explode(":",base64_decode($secret_key));
		$email=$secret_arr[0];
		$password=$secret_arr[1];
		$secret_key2=$secret_arr[2];
		$query = "SELECT id, firstname, lastname, password, apikey FROM ".$this->table_name." WHERE email = ? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $email);
		$stmt->execute();
		$num = $stmt->rowCount();	
		if($num > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$id = $row['id'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$password2 = $row['password'];
			$apikey = $row['apikey'];
		
			if((password_verify($password, $password2))
			&&(password_verify($secret_key2, $apikey)))
			{
				return 'ok';
			}
			else
			{
				return 'ko';
			}
		}
		else
		{
			return 'ko';
		}
	}	
}
?>