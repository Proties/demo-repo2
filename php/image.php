<?php  declare(strict_types=1);
namespace Insta\Images;
use Insta\Images\ImageFile;
use Exception;
class Image{
	private int $id;
	private string $filename;
    private string $filePath;
    private string $fileExtension;
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
		$this->filename='';
        $this->filePath='';
        $this->fileExtension='.png';
		$this->width='200px';
		$this->height='100px';
		$this->dateMade=date('Y:m:d');
		$this->dateModified=date('Y:m:d');
		$this->size='300px';
		$this->id=0;


	}
	  public function set_filename(string $str){
        $this->filename=$str;
    }
    public function set_filePath(string $str){
        $this->filePath=$str;
    }
    public function set_fileExtension(string $str){
        $this->fileExtension=$str;
    }
    public function get_fileExtension():string
    {
        return $this->fileExtension;
    }
     public function get_filename():string
    {
        return $this->filename;
    }
   
    public function get_filePath():string
    {
        return $this->filePath;
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
	public function get_postID():int 
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
            $this->set_fileName($ids_array[0]);
            
            array_splice($ids_array,0,1);
            file_put_contents('php/ids.json', json_encode($ids_array));
            
            
        }catch(Execption $err){
            echo $err->getMessage();
            return $err;
        }
    }
	public function load_image($dir){
		$error='';
		try{
			if(isset($_FILES['image'])){
		
			$filesize=$_FILES['image']['size'];
			$tmpname=$_FILES['image']['tmp_name'];
			$filetype=$_FILES['image']['type'];
			$filename=$this->make_filename();
			
			$image_type=exif_imagetype($tmpname);

			switch($filetype){
				case IMAGETYPE_GIF:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_GIF,true));
					break;
				case IMAGETYPE_JPEG:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_JPEG,true));
					break;
				case IMAGETYPE_PNG:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_PNG,true));
					break;
				case IMAGETYPE_PSD:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_PSD,true));
					break;
				case IMAGETYPE_BMP:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_BMP,true));
					break;
				case IMAGETYPE_TIFF_II:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_TIFF_II,true));
					break;
				case IMAGETYPE_TIFF_MM:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_TIFF_MM,true));
					break;
				case IMAGETYPE_WBMP:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_WBMP,true));
					break;
				case IMAGETYPE_WEBP:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_WEBP,true));
					break;
				case IMAGETYPE_AVIF:
					$this->set_fileExtension(image_type_to_extension(IMAGETYPE_AVIF,true));
					break;
				default:
					$error='error';
					break;
			}
			if($error=='error'){
				throw new Exception('not valid file extension');
			}
			$newfile=$dir.$filename.$this->get_fileExtension();
			$this->set_filename($newfile);
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