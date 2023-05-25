<?php
include('class.php');

$data_array =  array("data1" => "value1","data2" => "value2"); 
$get_data = callAPI('POST', 'http://localhost/php/api/books/controller/book/read.php', json_encode($data_array), 'info@companyname.com', 'ciao', 'bj458bh38nmmkj58nkmrjn94mbnki49a'); 
$response = json_decode($get_data, true);

var_dump($response);

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

?>