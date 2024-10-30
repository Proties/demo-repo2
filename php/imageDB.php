<?php
namespace Insta\Databases\Images;
use Insta\Databases\Database;
use Insta\Images\Image;
class ImageDB extends Database{
    private Image $image;
    private $db;
    public function __construct(Image $image){
        $this->image=$image;
        $this->db=Database::get_connection();
    }
    public function set_db($d){
    	$this->db=$d;
    }
    public function get_image(){
        return $this->image;
    }
    public function read_image(){
		try{
			$db=$this->get_connection();
			$query='
					SELECT fileName,filePath FROM Images i
					INNER JOIN PostImages pi ON i.imageID=pi.imageID
					WHERE pi.postID=:id; 


			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':id',$this->image->get_postID());
			$stmt->execute();
			$arr=$stmt->fetch();
			return $arr;
			
		}catch(PDOExecption $err){
			return $err;
		}
	}
    public function read_images(){
    	$db=$this->db();
		try{
			
			$query='
					SELECT fileName,filePath FROM Images
					WHERE postID=:id; 
			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':id',$this->image->get_postID());
			$stmt->execute();
			return $stmt->fetchall();
		}catch(PDOExecption $err){
			echo 'database error read image '.$err->getMessage();
		}
	}

	public function write_image_post(int $postID){
		$db=$this->db;
		try{
			$query='
					INSERT INTO PostImages(postID,imageID)
					VALUES(:postID,:imageID)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':imageID',$this->image->get_id());
			$statement->bindValue(':postID',$postID);
			$statement->execute();
		}catch(PDOExecption $err){
			return $err;
		}
	}
	public function write_image_profile_picture(){
		$db=$this->db;
		try{
			$query='
					INSERT INTO ProfileImages(userID,imageID,currentStatus)
					VALUES(:userID,:imageID,:status)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':imageID',$this->image->get_id());
			$statement->bindValue(':userID',$this->image->get_userID());
			$statement->bindValue(':status','selected');
			$statement->execute();
		}catch(PDOExecption $err){
			return $err;
		}
	}
    public function write_image(){
    	$db=$this->db;
		try{
			$query='
					INSERT INTO Images(image_type,image_size,image_width,image_height,created_at,updated_at,filepath,filename)
					VALUES(:typ,:size,:width,:height,:made,:updat,:fpath,:fname);
			';
			$stmt=$db->prepare($query);

			$stmt->bindValue(':typ',$this->image->file->get_type());
			$stmt->bindValue(':size',$this->image->get_fileSize());
			$stmt->bindValue(':width',$this->image->get_width());
			$stmt->bindValue(':height',$this->image->get_height());
			$stmt->bindValue(':made',$this->image->get_dateMade());
			$stmt->bindValue(':updat',$this->image->get_dateModifed());
			$stmt->bindValue(':fname',$this->image->file->get_fileName());
			$stmt->bindValue(':fpath',$this->image->file->get_filePath());
			$stmt->execute();
			$id=(int)$db->lastInsertId();
			$this->image->set_id($id);
			$this->image->postLink('userDir'.'postLinkID');
		}catch(PDOExecption $err){
			echo 'error while writing to image '.$err->getMessage();
		}
	}
}


?>