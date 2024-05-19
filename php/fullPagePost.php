<?php
// a single post object 
$post=new Post();
$user=new User();
// more info on post like comments, 

// http url 
// authorName(username)/postID 

if($_SERVER['REQUEST_METHOD']=='GET'){
    include('Htmls/fullPage.html');
    return;
}
switch($action){
    case 'like':
        break;
    case 'comment':
        break;  
}

?>