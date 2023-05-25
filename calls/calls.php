<?php
include('class.php');
/*
//get request
$get_data = callAPI('GET', 'http://localhost/php/api/books/controller/book/read.php', false); 
$response = json_decode($get_data, true);

var_dump($response);
//print_r($response);

//$array_books=$response['records']['0']['ISBN'];
$array_books=$response['records'];

echo "<br /><br /><br />";

foreach ($response['records'] as $key => $value) 
{
	foreach ($value as $key2 => $value2) 
	{
		echo $key2.":".$value2."<br />";
	}
	
}

array(1) { 
["records"]=> array(3) 
{ [0]=> array(3) { ["ISBN"]=> string(5) "A1111" ["author"]=> string(0) "" ["Titolo"]=> string(0) "" } 
[1]=> array(3) { ["ISBN"]=> string(5) "A2222" ["author"]=> string(0) "" ["Titolo"]=> string(0) "" }
 [2]=> array(3) { ["ISBN"]=> string(5) "A3333" ["author"]=> string(0) "" ["Titolo"]=> string(0) "" } } }


*/








/*

//post request
data_array =  array("data" => "some_record_data"); 
$make_call = callAPI('POST', 'https://yourapi.com/post_url/', json_encode($data_array)); 
$response = json_decode($make_call, true);








//put request
$data_array =  array("data" => "some_update"); 
$update_plan = callAPI('PUT', 'https://yourapi.com/put_url/', json_encode($data_array)); 
$response = json_decode($update_plan, true);








//delete request
callAPI('DELETE', 'https://api.example.com/delete_url/' . $id, false);
*/
?>