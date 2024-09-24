<?php declare(strict_types=1);
namespace Insta\Users;
use Serializable;
use Insta\Users\UserAuth;
use Insta\Users\UserFolder;
class Users implements Serializable{
    use validateUser;
    private string $name;
    private string $lastName;
    private string $username;
    private string $shortBio;
    private string $bio;
    private string $profilePicture;
    private string  $dateOfBirth;
    private string $password;
    private string $email;
    private string $phone;
    private string $date;
    private string $time;
    private string  $userProfileLink;
    private bool $status;
    private int $id;
    private array $data;
    public UserFolder $userFolder;
    public PostList $postList;
    public UserAuth $userAuth;

    public function __construct(){
    $this->userFolder=new UserFolder();
    $this->userAuth=new UserAuth();
    $this->name='';
    $this->username='';
    $this->lastName='';
    $this->bio='';
    $this->profilePicture='';
    $this->dateOfBirth='';
    $this->password='';
    $this->email='';
    $this->phone='';
    $this->id=0;
    }
    //sets up associative array of to be serailized data
    public function __serialize():array 
    {
         $this->data=[];
         return $this->data; 
    }
    //restore arrray that was serialized
    public function __unserialize(array $data) 
    {
        $arr;
        return $arr;
    }
    public function serialize(){
        serialize($this->data);
        
    }
    public function unserialize($value){
        unserialize($value);
        return $s;
    }

    public function initialise(array $arr)
    {
        $this->set_username($arr['username']);
    }
    public function set_name(string $nm){
        $this->name=$nm;
    }
    public function set_lastName(string $nm){
        $this->lastName=$nm;
    }
    public function set_id(int $nm){
        $this->id=$nm;
    }
    public function set_username(string $nm){
        $this->username=$nm;
    }
    public function set_profilePicture(string $pic){
        $this->profilePicture=$pic;
    }
    public function set_password(string $pas){
        $this->password=$pas;
    }
    public function set_dateOfBirth(string $obj){
        $this->dateOfBirth=$obj;
    }
    public function set_posts(array $p){
        $this->posts=$p;
    }
    public function set_status(bool $s){
        $this->status=$s;
    }
    public function set_bio(string $s){
        $this->bio=$s;
    }
     public function set_email(string $s){
        $this->email=$s;
    }

    public function set_profileLink($pl){
        $this->userProfileLink;
    }
    public function get_name():string 
    {
        return $this->name;
    }
    public function get_lastName():string 
    {
        return $this->lastName;
    }
    public function get_username():string
    {
        return $this->username;
    }
    public function get_email():string
    {
        return $this->email;
    }
    public function get_profilePicture():string
    {
        return $this->profilePicture;
    }
    public function get_password():string
    {
        return $this->password;
    }
    public function get_dateOfBirth():string
    {
        return $this->dateOfBirth;
    }
    public function get_posts(array|null $arr=null)
    {
        return $this->postList=new PostList($arr);
    }
    public function get_id():int
    {
        return $this->id;
    }
    public function get_status():bool
    {
        return $this->status;
    }
    public function get_date():string
    {
        $this->date=date('Y:m:d');
        return $this->date;
    }
    public function get_time():string
    {
        $this->time=date('h:i');
        return $this->time;
    }
    public function get_profileLink():string
    {
        return $this->userProfileLink;
    }
    public function get_errorMessage():string
    {
        return $this->errorMessage;
    }
    public function get_errorMessages():string
    {
        return $this->errorMessages;
    }

   public function get_auth(){
    $this->userAuth;
   }
   public function get_File(){
    $this->$UserFolder;
   }
    public function get_bio():string
    {
        return $this->bio;
    }

    public function search_user_in_cache(){}
    public function search_email_in_cache(){}
}

trait validateUser{
    function validate_username_url($txt)
    {
        $pattern='/^\/\@(?=.*[a-z])(?=.*[\$_=\-])?(?=.*[0-9])?/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    //dont allow empty space
    function validate_username(string $txt)
    {
        $pattern="/(?=.*[a-z])(?=.*[\$_=\-])?(?=.*[0-9])?/i";
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
        
    }
    function validate_name(string $txt)
    {
        $pattern='/([a-z]{4,})/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_lastName(string $txt)
    {
        $pattern='/([a-z]{4,})/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_email(string $txt)
    {
        $pattern='/^(?=.)/';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
    function validate_password(string $txt)
    {
        $pattern='/(?=.*[a-z])(?=.*[\-\@#\$%\_=*\!\^])(?=.*[0-9])?/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
}
?>