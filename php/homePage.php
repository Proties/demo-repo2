<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}


$mainUser=new Users();
if(isset($_SESSION['userID']) && $_SESSION['userID']!==null){
    $mainUser->set_id($_SESSION['userID']);
    $mainUser->set_username($_SESSION['username']);
    // $mainUser->read_user();
}
$arrayPosts=[];
$arrayComments=[];
if(isset($_SESSION['postsServed'])){
    $arrayPosts=$_SESSION['postServed'];
}
if(isset($_SESSION['commentsServed'])){
    $arrayPosts=$_SESSION['commentServed'];
}
$action=$_POST['action'];
switch($action){
    case 'initialise_post_preview':
        $post=new Post();
        $post->set_postLink($_SERVER['REQUEST_URI']);
        $postDB=new PostDB($post);
        $postDB->read_postID();
        $postDB->read_post();
        $post_two=$postDB->get_post();
        $data=array(
        'caption'=>$post_two->get_caption(),
        'authorName'=>$post_two->get_authorName(),
        'img'=>$post_two->get_filePath().$post_two->get_fileName(),
        'comments'=>$post_two->get_comments(),
        'postID'=>$post_two->get_id()
        );
      
        echo json_encode($data);
        break;
    case 'initialise_image':
        $data=array();
        $data['user']=array('username'=>$mainUser->get_username(),'userID'=>$mainUser->get_id());
        $rank=new Ranking();
        $info=$rank->chrono($arrayPosts);
        $categories=new Category();
        $categories=new CategoryDB($categories);
        $categories->read_category();
        $arrLen=count($info);
        if(!is_array($categories)){

        }else{
            $catLen=count($categories);
           for($i=0;$i<$catLen;$i++){
            $data['categories'][]=array('categoryName'=>$categories[$i]['categoryName'],'categoryId'=>$categories[$i]['categoryID']);
        } 
        }
        if(!is_array($info) || count($info)>1){
            $data['status']='empty';
            echo json_encode($data);
            return;
        }
    for($x=0;$x<$arrLen;$x++){
        $user=new Users();
        $primary_post=new Post();
        $user->set_username($info[$x]['username']);
        $primary_post->set_postLink($info[$x]['postLink']);
        $secondary_post=new Post();
        $secondary_post->set_postLink($info[$x]['post2Link']);
        $data['users'][]=array(
            'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
            'primary_post'=>array('img'=>$primary_post->get_filePath().$primary_post->get_fileName()),
            'secondary_post'=>array('img'=>$secondary_post->get_filePath().$secondary_post->get_fileName()
        ));
            }
        echo json_encode($data);
        break;
    case 'select_category':
        $data=[];
        $category=new Category();
        $category->set_categoryName($_POST['categoryName']);
        $categoryDB=new CategoryDB($category);
        $categoryDB->read_posts();
        $arrData=$category->get_post();
        $len=count($arrData);
        for($i=0;$i<$len;$i++){
            $primary_post=new Post();
            $secondary_post=new Post();
 

            $data['users'][]=array(
                'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                'primary_post'=>array('img'=>($primary_post->get_filePath().$primary_post->get_fileName())),
                'secondary_post'=>array('img'=>($secondary_post->get_filePath().$secondary_post->get_fileName()))
            );
        }
        echo json_encode($data);
        break;
    case 'search':
        $data=array();
        $target=$_POST['q'];
        $userDB=new UserDB($user);
        $usernames=$userDB->search_user($target);
        $data['searchResults']=$usernames;
        echo json_encode($data);
        break;
    case 'comment':
        if($mainUser->is_authanticated()==false){
            $msg='user not registered';
            $data=array('status'=>'failed','message'=>$msg);
            echo json_encode($data);
            return;
        }
        $text=$_POST['text'];
        $postID=$_POST['postID'];
        $comment=new Comment();
        $comment->set_postID($postID);
        $comment->set_comment($text);
        $commentDB=new CommentDB($comment);
        $commentDB->write_comment();
        break;
    case 'like':
        if($mainUser->is_authenticated()==false){
            $msg='user not registered';
            $data=array('status'=>'failed','message'=>$msg);
            echo json_encode($data);
            return;
        }
        $postID=$_POST['postID'];
        $post=new Post();
        $post->set_postID($postID);
        $postDB=new PostDB($post);
        $postDB->write_like();
        break;
    case 'view_more_comments':
        $data;
        $post=new Post();
        $post->set_id($_POST['postID']);
        $postDB=new PostDB($post);
        $info=$postDB->get_comments();

        for($c=0;$c<count($info);$c++){
            $comment=new Comment();
            $comment->set_id($info['id']);
            $commentDB=new CommentDB();
            $commentDB->read_comment($arrayComments);
            $ele=array(
            "username"=>$post->get_authorName(),
            "comment"=>$commentDB->$comment->get_comment()
            );
            array_push($ele,$data);
        }
        echo json_encode($data);
        break; 
    case 'view_more_posts':
        $rank=Ranking();
        $rank->chrono($arrayPosts);
        echo json_encode($data);
        break;
}

// a function that will take an array of user arrays
// the function will check for arrays with the same username and join em
// it will produce a new array that has a primary and secondary post
function search_name($username,$arr){
    for($i=0;$i<count($arr);$i++){
        if($arr[$i]['username']==$username){
            print_r("worksssss");
            return $arr[$i];
        }
    }
}
?>