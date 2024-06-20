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

$action=$_POST['action'];
switch($action){
    case 'initialise_post_preview':
        $post=new Post();
        $post->set_postLink($_SERVER['REQUEST_URI']);
        $post->read_postID();
        $post->read_post();
        $data=array(
        'caption'=>$post->get_caption(),
        'authorName'=>$post->get_authorName(),
        'img'=>$post->get_img(),
        'comments'=>$post->get_comments(),
        'postID'=>$post->get_id()
        );
        echo json_encode($data);
        break;
    case 'initialise_image':
        $data=array();
        $data['user']=array('username'=>$mainUser->get_username(),'userID'=>$mainUser->get_id());
        $info=Ranking::chrono();
        $categories=Category::read_category();
        $arrLen=count($info);
        $catLen=count($categories);
        for($i=0;$i<$catLen;$i++){
            $data['categories'][]=array('categoryName'=>$categories[$i]['categoryName'],'categoryId'=>$categories[$i]['categoryID']);
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
            'primary_post'=>array('img'=>chunk_split(base64_encode(file_get_contents($primary_post->get_postLink())),76,"\n")),
            'secondary_post'=>array('img'=>chunk_split(base64_encode(file_get_contents($secondary_post->get_postLink())),76,"\n"))
        );
            }
        echo json_encode($data);
        break;
    case 'select_category':
        $category=new Category();
        $category->set_categoryName($_POST['categoryName']);
        $post=new Post();
        $categoryPosts=$post->read_category_posts();
        $catLen=count($categoryPosts);
        $data=array();
        for($i=0;$i<$catLen;$i++){
            $primary_post=new Post();
            $secondary_post=new Post();
            $primary_post->set_img($categoryPosts[$i]['picture']);

            $secondary_post->set_img($categoryPosts[$i]['picture']);
           
            $user=new Users();

            $data['users'][]=array(
                'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                'primary_post'=>array('img'=>base64_encode($primary_post->get_img())),
                'secondary_post'=>array('img'=>base64_encode($secondary_post->get_img()))
            );
        }
        echo json_encode($data);
        break;
    case 'search':
        $data=array();
        $target=$_POST['q'];
        $usernames=Users::search_user($target);
        $data['searchResults']=$usernames;
        echo json_encode($data);
        break;
    case 'comment':
        if(!$mainUser->is_authenticated()){
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
        $comment->write_comment();
        break;
    case 'like':
        if(!$mainUser->is_authenticated()){
            $msg='user not registered';
            $data=array('status'=>'failed','message'=>$msg);
            echo json_encode($data);
            return;
        }
        $postID=$_POST['postID'];
        $post=new Post();
        $post->set_postID($postID);
        $post->write_like();
        break;
    case 'view_more_comments':
        $data;
        $post=new Post();
        $post->set_id($_POST['postID']);
        $info=$post->get_comments();
        for($c=0;$c<count($info);$c++){
            $comment=new Comment();
            $comment->set_id($info['id']);
            $comment->read_comment();
            $ele=array(
            "username"=>$post->get_authorName(),
            "comment"=>$comment->get_comment()
            );
            array_push($ele,$data);
        }
        echo json_encode($data);
        break; 
    case 'view_more_posts':
        for($x=0;$x<count($info);$x++){
            if(find_userObject($info[$x]['username'])==true){
                $user=get_userObject($info[$x]['username']);
                $secondary_post=new Post();
                $secondary_post->set_img($info[$x]['picture']);
               
                $data[]=array(
                'secondary_post'=>array('img'=>base64_encode($secondary_post->get_img()))
                );
            }else{
                $user=new Users();
                $primary_post=new Post();
                $user->set_username($info[$x]['username']);
                $primary_post->set_img($info[$x]['picture']);
      
                $data[]=array('user'=>array(
                    'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                    'primary_post'=>array('img'=>base64_encode($primary_post->get_img()))
                )
                );
                }
                }
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