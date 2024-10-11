<?php 
namespace Insta\Video;
class Video{
	private $id;
	private $width;
	private $height;
	private $size;
	private $status;
	private $filename;
	private $type;
	private $dateMade;
	private $dateUpdated;
	private $filepath;
	private $postID;

	public function __construct(){
		$this->id=null;
		$this->postID=null;
		$this->filename='';
		$this->filepath='';
		$this->size='';
		$this->width='';
		$this->height='';
		$this->dateMade='';
		$this->dateUpdated='';
		$this->type='';
		$this->status='show';
	}
	public function set_postID(int $id){
		$this->postID=$id;
	}
	public function set_id(int $id){
		$this->id=$id;
	}
	public function set_type($id){
		$this->type=$id;
	}
	public function set_size($id){
		$this->size=$id;
	}
	public function set_width($id){
		$this->width=$id;
	}
	public function set_height($id){
		$this->height=$id;
	}
	public function set_filename($id){
		$this->filename=$id;
	}
	public function set_filepath($id){
		$this->filepath=$id;
	}
	public function set_dateMade(){
		$this->dateMade=date('Y:m:d');
	}
	public function set_dateUpdated(){
		$this->dateUpdated=date('H:i');
	}
	public function set_status($id){
		$this->status=$id;
	}

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
	public function get_filepath(){
		return $this->filepath;
	}
	public function get_dateMade(){
		return $this->dateMade;
	}
	public function get_dateUpdated(){
		return $this->dateUpdated;
	}
	public function get_status(){
		return $this->status;
	}
	public function get_type(){
		return $this->type;
	}
	public function get_postID(){
		return $this->postID;
	}
	public function load_video($dir){
		try{
			if(isset($_FILES['video'])){
			$filename=$_FILES['video']['name'];
			$filesize=$_FILES['video']['size'];
			$tmpname=$_FILES['video']['tmp_name'];
			$filetype=$_FILES['video']['type'];

			$this->set_filename($filename);
			$this->set_size($filesize);
			$this->set_type($filetype);
			$this->set_dateMade();
			$this->set_dateUpdated();

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