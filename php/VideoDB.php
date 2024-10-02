<?php 
class VideoDB extends Database{
	public Video $video;
	private $db;
	public function __construct(Video $video){
		$this->db=Database::get_connection();
		$this->video=$video;
	}

	public function addVideo(){}
	public function deleteVideo(){}

	public function getVideos(){}

}
?>