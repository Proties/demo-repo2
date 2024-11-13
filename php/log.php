<?php 
$errorData = json_decode(file_get_contents('php://input'), true);
$logArray=[];
/**
 * Reads the contents of the log file.
 *
 * @return string The contents of the log file.
 */
function readLogs() {
    $filePath = 'logjs.json';
    
    // Check if file exists and is readable
    if (!file_exists($filePath) || !is_readable($filePath)) {
        throw new Exception("Log file not found or not readable.");
    }
    
    // Read file contents
    $logs = file_get_contents($filePath);
    
    // Decode JSON string to PHP array/object
    $logs = json_decode($logs, true);
    
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