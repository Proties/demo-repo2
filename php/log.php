<?php 
$errorData = json_decode(file_get_contents('php://input'), true);
try{
	if($errorData==null){
		throw new Exception('error cannot be null');
	}
	$file=fopen('logjs.json', 'ab');
	if(!$file){
		throw new Exception('error opening file');
	}

	fwrite($file, json_encode($errorData));
	fclose($file);
	http_response_code(200);
}catch(Exception $err){
	echo json_encode($err);
	http_response_code(500);
}

?>