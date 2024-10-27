<?php 
namespace Insta\Video;
use Exception;
class Video{
	private $id;
	private $width;
	private $height;
	private $size;
	private $status;
	private $filename;
	private $type;
	private $fileExtension;
	private $dateMade;
	private $dateUpdated;
	private $filepath;
	private $postID;
	private $postLinkID;

	public function __construct(){
		$this->id=null;
		$this->postID=null;
		$this->filename='';
		$this->fileExtension='.mp4';
		$this->filepath='';
		$this->postLinkID='';
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
	public function set_fileExtention($id){
		$this->fileExtension=$id;
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
	public function set_postLinkID($id){
		$this->postLinkID=$id;
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
	public function get_fileExtention(){
		return $this->fileExtension;
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
	public function get_postLinkID(){
		return $this->postLinkID;
	}
	public function make_filename(){
        try{
           
            $ids=file_get_contents('php/ids.json');
            $ids_array=json_decode($ids,true);
            if($ids_array==null || !is_array($ids_array)){
                throw new Exception('unique ids file is null');
            }
            if($ids_array[0]===''){
                throw new Exception("not a valid id");
            }
            $this->set_filename($ids_array[0]);
            $this->set_postLinkID($ids_array[0]);
            array_splice($ids_array,0,1);
            file_put_contents('php/ids.json', json_encode($ids_array));
            
            
        }catch(Execption $err){
            echo $err->getMessage();
            return $err;
        }
    }
	public function load_video($dir){
		try{
			if(isset($_FILES['video'])){
			// $filename=$_FILES['video']['name'];
			$filesize=$_FILES['video']['size'];
			$tmpname=$_FILES['video']['tmp_name'];
			$filetype=$_FILES['video']['type'];
			switch ($filetype) {
				case 'video/mp4':
					$this->set_fileExtention('.mp4');
					break;
				case 'video/webM':
					$this->set_fileExtention('.webm');
					break;
				case 'video/ogg':
					$this->set_fileExtention('.ogg');
					break;
				case 'video/avi':
					$this->set_fileExtention('.avi');
					break;
				case 'video/mogg':
					$this->set_fileExtention('.mogg');
					break;
				case 'video/av1':
					$this->set_fileExtention('.av1');
					break;
				default:
					throw new Exception('not supported file type');
					break;
			}
			

			$filename=$this->get_filename();
			$this->set_filepath($dir);
			$this->set_size($filesize);
		
			$this->set_dateMade();
			$this->set_dateUpdated();

			$newfile=$dir.$this->get_filename().$this->get_fileExtention();
			if(!move_uploaded_file($tmpname, $newfile)){
				throw new Exception('did not upload');
			}
			$fl=$this->get_filename().$this->get_type();
			$this->set_filename($fl);
			$this->set_type($filetype);
		}
	}
		catch(Exception $err){
			return $err;
		}

	
}
}

?>