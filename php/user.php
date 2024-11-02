<?php declare(strict_types=1);
namespace Insta\Users;
use Serializable;
use Insta\Users\UserAuth;
use Insta\Users\UserFolder;
use Insta\Template\Template;
use Insta\User\Pool\ViewedPosts;
use Insta\User\Pool\ServedPosts;
use Insta\User\Pool\FollowingUsers;
class Users implements Serializable{
    use validateUser;
    private string $name;
    private string $lastName;
    private string $fullName;
    private string $username;
    private string $shortBio;
    private string $longBio;
    private string $profilePicture;
    private string  $dateOfBirth;
    private string $password;
    private string $email;
    private string $phone;
    private string $date;
    private string $gender;
    private string $newPosts;
    private string $followingStatus;
    private string $occupation;

    private string $time;
    private string  $userProfileLink;
    private bool $status;
    private int $id;
    private int $followingNo;
    private int $followerNo;
    private array $recentSearchResults;


    private array $data;
    public Template $temp;
    public UserFolder $userFolder;
    public PostList $postList;
    public UserAuth $userAuth;

    public ViewedPosts $viewedPosts;
    public ServedPosts $servedPosts;
    public FollowingUsers $following;

    public function __construct(){
    $this->userFolder=new UserFolder();
    $this->userAuth=new UserAuth();
    $this->name='';

    $this->viewedPosts=new ViewedPosts();
    $this->servedPosts=new ServedPosts();
    $this->following=new FollowingUsers();

    $this->username='';
    $this->lastName='';
    $this->fullName='';
    $this->shortBio='';
    $this->longBio='';
    $this->profilePicture='';
    $this->dateOfBirth='';
    $this->password='';
    $this->email='';
    $this->phone='';
    $this->id=0;
    $this->followingNo=0;
    $this->followerNo=0;
    }
    //sets up associative array of to be serailized data
    public function __serialize():array 
    {
         $this->data=[];
         return $this->data; 
    }
    //restore arrray that was serialized
    public function __unserialize(array $data):void
    {
        $this->data=$data;
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
    public function set_fullName(string $nm){
        $this->fullName=$nm;
    }
    public function set_id(int $nm){
        $this->id=$nm;
    }
    public function set_username(string $nm){
        $this->username=$nm;
    }
    public function set_gender(string $nm){
        $this->gender=$nm;
    }
    public function set_occupation(string $nm){
        $this->occupation=$nm;
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
    public function set_longBio(string $s){
        $this->longBio=$s;
    }
    public function set_shortBio(string $s){
        $this->shortBio=$s;
    }
     public function set_email(string $s){
        $this->email=$s;
    }

    public function set_profileLink($pl){
        $this->userProfileLink;
    }
    public function set_recentSearchResults(array $pl){
        $this->recentSearchResults=$pl;
    }
    public function get_recentSearchResults():array 
    {
       return $this->recentSearchResults;
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
    public function get_fullName():string
    {
        return $this->fullName;
    }
    public function get_profilePicture():string
    {
        return $this->profilePicture;
    }
    public function get_password():string
    {
        return $this->password;
    }
    public function get_gender():string
    {
        return $this->gender;
    }
    public function get_occupation():string
    {
        return $this->occupation;
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

    public function get_followingNo():int
    {
        return $this->followingNo;
    }
    public function get_followersNo():int
    {
        return $this->followerNo;
    }
    public function get_auth(){
        return $this->userAuth;
    }
   public function get_File(){
    $this->$UserFolder;
   }
    public function get_longBio():string
    {
        return $this->longBio;
    }
    public function get_shortBio():string
    {
        return $this->shortBio;
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
    function validate_fullName(string $txt)
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
        $pattern='/^[a-zA-Z0-9]{1,}(.)+(@){1}([a-zA-Z\.]{1,})?[a-zA-Z]{1,}$/';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
     function validate_gender(string $txt)
    {
        $pattern='/(male|female)/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
     function validate_occupation(string $txt)
    {
        $pattern='/^(?=.)/';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
     function validate_bio(string $txt)
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