<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
ini_set("allow_url_fopen", true);
include_once '../../config/database.php';
include_once '../../models/book.php';
include_once '../../models/login.php';
$database = new Database();
$db = $database->getConnection();
$data = json_decode(file_get_contents("php://input"));
$headers = getallheaders();
$authHeader=$headers["Authorization"];
$arr = explode(" ", $authHeader); 
$secret_key = $arr[1]; 
$controlUser = new Login($db);
$resultUser = $controlUser->login($secret_key);

if($resultUser=="ko")
{
	http_response_code(401);
    echo json_encode(array("message" => "Login failed."));
}
else
{
	$book = new Book($db);
	$stmt = $book->read();
	$num = $stmt->rowCount();
	if($num>0)
	{
		$ISBN="";
		$author="";
		$title="";
		$book_array = array();
		$book_array["records"] = array();
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			$book_item = array(
				"ISBN" => $ISBN,
				"author" => $author,
				"title" => $title
			);
			array_push($book_array["records"], $book_item);
		}
		echo json_encode($book_array);
	}
	else
	{
		echo json_encode(
			array("message" => "Books not found.")
		);
	}
}










?>