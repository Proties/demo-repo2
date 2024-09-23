<?php 
class Html{
	private $filename;
	private $directory;
	private DOMDocument $htmlFile;

	public function __construct($html){
		$this->htmlFile=new DOMDocument;
		$this->htmlFile->loadHTMLFile($html);
		$this->filename='';
		$this->directory='';
	}
	public function addElement($name){
		$element=new DOMElement();
	}

	public function addAttribute(){
		$attribute=new DOMAttr();
	}
	public function base(){
		saveHTMLFile();
		schemaValidate($filename);
		DOMNode::appendChild(DOMNode $node);
		DOMNode::insertBefore(DOMNode $node, ?DOMNode $child = null);
		DOMNode::removeChild(DOMNode $child);
		DOMNode::replaceChild(DOMNode $node, DOMNode $child);
		DOMNode::hasChildNodes();
		prepend(DOMNode|string ...$nodes);
	}
	

	public function getContainer(){
		$cont=$html->getElementByClassName('container')[0];
		return $cont;
	}
	public function getHtml(){
		$html;
		return $html;
	}
}


?>