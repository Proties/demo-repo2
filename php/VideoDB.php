<?php 
class VideoDB extends Database{
	public Video $video;
	private $db;
	public function __construct(Video $video){
		$this->db=Database::get_connection();
		$this->video=$video;
	}

	public function addVideo(){
		$db=$this->db;
		try{
			$query='
					INSERT INTO Video
					VALUES(:filename,:size,:type,:dateMade,:timeMade,:status)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':filename',$this->video->get_filename());
			$statement->bindValue(':size',$this->video->get_size());
			$statement->bindValue(':type',$this->video->get_type());
			$statement->bindValue(':dateMade',$this->video->get_dateMade());
			$statement->bindValue(':timeMade',$this->video->get_timeMade());
			$statement->bindValue(':status',$this->video->get_status());
			$statement->execute();
			$id=$statement->db2_last_insert_id($db);
			$this->video->set_id($id);
		}catch(PDOException $err){
			return $err;
		}
	}
	public function deleteVideo(){

	}

	public function hideVideo(){}
	public function getVideos(){}

}
?>