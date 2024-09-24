<?php 
namespace Insta\Template;
use DOMDocument;
class HtmlTemplate{
	private $filename;
	private $directory;
	private DOMDocument $htmlFile;

	public function __construct($html){
		try {
			$this->htmlFile=new DOMDocument();
			@$this->htmlFile->loadHTMLFile($html);
		} catch (Exception $e) {
			return $e;
		}
		

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
		// saveHTMLFile();
		// schemaValidate($filename);
		// DOMNode::appendChild(DOMNode $node);
		// DOMNode::insertBefore(DOMNode $node, ?DOMNode $child = null);
		// DOMNode::removeChild(DOMNode $child);
		// DOMNode::replaceChild(DOMNode $node, DOMNode $child);
		// DOMNode::hasChildNodes();
		// prepend(DOMNode|string ...$nodes);
	}
	
	public function getStyle(){
		
	}
	public function getContainer(){
		$cont=$this->htmlFile->getElementsByTagName('div');
		$list=[];
		for($i=0;$i<count($cont);$i++){
			echo $this->htmlFile->saveHTML($cont[$i]), PHP_EOL;
		}

	}
	public function getHtml(){
		return $this->htmlFile;
	}
}


?>