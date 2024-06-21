<?php 
class LikeDB extends Database{
    private $like;
    public function __construct(Like $like){
        Database::__construct();
        $this->like=$like;
    }
    public function get_like(){
        return $this->like;
    }
    public function write_like(){
        $db=$this->get_connection();
        try{
            
            $query="
                    INSERT likes(userID,postID)
                    VALUES(:userID,:postID);

            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':userID',$this->like->get_userID());
            $stmt->bindValue(':postID',$this->like->get_postID());
            $stmt->execute();
        }catch(PDOException $err){
            echo 'error like table: '.$err->getMessage();
        }
    }
}


?>