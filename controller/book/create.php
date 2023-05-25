<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("allow_url_fopen", true);
 
include_once '../../config/database.php';
include_once '../../models/book.php';
include_once '../../models/login.php';

$database = new Database();
$db = $database->getConnection();
$book = new Book($db);
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
	if(
		!empty($data->ISBN) &&
		!empty($data->title) &&
		!empty($data->author)
	)
	{
		$book->ISBN = $data->ISBN;
		$book->title = $data->title;
		$book->author = $data->author;
		
		if($book->create())
		{
			http_response_code(201);
			echo json_encode(array("message" => "Book correctly inserted."));
		}
		else
		{
			http_response_code(503);
			echo json_encode(array("message" => "Impossible to insert book."));
		}
	}
	else
	{
		http_response_code(400);
		echo json_encode(array("message" => "Impossible to insert book. Data are incomplete."));
	}
}
?>