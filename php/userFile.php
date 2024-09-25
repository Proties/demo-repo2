<?php declare(strict_types=1);
namespace Insta\Users;
use Exception;
// this cllas will deal with the user folder createion/modification/deletion
class UserFolder{
    private string $folderName;
	private string|null $userDir;
	private array $userFiles;
	public function __construct(){
        $this->folderName='';
        $this->userFiles=[];
        $this->userDir='';
        
    }
    public function set_folderName(string $name)
    {
        $this->folderName=$name;
    }
    public function get_folderName():string 
    {
        return $this->folderName;
    }
	public function search_file(){}
	public function get_file(){}
	public function add_file(){}
	public function update_file(){}
	public function delete_file(){}

    public function set_dir(string  $dir){
        $this->userDir=$dir;
    }
    public function get_dir():string
    {
        $this->userDir='./userProfiles/'.$this->get_folderName().'/';
        return $this->userDir;
    }
    public function delete_folder(string $folderName){
    	// check if folder exists
    	// delete folder
    }
    public function change_folder_name(string $name){
    	// check if current folder exist
    	// change folder name
    }
    public function create_user_folder(string $username){
        try{
        if(is_dir('../userProfiles/'.$username)){
            throw new Exception('directory already exixsts');
        }
        mkdir('./userProfiles/'.$username,755,false);
        $this->set_dir('../userProfiles/'.$username);
    }catch(Exception $err){
        return $err;
    }
    }
}


?>