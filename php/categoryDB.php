<?php 
class CategoryDB extends Database{
    private $category;
    public function __construct(Category $category){
        $this->category=$category;
    }
    public function get_category(){
        return $this->category();
    }
    public static function read_category(){
        try{
    
            $db=$this->get_connection();
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
        $db=$this->get_connection();
        try{
            $db->begin_transaction();
            $query_one='
                    INSERT INTO Category()
                    VALUES(:categoryName,:postID,:catDate,:catTime,:vw);
                ';
            $stmt=$db->prepare($query_one);
            $stmt=$db->prepare($query);
            $stmt->bindValue(':categoryID',$this->category->get_categoryID());
            $stmt->bindValue(':postID',$this->category->get_categoryName());
            $stmt->bindValue(':catDate',$this->category->get_categoryDate());
            $stmt->bindValue(':catTime',$this->category->get_categoryTime());
            $stmt->bindValue(':vw',$this->category->get_viewCount());
            $stmt->execute();
            $this->set_categoryID($stmt->lastInsertId());
             $query_two='
                    INSERT INTO post_category
                    VALUES(:catID,:post);
            ';
            $stmt_two=$db->prepare($query_two);
            $stmt_two->bindValue(':catID',$this->category->get_categoryID());
            $stmt_two->bindValue(':post',$this->category->get_postID());
            $stmt_two->execute();
            $db->commit();
        }catch(PDOExecption $err){
            $db->rollBack();
            echo 'Error writing to category table '.$err->getMessage();
        }
    }
   
    public function update_category(){
        try{
            $db=$this->get_connection();
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
            $db=$this->get_connection();
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


?>