<?php 
namespace Insta\Video;
use Insta\Video\BrowserSupportedFormats;
use Exception;
class Video{
	private $id;
	private $width;
	private $height;
	private $size;
	private $Maxsize;
	private $status;
	private $filename;
	private $type;
	private $fileExtension;
	private $dateMade;
	private $dateUpdated;
	private $filepath;
	private $postID;
	private $postLinkID;
	private string $videoName;
	public BrowserSupportedFormats $browser;

	public function __construct(){
		$this->id=null;
		$this->postID=null;
		$this->filename='';
		$this->fileExtension='.mp4';
		$this->videoName='';
		$this->filepath='';
		$this->postLinkID='';
		$this->size='';
		$this->width='';
		$this->height='';
		$this->dateMade='';
		$this->dateUpdated='';
		$this->type='';
		$this->Maxsize=50000000;
		$this->status='show';
	}
	public function set_videoName(string $name){
		$this->videoName=$name;
	}
	public function get_videoName(){
		return $this->videoName;
	}
	public function set_maxSize(int $max){
		$this->Maxsize=$max;
	}
	public function get_maxSize(){
		return $this->Maxsize;
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
	public function validate_fileExtension(){
			try{
				$video=$this->get_videoName();
				$filetype=$_FILES[$video]['type'];
			switch ($filetype) {
				case 'video/mp4':
					$this->set_type('video/mp4');
					$this->set_fileExtention('.mp4');
					break;
				case 'video/webM':
					$this->set_type('video/mp4');
					$this->set_fileExtention('.webm');
					break;
				case 'video/ogg':
					$this->set_type('video/mp4');
					$this->set_fileExtention('.ogg');
					break;
				case 'video/avi':
					$this->set_type('video/mp4');
					$this->set_fileExtention('.avi');
					break;
				case 'video/mogg':
					$this->set_type('video/mp4');
					$this->set_fileExtention('.mogg');
					break;
				case 'video/av1':
					$this->set_type('video/mp4');
					$this->set_fileExtention('.av1');
					break;
				default:
					throw new Exception('not supported file type');
					break;
			}
			return true;
		}catch(Execption $err){
			return false;
		}
			
			
	}
	public function validate_error(){
		
			$video=$this->get_videoName();
			if($_FILES[$video]['error']==UPLOAD_ERR_OK){
				return true;
			}
			return false;
		
	}

	public function validate_size(){
		try{
			$video=$this->get_videoName();
			if($_FILES[$video]['size']<=$this->get_maxSize()){
				return true;
			}
	
		}catch(Execption $errr){
			return false;
		}
		

	}
	public function make_fileExtension(){
		$filetype=$_FILES[$this->get_videoName()]['type'];
		$this->set_type($filetype);
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
			}
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
            
            $this->set_postLinkID($ids_array[0]);
            array_splice($ids_array,0,1);
            file_put_contents('php/ids.json', json_encode($ids_array));
            
            
        }catch(Execption $err){
            echo $err->getMessage();
            return $err;
        }
    }
	public function load_video(){
		try{
			
			// $filename=$_FILES['video']['name'];
			$videoName=$this->get_videoName();
			$filesize=$_FILES[$videoName]['size'];
			$tmpname=$_FILES[$videoName]['tmp_name'];
			$type=$_FILES[$videoName]['type'];

			$this->set_type($type);
			$this->set_size($filesize);
		
			$this->set_dateMade();
			$this->set_dateUpdated();
			if($this->validate_fileExtension()!==true){
				throw new Exception('not valid video');
			}
			if($this->validate_error()!==true){
				throw new Exception('error uploading video file');
			}
			if($this->validate_size()!==true){
				throw new Exception('the vide file is too big');
			}
			
			$newfile=$this->get_filepath().$this->get_filename();
			if(!move_uploaded_file($tmpname, $newfile)){
				throw new Exception('did not upload');
			}
	}
		catch(Exception $err){
			$data=['errorMessage'=>$err->getMessage()];
			return $data;
		}

	
}
}

?>