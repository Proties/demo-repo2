<?php declare(strict_types=1);
namespace Users;
// this cllas will deal with the user folder createion/modification/deletion
class UserFolder{
	private string $userDir;
	private array $userFiles;
	public function __construct(){}

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
        $this->userDir='./userProfiles/'.$this->get_username().'/';
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
    public function create_user_folder(){
        try{
        if(!is_dir('../userProfiles/'.$this->get_username())){
            mkdir('./userProfiles/'.$this->get_username(),'0755',false);
            $this->set_dir('../userProfiles/'.$this->get_username());
        }else{
            throw new Exception('directory already exixsts');
        }
    }catch(Exception $err){
        echo $err->getMessage();
    }
    }
}


?>