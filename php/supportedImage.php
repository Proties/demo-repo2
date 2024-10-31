<?php declare(strict_types=1);
namespace Insta\Images;
use Exception;
class BrowserSupportedFormats{
	private array $browserList;
	public function __construct(){
		$->browserList=[
		'Opera'=[
					'image/png',
					'image/gif',
				],
		'Chrome'=[
					'image/png',
					'image/gif',
				],
		'Edge'=[
					'image/png',
					'image/gif',
				],
		'Brave'=[
					'image/png',
					'image/gif',
				],
		'FireFox'=[
					'image/png',
					'image/gif',
				],
		];
	}

	public function is_type_valid($browser,$type):bool
	{

	}
	public function get_types($browsers):array
	{

	}
	

}


?>