<?php
session_start();
use Insta\Template\Template;
use Insta\Database\Template\TemplateDB;
use Insta\Databases\Database;
$data=[];
$errorMessages=[];
if($_SERVER['REQUEST_METHOD']=='GET'){


    setcookie('uploadTemplateStatus','',time()-(30*10),'/');
    include_once('Htmlfiles/uploadTemplate.html');
    return;
}
if($_SERVER['REQUEST_METHOD']=='POST')
{

 setcookie('uploadTemplateStatus','',time()-(30*10),'/');
try{
$temp=new Template();
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
    $temp->set_filename($_FILES['templateHtmlFile']['tmp_name']);
    $temp->set_image($_FILES['templateImageFile']['tmp_name']);
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

    $htmlNewfile='templates/'.$htmlTmpname;
    $cssNewfile='./templates/'.$cssTmpname;
    $imageNewfile='./templates/'.$imageTmpname;

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
} catch (Exception $e) {
    $db->rollBack();
    $data['status']='failed';
    $data['error']=$e->getMessage();
    $data['errors']=$errorMessages;

   

}
}catch(PDOException $err){
    $data['status']='failed';
    $data['error']=$e->getMessage();
}
    // this cookie will have values that have passed validation checks then fill then in the form
 // setcookie('uploadTemplateTempInfo',json_encode($data),time()+(30*10),'/');
setcookie('uploadTemplateStatus',json_encode($data),time()+(30*10),'/');
include_once('Htmlfiles/uploadTemplate.html');
}