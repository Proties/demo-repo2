<?php
session_start();
use Insta\Template\Template;
use Insta\Database\Template\TemplateDB;
use Insta\Databases\Database;
use Insta\Images\Image;
use Insta\Databases\Images\ImageDB;
$data=[];
$errorMessages=[];
function is_image_created(string $dir,string $filename){
     // search $dir for $filename if found return true else return false
    try{
        $files=scandir($dir);
        foreach ($files as $fils) {
            if($files==$filename){
                return true;
            }

        }
        return false;
    }catch(Exception $err){
        return false;
    }
   
    
}
function is_video_created(string $dir,string $filename){
     // search $dir for $filename if found return true else return false
    try{
        $files=scandir($dir);
        foreach ($files as $fils) {
            if($files==$filename){
                return true;
            }
        }
        return false;
    }catch(Exception $err){
        return false;
    }
   
    
}

//if user admin return files and template info back at them to make changes
if(isset($_SESSION['adminID'])){

}
if(isset($_POST['updateTemplate'])){}
if(isset($_POST['deleteTemplate'])){}
if($_SERVER['REQUEST_METHOD']=='GET'){


    setcookie('uploadTemplateStatus','',time()-(30*10),'/');
    include_once('Htmlfiles/uploadTemplate.html');
    return;
}
if($_SERVER['REQUEST_METHOD']=='POST')
{

$temp=new Template();
$image=new Image();
$db=Database::get_connection();
try {
    
    $db->beginTransaction();
    if(empty($_POST['templateName'])){
        $errorMessages[]['errTemplateName']='template name not valid';
    }
    if(empty($_POST['templatePrice'])){
        $errorMessages[]['errTemplatePrice']='template price not valid';
    }
    if(empty($_POST['templateType'])){
        $errorMessages[]['errTemplateType']='template type not valid';
    }
    if(empty($_FILES['templateImageFile'])){
        $errorMessages[]['errTemplateImage']='template image file not valid';
    }
    if(empty($_FILES['templateHtmlFile'])){
        $errorMessages[]['errTemplateHtmlFile']='template html file not valid';
    }
    if(empty($_FILES['templateCssFile'])){
        $errorMessages[]['errTemplateCssFile']='template css file valid';
    }
    $errorLen=count($errorMessages);
    if($errorLen>1){
        throw new Exception('there are issues');
    }

    $dateMade=date('Y:m:d');
    $timeMade=date('h:i');
    $temp->set_name($_POST['templateName']);
    $temp->set_price($_POST['templatePrice']);
    $temp->set_type($_POST['templateType']);
    $temp->set_filename('templates/'.$_FILES['templateHtmlFile']['name']);
    $temp->set_image('templates/'.$_FILES['templateImageFile']['name']);
    $temp->set_dateMade($dateMade);
    $temp->set_timeMade($timeMade);

   
    $tempDB=new TemplateDB($temp);
    $tempDB->set_db($db);


    $status=$tempDB->addTemplate();

    if($status==false){
        throw new Exception('something went wrong writing to database');
    }


    $htmlTmpname=$_FILES['templateHtmlFile']['tmp_name'];
    $cssTmpname=$_FILES['templateCssFile']['tmp_name'];
    $imageTmpname=$_FILES['templateImageFile']['tmp_name'];
    $basePath = __DIR__ . '/..';

    $templateDir=$basePath.'/templates/';
    if (!is_dir($templateDir)) {
    mkdir($templateDir, 0777, true);
    }
    $htmlNewfile=$templateDir . basename($_FILES['templateHtmlFile']['name']);
    $cssNewfile=$templateDir . basename($_FILES['templateCssFile']['name']);
    $imageNewfile=$templateDir . basename($_FILES['templateImageFile']['name']);

    if(!move_uploaded_file($htmlTmpname, $htmlNewfile)){
        throw new Exception('could not upload Html file');
    }
    if(!move_uploaded_file($cssTmpname, $cssNewfile)){
         throw new Exception('could not upload css file');
    }
    if(!move_uploaded_file($imageTmpname, $imageNewfile)){
         throw new Exception('could not upload image file');
    }
    $db->commit();
    $data['status']='success';
    setcookie('uploadTemplateStatus',json_encode($data),time()+(30*10),'/');
} catch (Exception $e) {
    $db->rollBack();
    $data['status']='failed';
    $data['error']=$e->getMessage();
    $data['errors']=$errorMessages;
    setcookie('uploadTemplateStatus',json_encode($data),time()+(30*10),'/');


   

}

include_once('Htmlfiles/uploadTemplate.html');
}