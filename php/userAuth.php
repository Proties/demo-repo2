<?php declare(strict_types=1);
namespace Insta\Users;
// this class will check if user has an id in the session variable if so authenticate will be true
class UserAuth{
	private bool $authanticate;
    private string $hashedPassword;
    private string $password;
    private string $salt;

	public function __construct(){
        $this->authanticate=false;
    }
    public function set_password(string $password){}
    public function set_hashedPassword(string $hashedPassword){}
    public function set_salt(string $salt){}

    public function get_password():string 
    {}
    public function get_hashedPassword():string 
    {}
    public function get_salt():string 
    {}
	public function set_authanticate(bool $t)
    {
        $this->authanticate=$t;
    }

    public function is_authanticated():bool
    {
        if($this->authanticate==true){
            return true;
        }
        return false;
        
    }

}

?>