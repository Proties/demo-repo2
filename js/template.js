"strict"
class Template{
	constructor(){
		this._owner;
		this._name;
		this._header;
		this._content;
		this._footer;
	}

	load_html(){}
	load_css(){}
	
}

class TemplateUI extends Template{

}
export default TemplateUI;