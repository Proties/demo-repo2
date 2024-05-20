<?php 
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/category.html');
    return;
}
include_once('php/categories');
include_once('php/post.php');

$categoriesArray=array();
$action=$_POST['action'];

switch($action){
    case 'initialise':
        $categories=get_categories();
        for($i=0;$i<count($categories);$i++){
            $category=new Category();
            $category->initialise($categories[$i]);

            array_push($category,$categoriesArray);
            array_push($categoriesArray,$data);
        }
        break;
    case 'select_category':
        $categoryID=$_POST['categoryID'];
        $cat=find_category_object($categoryID);
        $cat->get_post();
        array_push($data,$cat->get_post());
        break;
    
}
function find_category_object($id){

}
return json_encode($data);
?>