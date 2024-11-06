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
					INSERT INTO Videos (video_type,video_size,video_width,video_height,created_at,updated_at,filepath,filename)
					VALUES(:type,:size,:width,:height,:dateMade,:updated_at,:filepath,:filename)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':filename',$this->video->get_filename());
			$statement->bindValue(':filepath',$this->video->get_filepath());
			$statement->bindValue(':updated_at',$this->video->get_dateUpdated());
			$statement->bindValue(':size',$this->video->get_size());
			$statement->bindValue(':type',$this->video->get_type());
			$statement->bindValue(':dateMade',$this->video->get_dateMade());
			$statement->bindValue(':height',$this->video->get_height());
			$statement->bindValue(':width',$this->video->get_width());
			$statement->execute();
			$id=$db->lastInsertId();
			$this->video->set_id($id);
		}catch(PDOException $err){
			return $err;
		}
	}
	public function write_video_post($postID){
		$db=$this->db;
		try{
			$query='
						INSERT INTO VideoPost(videoID,postID)
						VALUES(:videoID,:postID)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':videoID',$this->video->get_id());
			$statement->bindValue(':postID',$postID);
			$statement->execute();

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