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
	private $data=[];

	public function __construct(){
		$this->width='200px';
		$this->height='100px';
		$this->imageType='.png';


	}
	public function set_dateMade($dt){
		$this->dateMade=$dt;
	}
	
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

	public function set_enoded_base64_string($str){
		$string=substr($img,strpos($img,',')+1);
		$arr=getimagesize($string);

		$this->set_fileType($arr[2]);
		$this->set_width($arr[0]);
		$this->set_height($arr[1]);
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
	
	
	

// making random file name 


 public function make_file(){
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
        
        $this->set_fileName($this->get_filePath().$this->get_imageType());
        }catch(Execption $err){
            echo $err->getMessage();
        }
    }
   




}



?>