<?php
class Category{
    private $categoryName;
    private $categoryID;
    private $date;
    private $time;
    private $status;
    private $errorMessage;
    private $posts=array();

    public function __construct(){
        $this->categoryName='';
        $this->categoryID=0;
        $this->date='';
        $this->time='';
        $this->status='';
        $this->errorMessage='';
    }

    public function set_categoryName($a){
        $this->categoryName=$a;
    }
    public function set_categoryID($a){
        $this->categoryID=$a;
    }
    public function set_date($b){
        $this->date=$b;
    }
    public function set_time($b){
        $this->time=$b;
    }
    public function set_status($c){
        $this->status=$c;
    }
    public function set_errorMessage($d){
        $this->errorMessage=$d;
    }

    public function get_categoryName(){
        return $this->categoryName;
    }
    public function get_categoryID(){
        return $this->categoryID;
    }
    public function get_date(){
        return $this->date;
    }
    public function get_time(){
        return $this->time;
    }
    public function get_status(){
        return $this->status;
    }
    public function get_errorMessage(){
        return $this->errorMessage;
    }
    public function get_posts(){
        return $this->posts;
    }

    public function read_category(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT categoryID FROM category
                    WHERE categoryName=:name;
                ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',$this->get_categoryName());
            $stmt->execute();

        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();

        }
    }
    public function write_category(){}
    public static function get_categories(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT categoryName FROM category
                ";
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }

}
trait validateCategory{
    function validate_name(){}
}

?>