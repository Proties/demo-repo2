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
    private  $name;
    private  $lastName;
    private  $fullName;
    private  $username;
    private  $shortBio;
    private  $longBio;
    private  $profilePicture;
    private   $dateOfBirth;
    private  $password;
    private  $email;
    private  $phone;
    private  $date;
    private  $gender;
    private int $newPosts;
    private  $followingStatus;
    private  $occupation;

    private  $time;
    private   $userProfileLink;
    private bool $status;
    private int $id;
    private  $followingNo;
    private  $followerNo;
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

    $this->gender='';
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
    $this->data=[];
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
        return serialize($this->get_data());
        
    }
    public function unserialize($value){

        $data=unserialize($value);
        $this->set_id($data['userID']);
        // $this->set_username($data['username']);
        $this->set_fullName($data['lastName'].' '.$data['firstName']);
        $this->set_lastName($data['lastName']);
        $this->set_name($data['firstName']);
        $this->set_shortBio($data['shortBio']);
        $this->set_longBio($data['longBio']);
        $this->set_profilePicture($data['profilePicture']);
        $this->set_followingNo($data['followerNo']);
        $this->set_followerNo($data['followerNo']);
        $this->set_email($data['email']);
       
        $this->set_password($data['password']);
        if($data['gender']==null){
            $this->set_gender('male');
        }
        
        // $this->servedPosts->setPool($data['servedPosts']);


   
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
    public function set_gender( $nm){
        $this->gender=$nm;
    }
    public function set_occupation( $nm){
        $this->occupation=$nm;
    }
    public function set_profilePicture( $pic){
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
    public function set_longBio( $s){
        $this->longBio=$s;
    }
    public function set_shortBio( $s){
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
    public function set_followingNo( $no){
        $this->followingNo=$no;
    }
     public function set_followerNo( $no){
        $this->followerNo=$no;
    }
    public function get_data(){
        return $this->data=[
                'name'=>$this->get_name(),
                'lastName'=>$this->get_lastName(),
                'username'=>$this->get_username(),
                'fullName'=>$this->get_fullName(),
                'email'=>$this->get_email(),
                'password'=>$this->get_password(),
                
                'gender'=>$this->get_gender(),
                'shortBio'=>$this->get_shortBio(),
                'longBio'=>$this->get_longBio(),
                'userID'=>$this->get_id(),
                'profilePicture'=>$this->get_profilePicture(),
                'followingNo'=>$this->get_followingNo(),
                'followerNo'=>$this->get_followersNo(),
                'servedPosts'=>$this->servedPosts->getPool()
                ];
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
    public function hash_password(){
        $hash='';
        $this->set_password($hash);
    }
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
        $pattern='/[a-z]{2,}/i';
        if(preg_match($pattern,$txt)){
            return true;
        }
        return false;
    }
     function validate_bio(string $txt)
    {
        $pattern='/([a-z0-9\s\n]){4,/i';
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