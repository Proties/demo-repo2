<?php 
namespace Insta\Video;
class Video{
	private $id;
	private $width;
	private $size;
	private $filename;
	private $type;
	private $dateMade;
	private $timeMade;

	public function __construct(){

	}
	public function set_id(int $id){}
	public function set_size($id){}
	public function set_width($id){}
	public function set_height($id){}
	public function set_filename($id){}
	public function set_dateMade($id){}
	public function set_timeMade($id){}
	public function set_status($id){}

	public function get_id(){
		return $this->id;
	}
	public function get_size(){
		return $this->size;
	}
	public function get_width(){
		return $this->width;
	}
	public function get_height(){
		return $this->height;
	}
	public function get_filename(){
		return $this->filename;
	}
	public function get_dateMade(){
		return $this->dateMade;
	}
	public function get_timeMade(){
		return $this->timeMade;
	}
	public function get_status(){
		return $this->status;
	}
	public function load_video($dir){
		try{
			if(isset($_FILES['video'])){
			$filename=$_FILES['video']['name'];
			$filesize=$_FILES['video']['size'];
			$tmpname=$_FILES['video']['tmp_name'];
			$filetype=$_FILES['video']['type'];
			
			$newfile=$dir.$filename;
			if(!move_uploaded_file($tmpname, $newfile)){
				throw new Exception('did not upload');
			}
		}
	}
		catch(Exception $err){
			return $err;
		}

	
}
}

?>