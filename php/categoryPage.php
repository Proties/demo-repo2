<?php 
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/CategoryPage.html');
    return;
}
include_once('php/categories.php');
include_once('php/post.php');
$data=array();
$categoriesArray=array();
$action=$_POST['action'];

switch($action){
    case 'initialise':
        $categories=get_categories();
        for($i=0;$i<count($categories);$i++){
            $category=new Category();
            $category->set_name($categories[$i]);
            $categoriesArray[]=$category;
            $data[]=$categoriesArray;
        }
        break;
    case 'select_category':
        $categoryName=$_POST['categoryName'];
        $category=new Category();
        $category->set_name($categoryName);
        $category->read_posts();
        for($i=0;$i<count($category->get_post());$i++){

        }
        array_push($data,);
        break;
    
}

return json_encode($data);
?>