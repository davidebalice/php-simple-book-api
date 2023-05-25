<?php
function callAPI($method, $url, $data, $username, $password, $apikey)
{
	$curl = curl_init();
	$token=base64_encode($username.':'.$password.':'.$apikey);

	switch ($method)
	{
	  case "POST":
		 curl_setopt($curl, CURLOPT_POST, 1);
		 if ($data)
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		 break;
	  case "PUT":
		 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		 if ($data)
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
		 break;
	  default:
		 if ($data)
			$url = sprintf("%s?%s", $url, http_build_query($data));
	}

	curl_setopt($curl, CURLOPT_URL, $url);
	
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  "Authorization: Bearer $token",
	  "Content-Type: application/json"
	));

	curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
	
	
	//for testing
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	//
	

	
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	$result = curl_exec($curl);

	if ($result === false) 
	{
		$result = curl_error($curl);
	}
	//echo stripslashes($result);

	if(!$result){die("Connection Failure");}
	curl_close($curl);
	
	return $result;
}
?>