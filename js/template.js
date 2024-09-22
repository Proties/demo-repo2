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
		this._templateList=[]
	}
	set objects(obj){
		this._objects=obj;
	}
	get objects(){
		return this._objects;
	}
	

	
	
}

class EditTemplate extends Template{
	constructor(){
		super();
	}

	add_object(obj){
		this._objects.push(obj);
	}
	check_overlaps(current){
		for(let e=0;e<objects.length;e++){
			if(current.x1 >=e.x1 && current.x2<=e.x2 && current.y1<=e.y1){

				console.log('collision');
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
		this._cont;
		this._parentContainer;

	}
	set cont(i){
		this._cont=i;
	}
	set parentContainer(i){
		this._parentContainer=i;
	}
	get cont(){
		return this._cont;
	}
	get parentContainer(){
		return this._parentContainer;
	}
	create_template_selection(){
		let cont=document.createElement('div');
		let lab=document.createElement('label');
		let labTxt=document.createTextNode('Select Template');
		let select=document.createElement('Select');

		
		for(let i=0;i<this.templateList;i++){
			let item=document.createElement('option');
			let itemTxt=document.createTextNode('option');
			item.append(itemTxt);
			select.append(item);
		}

		select.setAttribute('class','');
		select.setAttribute('id','');
		cont.setAttribute('class','');

		lab.append(labTxt);
		cont.append(lab);
		cont.append(select);

		this.cont=cont;
		this.parentContainer.append(this.cont);
	}

	get_template_from_server(){
		let directoryToTemplate='/'+this.name+'.html';

	}

	load_html(){}
	load_css(){}
}
export default TemplateUI;