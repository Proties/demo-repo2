<?php 
class Category{
    private $name;
    private $id;
    private $userID;
    private $postID;
    private $posts;
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
    public function get_name(){
        return $this->name;
    }
    public function get_id(){
        return $this->id;
    }

    public function write_category(){
        try{
            $query="
                    INSERT INTO ()
                    VALUES;
                ";
            $db->prepare($query);
            $db->execute();
        }catch(PDOExecption $err){
        echo 'works well';
        echo $err->getMeesage();
    }
}
    public function read_category(){}

}

?>