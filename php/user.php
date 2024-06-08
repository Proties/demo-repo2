<?php 
class Users{
    use validateUser;
    private $name;
    private $username;
    private $bio;
    private $profilePicture;
    private $dateOfBirth;
    private $password;
    private $email;
    private $phone;
    private $date;
    private $time;
    private $userProfileLink;
    private $status;
    private $id;
    private $userDir;
    private $authanticated;
    private $errorMessages=array();
    private $errorMessage;
    private $userObjects=array();

    public function __construct(){
    $this->name='';
    $this->userDir='';
    $this->username='';
    $this->bio='';
    $this->profilePicture='';
    $this->dateOfBirth='';
    $this->password='';
    $this->email='';
    $this->phone='';
    $this->id=null;
    }

    public function initialise($arr){
        $this->set_username($arr['username']);
    }
    public function set_name($nm){
        $this->name=$nm;
    }
    public function set_id($nm){
        $this->id=$nm;
    }
    public function set_username($nm){
        $this->username=$nm;
    }
    public function set_profilePicture($pic){
        $this->profilePicture=$pic;
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
    public function set_bio($s){
        $this->bio=$s;
    }
     public function set_email($s){
        $this->email=$s;
    }

    public function set_profileLink($pl){
        $this->userProfileLink;
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
        return $this->profilePicture;
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
    public function get_id(){
        return $this->id;
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
    public function get_profileLink(){
        return $this->userProfileLink;
    }
    public function get_errorMessage(){
        return $this->errorMessage;
    }
    public function get_errorMessages(){
        return $this->errorMessages;
    }

    public function get_userObjects(){
        return $this->userObjects;
    }
    public function get_bio(){
        return $this->bio;
    }
    public function is_authanticated(){
        if($this->authanticate==true){
            $this->authanticate;
            return true;
        }
        return false;
        
    }
    public function is_user_dir_present(){
        
    }
    public static function search_user($user){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query='
                SELECT username FROM Users
                WHERE username LIKE :name
                LIMIT 5;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',"%$user%");
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExecption $err){
            echo 'error looking for username '.$err->getMessages();
        }
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
        $statement->bindValue(':userPassword', $this->get_password()); 
        $statement->bindValue(':dateMade', $this->get_date()); 
        $statement->bindValue(':timeMade', $this->get_time()); 

        
        $this->set_status($statement->execute());
        $this->set_id($db->lastInsertId());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_user(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT * FROM Users
                    WHERE userID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->get_id());
            $this->set_status($statement->execute());
            $data=$statement->fetch();
            $this->set_username($data['username']);
            $this->set_name($data['fullname']);
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_userID(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT userID FROM Users
                    WHERE username=:uname;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':uname',$this->get_username());
            $stmt->execute();
            $data=$stmt->fetch();
            $this->set_id($data['userID']);
        }catch(PDOExeception $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_posts(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT postID FROM post
                    WHERE userID=:id;
            ";
            $statement->bindValue(':id',$this->get_authorID());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public static function get_usernames(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT username FROM Users
            ";
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExeception $err){
            echo $err->getMessage();
        }
    }
    public static function validate_username_in_database($name){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT username FROM Users
                    WHERE username=:username;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':username',$name);
            $stmt->execute();
            $id=$stmt->fetch();
            if($id==true){
                return true;
            }
            return false;
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
            return false;
        }
    }
    public function set_dir($dir){
        $this->userDir=$dir;
    }
    public function get_dir(){
        $this->userDir='./userProfiles/'.$this->get_username().'/';
        return $this->userDir;
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
    public function add_image_to_profile(){}
}

trait validateUser{
    function validate_username_url($txt){
        $pattern='/(\/@[a-z0-9]{3,})/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_username($txt){
        $pattern="/[a-z]{1,}/i";
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
        
    }
    function validate_name($txt){
        $pattern='/[a-z]{1,}/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_email($txt){
        $pattern='/[a-z]{1,}/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_password($txt){
        $pattern='/[a-z]{3,}/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
}
?>