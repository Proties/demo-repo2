<?php 
class CategoryList extends Category{
	public function __construct(){
		Category::__construct();
	}
	public function search_user(Users $post){
        array_push($this->posts,$post);
    }
    public function add_user(Users $post){
        array_push($this->posts,$post);
    }
    public function remove_user(Users $post){
        array_push($this->posts,$post);
    }
    public function move_user_up(Users $post){
        array_push($this->posts,$post);
    }
    public function move_user_down(Users $post){
        array_push($this->posts,$post);
    }
}


?>