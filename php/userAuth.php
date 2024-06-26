<?php declare(strict_types=1);
namespace Users;
// this class will check if user has an id in the session variable if so authenticate will be true
class UserAuth{
	private bool $authanticate;

	public function __construct(){
        $this->authanticate=false;
    }

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