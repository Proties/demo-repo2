<?php declare(strict_types=1);

class ImageFile{

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