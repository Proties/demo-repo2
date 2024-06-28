<?php declare(strict_types=1);
namespace Categories;
use Databases\Database;
use PDOExcepion;
class CategoryDB extends Database{
    private $category;
 
    public function __construct(Category $category){
        Database::__construct();
        $this->category=$category;
      }
    public function get_category()
    {
        return $this->category;
    }
    public static function stored_categories(Array $arr){
        $store=[];
        $status=apcu_fetch('categories');
        if($status==false){
            return false;;
        }
        $store['categories']=apcu_fetch('categories');
        return $store;
    }
    public function read_posts():array
    {
        try{

            $db=$this->get_connection();
            $query="
                    SELECT c1.categoryID,c1.categoryName,u1.username,p1.postLinkID,p1.postLink,p2.postLinkID as image2f,p2.postLink as image2n FROM category as c1
                    INNER JOIN post_category as pc1 ON c1.categoryID=pc1.categoryID
                    INNER JOIN post as p1 ON pc1.postID=p1.postID
                    INNER JOIN post as p2 ON pc1.postID=p2.postID
                    INNER JOIN Users as u1 ON p1.userID=u1.userID
                    WHERE c1.categoryName=:name
                    AND p1.postID<>p2.postID
                    GROUP BY (u1.username)
                    LIMIT 5;
                ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',$this->category->get_categoryName());
            $stmt->execute();
            $data=$stmt->fetchall();
            $this->category->get_posts($data);
        }catch(PDOExcepion $err){
            echo 'Database error: '.$err->getMessage();

        }
    }
    public function read_category(){
        try{
            $db=$this->get_connection();
            $query="
                    SELECT categoryID,categoryName FROM category
                    LIMIT 5;
                ";
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExcepion $err){
            echo 'Database error '.$err->getMessage();

        }
    }
    public function write_category(){
        $db=$this->db;
        try{

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
            $this->category->set_categoryID($stmt->lastInsertId());
        }catch(PDOExcepion $err){
            echo 'write to category error'.$err->getMessage();

        }
    }
    public function write_category_post(){
        try{
             $query_two='
                    INSERT INTO post_category
                    VALUES(:catID,:post);
            ';
            $stmt_two=$db->prepare($query_two);
            $stmt_two->bindValue(':catID',$this->category->get_categoryID());
            $stmt_two->bindValue(':post',$this->category->get_postID());
            $stmt_two->execute();
            $db->commit();
        }catch(PDOExcepion $err){
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

        }catch(PDOExcepion $err){
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
        }catch(PDOExcepion $err){
            echo 'Database error '.$err->getMessage();
        }
    }
}


?>