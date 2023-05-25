<?php
include('class.php');

$data_array =  array("ISBN" => "CODE33543","author" => "Tizio Caio","title" => "Lorem ipsum esperandum est"); 
$make_call = callAPI('POST', 'http://localhost/php/api/books/controller/book/create.php', json_encode($data_array), 'info@companyname.com', 'ciao', 'bj458bh38nmmkj58nkmrjn94mbnki49a'); 
$response = json_decode($make_call, true);

echo"<br /><br />";

//echo var_dump($response);

foreach($response as $value)
{
	echo $value;
}

?>