<?php
class Book
{
	private $conn;
	private $table_name = "books";
	public $ISBN;
	public $author;
	public $title;
	
	public function __construct($db)
	{
		$this->conn = $db;
	}
	
	function read()
	{
		$query = "SELECT
                        a.ISBN, a.author, a.title
                    FROM
                   " . $this->table_name . " a ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function create()
	{
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					ISBN=:isbn, author=:author, title=:title;";
	   
		$stmt = $this->conn->prepare($query);
	 
		$this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->title = htmlspecialchars(strip_tags($this->title));
	 
		// binding
		$stmt->bindParam(":isbn", $this->ISBN);
		$stmt->bindParam(":author", $this->author);
		$stmt->bindParam(":title", $this->title);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;
     
	}
	
	function update()
	{
 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					title = :title,
					author = :author
				WHERE
					ISBN = :isbn";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->title = htmlspecialchars(strip_tags($this->title));
	 
		// binding
		$stmt->bindParam(":isbn", $this->ISBN);
		$stmt->bindParam(":author", $this->author);
		$stmt->bindParam(":title", $this->title);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
		
		
	function delete()
	{
	 
		$query = "DELETE FROM " . $this->table_name . " WHERE ISBN = ?";
	 
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
	 
	 
		$stmt->bindParam(1, $this->ISBN);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	 
}
?>