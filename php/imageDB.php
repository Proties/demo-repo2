<?php
namespace Insta\Databases\Images;
use Insta\Databases\Database;
use Insta\Images\Image;
class ImageDB extends Database{
    private $image;
    private $db;
    public function __construct(Image $image){

    	Database::__construct();

        $this->image=$image;
        $this->db=$this->get_connection();
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
					SELECT fileName,filePath FROM Images
					WHERE imageID=:id; 


			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':id',$this->image->get_imageID());
			$stmt->execute();
			$arr=$stmt->fetch();
			$this->image->set_fileName($arr['fileName']);
			$this->image->set_filePath($arr['filePath']);
		}catch(PDOExecption $err){
			echo 'database error read image '.$err->getMessage();
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

	public function write_image_post($postID){
		$db=$this->db;
		try{
			$query='
					INSERT INTO PostImages()
					VALUES(:imageID,:postID)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':imageID',$this->image->get_id());
			$statement->bindValue(':postID',$postID);
			$statement->execute();
		}catch(PDOExecption $err){
			return $err;
		}
	}
    public function write_image(){
    	$db=$this->db;
		try{
			$query='
					INSERT INTO Images()
					VALUES(:typ,:size,:width,:height,:made,:updat,:fname,:fpath);
			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':typ',$this->image->get_imageType());
			$stmt->bindValue(':size',$this->image->get_size());
			$stmt->bindValue(':width',$this->image->get_width());
			$stmt->bindValue(':height',$this->image->get_height());
			$stmt->bindValue(':made',$this->image->get_dateMade());
			$stmt->bindValue(':updat',$this->image->get_dateModifed());
			$stmt->bindValue(':fname',$this->image->get_fileName());
			$stmt->execute();
			$id=(int)$db->lastInserId();
			$this->image->set_id($id);
		}catch(PDOExecption $err){
			echo 'error while writing to image '.$err->getMessage();
		}
	}
}


?>