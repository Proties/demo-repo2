<?php 
include('php/database.php');

class Users{
    use validateUser;
    private $name;
    private $username;
    private $bio;
    private $profileImage;
    private $dateOfBirth;
    private $password;
    private $email;
    private $phone;
    private $date;
    private $time;
    private $status;

    public function __construct(){
    $this->name='';
    $this->username='';
    $this->bio='';
    $this->profileImage='';
    $this->dateOfBirth='';
    $this->password='';
    $this->email='';
    $this->phone='';
    }

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
    public function set_status($s){
        $this->status=$s;
    }

    public function get_name(){
        return $this->name;
    }
    public function get_username(){
        return $this->username;
    }
    public function get_email(){
        return $this->email;
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

    public function get_status(){
        return $this->status;
    }
    public function get_date(){
        $this->date=date('Y:m:d');
        return $this->date;
    }
    public function get_time(){
        $this->time=date('h:i');
        return $this->time;
    }
    public function write_user(){
        $database=new Database();
        $db=$database->get_connection();
        try{
            $query = "
            INSERT INTO Users(fullname, username, userPassword,dateMade,timeMade)
            VALUES(:name, :username, :userPassword, :dateMade, :timeMade);
        ";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $this->get_name());
        $statement->bindValue(':username', $this->get_username());
        $statement->bindValue(':userPassword', $this->get_password()); // Corrected
        $statement->bindValue(':dateMade', $this->get_date()); // Corrected
        $statement->bindValue(':timeMade', $this->get_time()); // Corrected
        $this->set_status($statement->execute());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_user(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT * FROM User
                    WHERE userID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->get_userID());
            $statement->execute();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_posts(){
        try{
            $database=new Database();
            $db=$database->get_connection();
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

trait validateUser{
    function validate_username(){}
    function validate_name(){}
    function validate_email(){}
    function validate_phone(){}
}
?>