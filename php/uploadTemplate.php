<?php
session_start();
use Insta\Template\Template;
use Insta\Database\Template\TemplateDB;
use Insta\Users\User;
use Insta\Database\Users\UserDB;
use Insta\Image\Image;
use Insta\Database\Image\ImageDB;
use Insta\Databases\Database;
$data=[];
$errorMessages=[];
$user=new Users();
$temp=new Template();
$image=new Image();
$db=Database::get_connection();
try {
    
    $db->beginTransaction();
    if(empty($_POST['templateName'])){
        $errorMessages['errTemplateName'][]='template name not valid';
    }
    if(empty($_POST['templatePrice'])){
        $errorMessages['errTemplateName'][]='template name not valid';
    }
    if(empty($_POST['templateType'])){
        $errorMessages['errTemplateName'][]='template name not valid';
    }
    if(empty($_FILES['templateImage'])){
        $errorMessages['errTemplateName'][]='template name not valid';
    }
    if(empty($_FILES['templateHtml'])){
        $errorMessages['errTemplateName'][]='template name not valid';
    }
    if(empty($_FILES['templateCss'])){
        $errorMessages['errTemplateName'][]='template name not valid';
    }
    $errorLen=count($errorMessages);
    if($errorLen>1){
        throw new Exception('there are issues');
    }

    $temp->set_name($_POST['templateName']);
    $temp->set_price($_POST['templatePrice']);
    $temp->set_type($_POST['templateType']);
    $temp->set_html($_FILES['templateHtml']['name']);
    $temp->set_css();
    $temp->set_image($_FILES['templateImage']);
    $temp->set_dateMade();
    $temp->set_timeMade();

    $image=new Image();
    $imageDB=new ImageDB($image);
    $tempDB=new TemplateDB($temp);
    $tempDB->set_db($db);
    $imageDB->set_db($db);

    $status=$tempDB->addTemplate();

    if($status==false){
        throw new Exception('something went wrong writing to database');
    }
    $imageDB->load_image();
    if(){
        move_uploaded_file($temp->get_filename(), destination);
    }
    if(){
        move_uploaded_file($temp->get_filename(), destination);
    }
    if(){
        move_uploaded_file($temp->get_filename(), destination);
    }
    $db->commit();
    $data['status']='success';
} catch (Exception $e) {
    $db->rollBack();
    $data['status']='failed';
    $data['error']=$e->getMessage();

   

}
 setcookie('uploadTemplate',json_encode($data),time()+(30*10),'/');