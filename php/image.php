<?php  declare(strict_types=1);
namespace Insta\Images;
use Insta\Images\ImageFile;
class Image{
	private string $dateMade;
	private string $dateModified;
	private string $fileName;
	private string $filePath;
	private string $imageType;
	private string $width;
	private string $height;
	private int $postID;
	private int $imageSize;
	public ImageFile $file;
	private array $data;

	public function __construct(){
		$this->file=new ImageFile();
		$this->width='200px';
		$this->height='100px';
		$this->filePath='';
		$this->fileName='';
		$this->imageType='.png';


	}
	public function set_dateMade(string $dt){
		$this->dateMade=$dt;
	}
	
	public function set_dateModifed(string $dt){
		$this->dateModified=$dt;
	}
	public function set_fileName(string $dt){
		$this->fileName=$dt;
	}
	public function set_width(string $dt){
		$this->width=$dt;
	}
	public function set_height(string $dt){
		$this->height=$dt;
	}
	public function set_postID(int $dt){
		$this->postID=$dt;
	}
	public function set_filePath(string $dt){
		$this->filePath=$dt;
	}
	public function set_imageType(string $dt){
		$this->imageType=$dt;
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
	public function get_fileName():string 
	{
		return $this->fileName;
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
	public function get_filePath():string 
	{
		return $this->filePath;
	}
	public function get_imageType():string 
	{
		return $this->imageType;
	}
	public function get_size():int
	{

	}
}
?>