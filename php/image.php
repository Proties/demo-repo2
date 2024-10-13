<?php  declare(strict_types=1);
namespace Insta\Images;
use Insta\Images\ImageFile;
class Image{
	private int $id;
	private string $dateMade;
	private string $dateModified;
	private string $width;
	private string $height;
	private int $postID;
	private int $imageSize;
	private string $size;
	public ImageFile $file;
	private array $data;

	public function __construct(){
		$this->file=new ImageFile();
		$this->width='200px';
		$this->height='100px';
		$this->dateMade='';
		$this->dateModified='';
		$this->size='300px';
		$this->id=0;


	}
	public function set_dateMade(string $dt){
		$this->dateMade=date('Y:m:d');
	}
	
	public function set_dateModifed(string $dt){
		$this->dateModified=$dt;
	}

	public function set_width(string $dt){
		$this->width=$dt;
	}
	public function set_size(string $dt){
		$this->size=$dt;
	}
	public function set_height(string $dt){
		$this->height=$dt;
	}
	public function set_postID(int $dt){
		$this->postID=$dt;
	}
	public function set_id(int $dt){
		$this->id=$dt;
	}
	public function set_filePath(string $dt){
		$this->filePath=$dt;
	}

	public function set_imageSize(int $dt){
		$this->imageSize=$dt;
	}

	public function set_enoded_base64_string(string $str){
		$string=substr($img,strpos($img,',')+1);
		$arr=getimagesize($string);

		$this->set_fileType($arr[2]);
		$this->set_width($arr[0]);
		$this->set_height($arr[1]);
	}

	public function get_dateMade():string
	{
		return $this->dateMade;
	}
	public function get_dateModifed():string 
	{
		return $this->dateModified;
	}

	public function get_width():string 
	{
		return $this->width;
	}
	public function get_height():string 
	{
		return $this->height;
	}
	public function get_postID():string 
	{
		return $this->postID;
	}

	public function get_size()
	{
		return $this->size;
	}
	public function get_id():int
	{
		return $this->id;
	}
	public function validate_extension(){}
	public function validate_size(){}
	public function validate_video(){}
	public function load_image($dir){
		try{
			if(isset($_FILES['image'])){
			$filename=$_FILES['image']['name'];
			$filesize=$_FILES['image']['size'];
			$tmpname=$_FILES['image']['tmp_name'];
			$filetype=$_FILES['image']['type'];
			
			$newfile=$dir.$filename;
			if(!move_uploaded_file($tmpname, $newfile)){
				throw new Exception('did not upload');
			}
		}
	}
		catch(Exception $err){
			echo $err->getMessage();
		}
	}
}
?>