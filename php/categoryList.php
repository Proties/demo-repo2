<?php declare(strict_types=1);
namespace Categories;
class CategoryList{
    private array $users_posts=[];
    private $dbstore;
    private $cachestore;
	public function __construct(){
	}
	public function search_category(Category $category):array
    {
        //return users matching this cate gory name
    }
    public function add_user(Users $post):bool
    {
        array_push($this->users_posts,$post);
    }
    public function remove_user(Users $post):bool
    {
        array_push($this->users_posts,$post);
    }
    public function move_user_up(Users $post):bool
    {
        array_push($this->users_posts,$post);
    }
    public function move_user_down(Users $post):bool
    {
        array_push($this->users_posts,$post);
    }
}


?>