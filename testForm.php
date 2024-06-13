<?php 
if($_SERVER['REQUEST_METHOD']=='GET'){
	include_once('form.html');
	exit();

}
class Staticstics{

}
class FormSubmission{

}
class FormResponse{

}
class FormItem{

	private $image;
	private $name;
	private $id;
	private $element;
	private $type;
	private $descriptiom;
	private $question;
	private $required;
	private $data=array();
	private $options=array();

	public function __construct(){
		$this->required=false;
		$this->question='';
	}
	public function set_question($i){
		$this->question=$i;
	}
	public function set_element($i){
		$this->element=$i;
	}
	public function set_id($i){
		$this->id=$i;
	}
	public function set_type($i){
		$this->type=$i;
	}
	public function set_description($i){
		$this->description=$i;
	}
	public function set_required($i){
		$this->required=$i;
	}
	public function set_options($i){
		$this->options[]=$i;
	}
	public function set_image($i){
		$this->image=$i;
	}
	public function set_data($i){
		$this->data[]=$i;
	}

	public function get_question(){
		return $this->question;
	}
	public function get_element(){
		return $this->element;
	}
	public function get_id(){
		return $this->id;
	}
	public function get_type(){
		return $this->type;
	}
	public function get_description(){
		return $this->description;
	}
	public function get_required(){
		return $this->required;
	}
	public function get_options(){
		return $this->options;
	}
	public function get_image(){
		return $this->image;
	}
	public function get_data(){
		return $this->data;
	}
}
class Form{
	private $fileName;
	private $files=array();
	private $name;
	private $description;
	private $backgroundImage;
	private $backgroundColor;
	private $fontSize;
	private $fontFamily;
	private $bold;
	private $status;

	private $buttonText;
	private $buttonColor;
	private $buttonWidth;
	private $buttonHeight;
	private $content=array();

	public function __construct(){
		$this->fileName='dummyForm.html';
		$this->buttonText='submit';
	}

	public function set_fileName($nm){
		$this->fileName=$nm;
	}
	public function set_name($nm){
		$this->name=$nm;
	}
	public function set_description($nm){
		$this->description=$nm;
	}
	public function set_backgroundImage($nm){
		$this->backgroundImage=$nm;
	}
	public function set_backgroundColor($nm){
		$this->backgroundColor=$nm;
	}
	public function set_status($nm){
		$this->status=$nm;
	}


	public function get_fileName(){
		return $this->fileName;
	}
	public function get_name(){
		return $this->name;
	}
	public function get_description(){
		return $this->description;
	}
	public function get_backgroundImage(){
		return $this->backgroundImage;
	}
	public function get_backgroundColor(){
		return $this->backgroundColor;
	}
	public function get_status(){
		return $this->status;
	}
	public function get_content(){
		return $this->content;
	}
	public function get_buttonText(){
		return $this->buttonText;
	}

	public function add_input($arr){
		$this->get_content()[]=$arr;

	}
	public function read_form(){
		$content=file_get_contents($this->get_fileName());
		$this->set_name();
		$this->set_description();
		$this->set_backgroundColor();
		$this->set_backgroundImage();
		// check if form elements present
		$pattern_one='<form></form>';
		// get compination of label and input elements
		// store input and label elements in object then store object in array
		// get label and select elements and store in array
		//preseve order of elements
		$pattern_two='/<h1 class="formName"></h1>/';
		$pattern_three='/<div class=\'formDescription\'>/';
		$pattern_four='/div class=\'elements\'>/';

	}
	public function populate_editor(){

	}
	//create html page with a our form inside it 
	public function create_form($arr){
		$file=fopen($this->get_fileName(), 'w');
		$header='
			<!DOCTYPE html>
			<html>
			<head>
			<title></title>
			</head>
			<body>
			<h1 class="formName">'.$this->get_name().'</h1>
			<div class="formDescription">

			</div>
			<form>';
		$len=count($arr);
		$content='';
		for($ab=0;$ab<$len;$ab++){
		
			$content.=$arr[$ab];
		}
		$footer='
			<button>'.$this->get_buttonText().'</button>
			</form>
			</body>
			</html>
		';
		$full_page=$header.$content.$footer;
		fwrite($file,$full_page);
		fclose($file);

	}
}
class DynamicForm{
	private $userID;
	private $authorID;
	private $changingContent=array();
	private $conditions=array();


	public function get_userID(){}
	public function get_authorID(){}
	public function get_changingContent(){
		$this->changingContent;
	}
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['action'])){
		$action=$_POST['action'];
		$data=array();
		switch ($action) {
			case 'initialise_forms':
				$form=new Form();
				$m=scandir('/Users/rotondwanemutavhani/desktop/testApp/kjo');
				for($i=0;$i<count($m);$i++){
					$pattern='/(form)(.html)$/i';
					
					if(preg_match($pattern, $m[$i])){
						$data['forms'][]=$m[$i];
				
					}
				}
				echo json_encode($data);
				break;
			case 'open_form':
				$form=new Form();
				$form->set_fileName($_POST['formName']);
				$form->read_form();

				$data['form']=array('formName'=>$form->get_name(),'formDescription'=>$form->get_description(),
					'formBackgoundColor',$form->get_backgroundColor());
				$data['button']=array('buttonText'=>$form->get_buttonText(),'buttonWidth'=>$form->get_buttonWidth(),'buttonHeight'=>$form->get_buttonHeigt());
				for($aa=0;$aa<$inputLength;$aa++){
					$input=new FormItem();
					$data['input'][]=array('question'=>$input->get_question(),'element'=>$input->get_element(),'required'=>$input->get_required(),
						'description'=>$input->get_description(),'color'=>$input->get_color(),'options'=>$input->get_options());
				}
				
				
				echo json_encode($data);
				break;
		}
		exit();
	}
	
	$f=file_get_contents('php://input');
	$f_data=json_decode($f,true);
	

	
	$form=new Form();
	$form->set_name($f_data['form']['formName']);
	$form->set_description($f_data['form']['formDescription']);
	$form->set_backgroundColor($f_data['form']['backgroundColor']);
	$form->set_backgroundImage($f_data['form']['backgroundImage']);
	$len=count($f_data['inputs']);
	$content='';
	$store=array();

	for($i=0;$i<$len;$i++){
		$inputItems=new FormItem();

		$inputItems->set_question($f_data['inputs'][$i]['question']);
		$inputItems->set_image($f_data['inputs'][$i]['image']);
		// $inputItems->set_color($f_data['inputs'][$i]['color']);
		$inputItems->set_required($f_data['inputs'][$i]['required']);
		$inputItems->set_type($f_data['inputs'][$i]['type']);
		$inputItems->set_element($f_data['inputs'][$i]['element']);

		$content.='<div class="elements">';
		$content.='<img src="" rel="test">';
		$content.='<label>'.$inputItems->get_question().'</label>';
		if($inputItems->get_element()=='select'){
			$inputItems->set_options($f_data['inputs'][$i]['options']);
			$len_two=count($inputItems->get_options()[0]);
			$optionItems=$inputItems->get_options()[0];

	
			$content.='<select>';
			for($a=0;$a<$len_two;$a++){
				$content.='<option>'.$optionItems[$a].'</option>';
		
			}
			$content.='</select>';
		}
		if($inputItems->get_element()=='input'){
		
		$content.='<input type='.$inputItems->get_type().'>';
			
		}
		if($inputItems->get_element()=='textarea'){
			$content.="<textarea ></textarea>";
		}
		$content.="</div>";
		$content.="<br>";
		$inputItems->set_data($content);
		$store[]=$content;
		// $form->add_input($inputItems->get_data());

	}
	$form->create_form($store);
}


?>
