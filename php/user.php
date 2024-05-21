<?php 
class Users{
    private $name;
    private $username;
    private $bio;
    private $profileImage;
    private $dateOfBirth;
    private $password;
    private $email;
    private $phone;

    public function __construct(){}

    public function set_name($nm){
        $this->name=$nm;
    }
    public function set_username($nm){
        $this->username=$nm;
    }
    public function set_profilePicture($pic){
        $this->profileImage=$pic;
    }
    public function set_password($pas){
        $this->password=$pas;
    }
    public function set_dateOfBirth($obj){
        $this->dateOfBirth=$obj;
    }
    public function set_posts($p){
        $this->posts=$p;
    }


    public function get_name(){
        return $this->name;
    }
    public function get_username(){
        return $this->username;
    }
    public function get_profilePicture(){
        return $this->profileImage;
    }
    public function get_password(){
        return $this->password;
    }
    public function get_dateOfBirth(){
        return $this->dateOfBirth;
    }
    public function get_posts(){
        return $this->post;
    }

    public function write_user(){
        try{
            $query="
                    INSERT INTO User
                    VALUES(:name,:username,:email,:profilePicture,:userPassword,:dateMade,:timeMade);
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':',$this->get_name());
            $statement->bindValue(':',$this->get_username());
            $statement->bindValue(':',$this->get_email());
            $statement->bindValue(':',$this->get_phone());
            $statement->bindValue(':',$this->get_password());
            $statement->bindValue(':',$this->get_date());
            $statement->bindValue(':',$this->get_time());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_user(){
        try{
            $query="
                    SELECT * FROM User
                    WHERE userID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':',$this->get_());
            $statement->execute();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_posts(){
        try{
            $query="
                    SELECT * FROM post
                    WHERE ;
            ";
            $statement->bindValue(':',);
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }

    
}


?>