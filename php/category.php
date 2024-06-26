<?php declare(strict_types=1);
namespace Categories;
class Category{
    private string $categoryName;
    private int $categoryID;
    private string $date;
    private string $time;
    private string $status;
    private string $errorMessage;
    private int $viewCount;
    private CategoryList $posts;

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
  

    
   
    

}
trait validateCategory{
    function validate_name(){}
}

?>