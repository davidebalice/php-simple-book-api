<?php
include('class.php');
$data_array =array("ISBN" => "CODE33543","author" => "Pinco Pallo","title" => "Libro bello"); 
$make_call = callAPI('PUT', 'http://localhost/php/api/books/controller/book/delete.php', json_encode($data_array), 'info@companyname.com', 'ciao', 'bj458bh38nmmkj58nkmrjn94mbnki49a');
$response = json_decode($make_call, true);

echo"<br /><br />";

echo var_dump($response);
/*
foreach($response as $value)
{
	echo $value;
}*/
?>