<?php
class ImageDB extends PDO{
    private $image;
    public function __construct($image){
        $this->image=$image;
    }
    public function read_image(){
		try{
			$database=new Database();
			$db=$database->get_connection();
			$query='
					SELECT fileName,filePath FROM Images
					WHERE imageID=:id; 


			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':id',$this->get_imageID());
			$stmt->execute();
			$arr=$stmt->fetch();
			$this->set_fileName($arr['fileName']);
			$this->set_filePath($arr['filePath']);
		}catch(PDOException $err){
			echo 'database error read image '.$err->getMessage();
		}
	}
    public function read_images(){
		try{
			$database=new Database();
			$db=$database->get_connection();
			$query='
					SELECT fileName,filePath FROM Images
					WHERE postID=:id; 
			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':id',$this->get_postID());
			$stmt->execute();
			return $stmt->fetchall();
		}catch(PDOException $err){
			echo 'database error read image '.$err->getMessage();
		}
	}

    public function write_image(){
		try{
			$database=new Database();
			$db=$database->get_connection();
			$query='
					INSERT INTO Images()
					VALUES(:typ,:size,:width,:height,:made,:updat,:fname,:fpath);
			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':typ',$this->get_imageType());
			$stmt->bindValue(':size',$this->get_size());
			$stmt->bindValue(':width',$this->get_width());
			$stmt->bindValue(':height',$this->get_height());
			$stmt->bindValue(':made',$this->get_dateMade());
			$stmt->bindValue(':updat',$this->get_dateModifed());
			$stmt->bindValue(':fname',$this->get_fileName());
			$stmt->execute();
		}catch(PDOException $err){
			echo 'error while writing to image '.$err->getMessage();
		}
	}
}


?>