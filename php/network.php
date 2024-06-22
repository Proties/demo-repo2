<?php 
class Network{


if(header('Content-Type')=='image/png'|| header('Content-Type')=='image/jpeg'){
	var_dump('working');
	return;
	header('Cache-Control: max-age='.(60*60*24));
	header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24));
	// header('ETag');
	// header('Last-Modified: '.gmdate(DATE_RFC1123,fileatime($path)));
}

}
// this file will define caching behaviou as well as acces to site by manipulating http headers
?>