<?php 
class Image{
	private $dateMade;
	private $dateModified;
	private $fileName;
	private $filePath;
	private $imageType;
	private $width;
	private $height;
	private $postID;
	private $imageSize;
	private $data=array();

	public function __construct(){
		$this->width;
	}


	public function set_dateMade($dt){}
	$this->dateMade=$dt;
	public function set_dateModifed($dt){
		$this->dateModified=$dt;
	}
	public function set_fileName($dt){
		$this->fileName=$dt;
	}
	public function set_width($dt){
		$this->width=$dt;
	}
	public function set_height($dt){
		$this->height=$dt;
	}
	public function set_postID($dt){
		$this->postID=$dt;
	}
	public function set_filePath($dt){
		$this->filePath=$dt;
	}
	public function set_imageType($dt){
		$this->imageType=$dt;
	}
	public function set_imageSize($dt){
		$this->imageSize=$dt;
	}

	public function get_dateMade(){
		return $this->dateMade;
	}
	public function get_dateModifed(){
		return $this->dateModified;
	}
	public function get_fileName(){
		return $this->fileName;
	}
	public function get_width(){
		return $this->width;
	}
	public function get_height(){
		return $this->height;
	}
	public function get_postID(){
		return $this->postID;
	}
	public function get_filePath(){
		return $this->filePath;
	}
	public function get_imageType(){
		return $this->imageType;
	}
	public function get_size(){

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


// making random file name 


 public function create_post_file(){
        try{

        
        $f=fopen('php/ids.json','r') or die('file doesnt exist');
        
        $ids=fread($f,filesize("php/ids.json"));
        $ids_array=json_decode($ids,true);
        if(!is_array($ids_array)){
            throw new Exception('data is not array');
        }
        
        $this->set_postLinkID($ids_array[0]);
        array_splice($ids_array,0,1);
        fclose($f);
        
        $f_two=fopen('php/ids.json','w') or die('file doesnt exist');
        fwrite($f_two,json_encode($ids_array));
        fclose($f_two);
        
        $this->set_fileName($this->get_postLinkID().'.png');
        }catch(Execption $err){
            echo $err->getMessage();
        }
    }
   




}



?>