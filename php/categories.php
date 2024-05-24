<?php 
include_once('php/database.php');
class Category{
    use validateCategory;
    private $name;
    private $id;
    private $userID;
    private $postID;
    private $posts;
    private $date;
    private $time;
    private $status;
    public function __construct(){
        $this->name='';
        $this->userID=0;
    }

    public function set_name($nm){
        $this->name=$nm;
    }
    public function set_id($id){
        $this->id=$id;
    }
    public function set_status($st){
        $this->status=$st;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_status(){
        return $this->status;
    }
    public function get_date(){
        return $this->date;
    }
    public function get_time(){
        return $this->time;
    }
    public function write_category(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    INSERT INTO ()
                    VALUES;
                ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',$this->get_name());
            $stmt->bindValue(':date',$this->get_date());
            $stmt->bindValue(':time',$this->get_time());
            $this->set_status($stmt->execute());
        }catch(PDOExecption $err){
        echo 'works well';
        echo $err->getMeesage();
    }
}
    public function read_category(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT * FROM category
                    WHERE categoryID=:id;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$this->get_id());
            $this->set_status($stmt->execute());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function create_categorie_folder(){}
    public function create_categories_folder_name(){}
    public function add_links_post_in_folder(){}
}
trait validateCategory{
    function validate_name(){}
 
}
?>