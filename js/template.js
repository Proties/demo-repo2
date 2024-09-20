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
	set _objects(obj){
		this._objects=obj;
	}
	get _objects(){
		return this._objects;
	}
	add_object(obj){
		this._objects.push(obj);
	}
	check_overlaps(current){
		for(let e=0;e<objects.length){
			if(current.x1 >=e.x1 && current.x2<=e.x2 && current.y1<=e.y1){

				console.log('collision')
			}
		}
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