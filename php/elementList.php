<?php 
class Element{

	private $name;
	private $type;
	private $order;
	private $position;
	private $id;
	private $class;
	private $zIndex;
	private $name;
	private $list;
	public function __construct(){}
	
}
class ElementList{
private $list=[];
public function __construct(){}
public function add_item(Element $item){}
public function duplicate_item(Element $item){}
public function remove_item(Element $item){}
public function gets_items(Element $item){}
}


?>