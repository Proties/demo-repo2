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
    $this->authanticated=false;
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
    public function search_user_in_cache(){}
    public function search_email_in_cache(){}
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
        $pattern="/[a-z]{3,}[@.]?/i";
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
        
    }
    function validate_name($txt){
        $pattern='/[a-z]{10,}/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_email($txt){
        $pattern='/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_password($txt){
        $pattern='/[a-z]{13,}/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
}
?>