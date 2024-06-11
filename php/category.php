<?php
class Category{
    private $categoryName;
    private $categoryID;
    private $date;
    private $time;
    private $status;
    private $errorMessage;
    private $viewCount;
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

    public static function read_category(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT categoryID,categoryName FROM category
                    LIMIT 5;
                ";
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();

        }
    }
    public function write_category(){
        $database=new Database();
        $db=$database->get_connection();
        try{
            $db->begin_transaction();
            $query_one='
                    INSERT INTO Category()
                    VALUES(:categoryName,:postID,:catDate,:catTime,:vw);
                ';
            $stmt=$db->prepare($query_one);
            $stmt=$db->prepare($query);
            $stmt->bindValue(':categoryID',$this->get_categoryID());
            $stmt->bindValue(':postID',$this->get_categoryName());
            $stmt->bindValue(':catDate',$this->get_categoryDate());
            $stmt->bindValue(':catTime',$this->get_categoryTime());
            $stmt->bindValue(':vw',$this->get_viewCount());
            $stmt->execute();
            $this->set_categoryID($stmt->lastInsertId());
             $query_two='
                    INSERT INTO post_category
                    VALUES(:catID,:post);
            ';
            $stmt_two=$db->prepare($query_two);
            $stmt_two->bindValue(':catID',$this->get_categoryID());
            $stmt_two->bindValue(':post',$this->get_postID());
            $stmt_two->execute();
            $db->commit();
        }catch(PDOExecption $err){
            $db->rollBack();
            echo 'Error writing to category table '.$err->getMessage();
        }
    }
    public function update_category(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query='

            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue('');
            $stmt->execute();

        }catch(PDOException $err){
            echo 'database error categorytable '.$err->getMessage();
        }
    }
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