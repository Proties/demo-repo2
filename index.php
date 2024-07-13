<?php
try{
    
    require_once 'vendor/psr/log/src/LoggerInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Dotenv.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/WriterInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/ReaderInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/RepositoryInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/AdapterInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/EnvConstAdapter.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/MultiReader.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/MultiWriter.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/ImmutableWriter.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/AdapterRepository.php';


    require_once 'vendor/graham-campbell/result-type/src/Result.php';
    require_once 'vendor/graham-campbell/result-type/src/Success.php';

    // require_once 'vendor/graham-campbell/result-type/src/Success.php';

    require_once 'vendor/vlucas/phpdotenv/src/Util/Regex.php';
    require_once 'vendor/vlucas/phpdotenv/src/Util/Str.php';
    require_once 'vendor/vlucas/phpdotenv/src/Store/File/Reader.php';
    require_once 'vendor/vlucas/phpdotenv/src/Loader/LoaderInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Loader/Loader.php';
    require_once 'vendor/vlucas/phpdotenv/src/Loader/Resolver.php';

    require_once 'vendor/vlucas/phpdotenv/src/Parser/ParserInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Parser/Parser.php';
    require_once 'vendor/vlucas/phpdotenv/src/Parser/Lines.php';
    require_once 'vendor/vlucas/phpdotenv/src/Parser/EntryParser.php';
    require_once 'vendor/vlucas/phpdotenv/src/Parser/Lexer.php';
    require_once 'vendor/vlucas/phpdotenv/src/Parser/Value.php';
    require_once 'vendor/vlucas/phpdotenv/src/Parser/Entry.php';
    require_once 'vendor/vlucas/phpdotenv/src/Store/File/Paths.php';
    require_once 'vendor/vlucas/phpdotenv/src/Store/StoreInterface.php';
    require_once 'vendor/vlucas/phpdotenv/src/Store/StoreBuilder.php';
    require_once 'vendor/vlucas/phpdotenv/src/Store/FileStore.php';
    echo 'works';
    // require_once 'vendor/phpoption/phpoption/src/phpoption/Option.php';
    // require_once 'vendor/phpoption/phpoption/src/phpoption/None.php';
    // require_once 'vendor/phpoption/phpoption/src/phpoption/some.php';

    // require_once 'vendor/phpoption/phpoption/src/phpoption/some.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/RepositoryBuilder.php';
    require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/ServerConstAdapter.php';
     echo 'works';
    // require_once 'vendor/vlucas/phpdotenv/src/Repository/Adapter/ServerConstAdapter.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Level.php';
    require_once 'vendor/monolog/monolog/src/Monolog/ResettableInterface.php';
    require_once 'vendor/monolog/monolog/src/Monolog/DateTimeImmutable.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Formatter/FormatterInterface.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Formatter/NormalizerFormatter.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Formatter/LineFormatter.php';
    require_once 'vendor/monolog/monolog/src/Monolog/LogRecord.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Utils.php';

    require_once 'vendor/monolog/monolog/src/Monolog/Handler/FormattableHandlerInterface.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/ProcessableHandlerInterface.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/FormattableHandlerTrait.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/ProcessableHandlerTrait.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/HandlerInterface.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/Handler.php';
  
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/AbstractHandler.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/Handler.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php';

   

    require_once 'vendor/monolog/monolog/src/Monolog/Logger.php';
    require_once 'vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php';
    require_once 'php/userCache.php';
    require_once 'php/postsList.php';
    require_once 'php/error.php';
    require_once 'php/user.php';
    require_once 'php/userDB.php';
    require_once 'php/post.php';
    require_once 'php/postDB.php';
    require_once 'php/database.php';
    require_once 'php/userFile.php';
    require_once 'php/userAuth.php';
    require_once 'php/image.php';
    require_once 'php/userAuth.php';
    require_once 'php/commentList.php';
    require_once 'php/categoryList.php';
    require_once 'php/collaboratorList.php';
    require_once 'php/category.php';
    require_once 'php/location.php';
    require_once 'php/imageFile.php';
    require_once 'php/categoryDB.php';
    require_once 'php/imageDB.php';
    require_once 'php/collaborator.php';
    require_once 'php/collaboratorDB.php';
    require_once 'php/rank.php';
    require_once 'php/locationDB.php';
    echo 'last check works';
}catch(Exception $err){
    echo 'error while loading files';
    echo $err->getMessage();
    return;
}

use Dotenv\Dotenv;
use Monolog\Level;
use monolog\Logger;
use Monolog\Handler\StreamHandler;
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Databases\Database;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$log=new Logger('start');
$log->pushHandler(new StreamHandler('php/file.log',Level::Warning));

// $list=apache_request_headers();
// var_dump($list);

$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);
$txt=substr($f_txt,2);

$user=new Users();
$post=new Post();
$userDB=new UserDB($user);
$postDB=new PostDB($post);
if($post->validate_postLink($f_txt) ){
    if( $postDB->validate_in_db_postLink($txt)==true){
    $data=[];
    $cs;
    if(isset($_POST['action'])){
       $cs=$_POST['action']; 
    switch($cs){
        case 'initialise_preview':
            echo 'preview window works';
            return;
        break;
        case 'get_more_comments':
            $c=new Comment();
            $cDB=new CommentDB($c);
            $c->set_id($_POST['commentID']);
            $c->read_more();
            echo json_encode($data);
            break;
        default:
            echo 'things just works';
        break;
    }
    }   
    try{
        $post=new Post();
        $postDB=new PostDB($post);
        $link=substr($f_txt,strrpos($f_txt,"/")+1);
        

        $postID=$postDB->get_postID_from_link($link);
       
        $comment=new Comment();
        $comment->set_postID($postID['postID']);
        $commentDB=new CommentDB($comment);
        $commentDB->read_comments();
        $arrayComment=$commentDB->comment->get_comments();
        if(!is_array($arrayComment)){
            echo 'empty';
            return;
        }
        $len=count($arrayComment);
        for($c=0;$c<$len;$c++){
            $user->set_username($arrayComment[$c]['username']);
            $comment->set_id($arrayComment[$c]['commentID']);
            $comment->set_comment($arrayComment[$c]['commentText']);
            $data['comments'][$c]=array('username'=>$arrayComment[$c]['username'],'comment'=>$comment->get_comment());
        }
        $data['status']='success';
        echo json_encode($data);
    }catch(Exception $err){
        $data['status']='failed';
        $data['message']=$err->getMessage();
        $log->warning($err->getMessage());
        echo json_encode($data);
    }
   return;
}
}   
else if($user->validate_username_url($f_txt)==true){
    if($userDB->validate_username_in_database($txt)!==false){
        include_once('php/profile.php');
        return;
    }
    
}else{

}

$log->warning($_SERVER['REQUEST_URI']);
$action=$_SERVER['REQUEST_URI'];
switch($action){
    case '/':
        include_once('php/homePage.php');
        break;
    case '/registration':
        include_once('php/registration.php');
        break;
    case '/profile':
        include_once('php/profile.php');
        break;
    case '/edit_profile':
        include_once('php/editPage.php');
        break;
    case '/upload_post':
        include_once('php/uploadPost.php');
        break;
    default:
        include_once('php/homePage.php');
        break;
}
return;

?>