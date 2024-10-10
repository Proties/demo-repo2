<?php 
namespace Insta\Database\Video;
use Insta\Video\Video;
use Insta\Databases\Database;
class VideoDB extends Database{
	public Video $video;
	private $db;
	public function __construct(Video $video){
		$this->db=Database::get_connection();
		$this->video=$video;
	}

	public function set_db($db){
		$this->db=$db;
	}
	public function write_video(){
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
	public function write_video_post(){
		$db=$this->db;
		try{
			$query='
						INSERT INTO VideoPost()
						VALUES(:videoID,:postID)
			';
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