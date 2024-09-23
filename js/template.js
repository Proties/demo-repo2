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
	set templateList(s){
		this._templateList=s;
	}
	get templateList(){
		return this._templateList;
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
		this._templateList=['basic','paid'];
		this._selectedTemplate;
		this._selectTemplateInput;
		this._templateForm;
		this._addTemplateBtn;

	}
	set addTemplateBtn(i){
		this._addTemplateBtn=i;
	}
	get addTemplateBtn(){
		return this._addTemplateBtn;
	}
	set templateForm(i){
		this._templateForm=i;
	}
	get templateForm(){
		return this._templateForm;
	}
	set selectedTemplate(i){
		this._selectedTemplate=i;
	}
	get selectedTemplate(){
		return this._selectedTemplate;
	}
	set cont(i){
		this._cont=i;
	}
	set parentContainer(i){
		this._parentContainer=i;
	}
	set selectTemplateInput(i){
		this._selectTemplateInput=i;
	}
	get selectTemplateInput(){
		return this._selectTemplateInput;
	}
	get cont(){
		return this._cont;
	}
	get parentContainer(){
		return this._parentContainer;
	}
	load_basic(){}
	create_template_selection(){
		let cont=document.createElement('div');
		let lab=document.createElement('label');
		let labTxt=document.createTextNode('Select Template');
		let select=document.createElement('Select');

		
		for(let i=0;i<this.templateList.length;i++){
			let item=document.createElement('option');
			let itemTxt=document.createTextNode(this.templateList[i]);
			item.append(itemTxt);
			select.append(item);
		}

		select.setAttribute('class','');
		select.setAttribute('id','');
		cont.setAttribute('class','templateSelection');

		lab.append(labTxt);
		cont.append(lab);
		cont.append(select);
		this.selectTemplateInput=select;
		this.cont=cont;
		this.parentContainer.append(this.cont);
	}

	get_template_from_server(){
		console.log('======sending template request');
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/profile');
			xml.onload=function(){
				console.log('get template =========');
				console.log(this.responseText);
				let newElement=document.createElement('button');
				// let newElement=this.responseText;
				let main=document.body;
				console.log(main.childNodes);
				let oldElement=document.getElementsByClassName('container')[0];
				main.insertBefore(newElement,oldElement);
				oldElement.remove();
			}
			 xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.send('actions=selectTemplate&templateName='+this.selectedTemplate);
		}catch(err){
			console.log(err);
		}
		
	}
	template_button(){
		let cont=document.createElement('div');
		let p=document.createElement('span');
		let pTxt=document.createTextNode('Load Template Files');
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('+');

		p.append(pTxt);
		btn.append(btnTxt);
		cont.append(p);
		cont.append(btn);
		cont.setAttribute('class','addTemplate');
		btn.setAttribute('id','addTemplateFile');
		this.addTemplateBtn=btn;
		this.parentContainer.append(cont);
	}
	add_templateFile(){
		let topcont=document.createElement('div');
		let cont=document.createElement('div');
		let file=document.createElement('input');
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('submit');
		file.type='file';
		file.id='templateFiles';
		file.multiple=true;
		

		btn.append(btnTxt);
		cont.append(file);
		cont.append(btn);
		topcont.append(cont);
		topcont.setAttribute('class','modal');
		btn.setAttribute('id','submitTemplateFiles');
		topcont.style.display='block';
		this.templateForm=cont;
		this.parentContainer.append(topcont);
		// this.p.append(this.templateForm);

	}
	load_html(){}
	load_css(){}
}
export default TemplateUI;