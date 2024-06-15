<?php 

// if user has a database user that one if not create a new one

once a form is a created so will another table in the database
class MyDB extends SQLite3{
	function __construct(){
		$this->open($filename,SQLITE3_OPEN_CREATE);
	}
}

?>