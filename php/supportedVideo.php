<?php declare(strict_types=1);
namespace Insta\Video;
use Exception;
class BrowserSupportedFormats{
	private array $browserList;
	public function __construct(){
		$->browserList=[
		'Opera'=[
					'video/mp4',
					'video/mp3',
				],
		'Chrome'=[
					'video/mp4',
					'video/mp3',
				],
		'Edge'=[
					'video/mp4',
					'video/mp3',
				],
		'Brave'=[
					'video/mp4',
					'video/mp3',
				],
		'FireFox'=[
					'video/mp4',
					'video/mp3',
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