<?php
// a class that will hold all user objects of the current user session
 
class MainUser{
    public static $instance=null;
    private function __construct(){}

    public static function get_instance(){
        if(self::$instance==null){
            self::$instance=new Users;
            return self::$instance;
        }
        return self::$instance;
    }

}


?>