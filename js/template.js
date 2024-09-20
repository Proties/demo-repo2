"strict"
class Template{
	constructor(){
		this._owner;
		this._name;
		this._header;
		this._content;
		this._footer;
		this._elements=[];
		this._objects=[];
	}

	
	
}

class TemplateUI extends Template{
	constructor(){
		super();
		this._cont;
		this._maxShapes;
		this._maxText;
		this._maxGallery;
		this._maxList;
		this._maxSections;
		this._maxElements;
		this._modifiable=true;
		this._deleteable=true;

	}
	load_html(){}
	load_css(){}
}
export default TemplateUI;