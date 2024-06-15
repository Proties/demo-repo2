<?php 
class LikeDB extends Database{
    private $like;
    public function __construct(Like $like){
        $this->like=$like;
    }
    public function get_like(){
        return $this->like;
    }
    public function write_like(){}
}


?>