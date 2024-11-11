<?php 
$errorData = json_decode(file_get_contents('php://input'), true);
$logArray=[];
function readLogs(){
	$logs;
	$file=fopen('logjs.json','r+');
	$logs=fread($file, filesize($file));
	fclose($file);
	return $logs;
}


try{
	if($errorData==null){
		throw new Exception('error cannot be null');
	}
	$file=fopen('logjs.json', 'ab');
	if(!$file){
		throw new Exception('error opening file');
	}
	$logArray=readLogs();
	array_push($logArray, $errorData);
	fwrite($file, json_encode($logArray));
	fclose($file);
	http_response_code(200);
}catch(Exception $err){
	echo json_encode($err);
	http_response_code(500);
}

?>