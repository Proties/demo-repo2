<?php declare(strict_types=1);
namespace Insta\Images;
use Exception;
class ImageFile{
    private string $filename;
    private string $filePath;
    private string $imageType;
    private string $postLinkID;
    public function __construct(){
        $this->imageType='.png';
        $this->filename='';
        $this->filePath='';
        $this->postLinkID='';

    }
     public function set_filename(string $str){
        $this->filename=$str;
    }
    public function set_filePath(string $str){
        $this->filePath=$str;
    }
    public function set_postLinkID(string $str){
        $this->postLinkID=$str;
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
            $this->set_fileName($ids_array[0].$this->get_imageType());
            $this->set_postLinkID($ids_array[0]);
            array_splice($ids_array,0,1);
            file_put_contents('php/ids.json', json_encode($ids_array));
            
            
        }catch(Execption $err){
            echo $err->getMessage();
            return $err;
        }
    }

    public function get_filename():string 
    {
        return $this->filename;
    }
    public function get_imageType():string 
    {
        return $this->imageType;
    }
    public function get_filePath():string 
    {
        return $this->filePath;
    }
    public function get_postLinkID():string 
    {
        return $this->filePath;
    }
}


?>