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
		this._templateList;
		this._selectedTemplate;
		this._selectTemplateInput;
		this._templateForm;
		this._addTemplateBtn;
		this._selectionInput;
		this._html;
		this._css;
		this._data;
		this._filename;
		this._status;
		this._templateModal;

	}
	add(temp){
		this.templateList.push(temp);
	}
	set data(i){
		this._data=i;
	}
	get data(){
		return this._data;
	}
	set filename(i){
		this._filename=i;
	}
	get filename(){
		return this._filename;
	}
	set html(i){
		this._html=i;
	}
	get html(){
		return this._html;
	}
	set addTemplateBtn(i){
		this._addTemplateBtn=i;
	}
	get addTemplateBtn(){
		return this._addTemplateBtn;
	}
	set templateModal(i){
		this._templateModal=i;
	}
	get templateModal(){
		return this._templateModal;
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
	set selectionInput(i){
		this._selectionInput=i;
	}
	get selectionInput(){
		return this._selectionInput;
	}
	get cont(){
		return this._cont;
	}
	get parentContainer(){
		return this._parentContainer;
	}
	load_basic(){}
	create_template_selection(){
		console.log('=======creating template selection');
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

		select.setAttribute('class','templateSelect');
		select.setAttribute('id','selectTemplateInput');
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
	sendToHtmlServer(){
		try{
			let xml=new XMLHttpRequest();
            xml.open('POST','/profile');
            xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xml.send('actions=loadTemplate&filename='+this.filename+'&htmlData='+this.html);
		}catch(err){
			console.log(err);
		}
	}
	get_list(){
		
		try{
			let xml=new XMLHttpRequest();
            xml.open('POST','/profile');
            xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xml.send('actions=get_template_list');
		}catch(err){
			console.log(err);
		}
	}
	add_templateFile(){
		let topcont=document.createElement('div');
		let templateList=document.createElement('h1');
		let templateListTxt=document.createTextNode('Template List:');
		let closeWindow=document.createElement('span');
		let closeWindowTxt=document.createTextNode('close');
		let cont=document.createElement('form');
		let file=document.createElement('input');
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('submit');
		file.type='file';
		file.multiple=true;
		

		btn.append(btnTxt);
		cont.append(file);
		cont.append(btn);
		topcont.append(cont);
		templateList.append(templateListTxt);
		topcont.append(templateList);
		closeWindow.append(closeWindowTxt);
		topcont.append(closeWindow);
		closeWindow.setAttribute('class','closeWindow');
		cont.setAttribute('id','uploadTemplateForm');
		cont.setAttribute('class','uploadTemplateForm');
		cont.setAttribute('method','post');
		// cont.setAttribute('action','/upload_template'); 
		cont.setAttribute('enctype','multipart/form-data"');

		file.setAttribute('name','templateFiles');
		file.setAttribute('id','templateFiles');

		topcont.setAttribute('class','modal');
		topcont.setAttribute('id','templateModal');
		btn.setAttribute('id','submitTemplateFiles');
		// topcont.style.display='block';
		console.log('=====checking if working');


		this.templateModal=topcont;
		this.templateForm=cont;
		this.parentContainer.append(this.templateModal);
		this.template_more_options();

	}
	template_more_options(){
		console.log('tmeplate option==========');
		let bigCont=document.createElement('div');
		for(let i=0;i<this.templateList.length;i++){
			let cont=document.createElement('div');
			let fileUploadForm=document.createElement('form');
			let fileUpload=document.createElement('div');
			let file=document.createElement('input');
			let templateName=document.createElement('div');
			let templateNameTxt=document.createTextNode('Template Name: '+this.templateList[i].filename);
			let updateBtn=document.createElement('button');
			let updateBtnTxt=document.createTextNode('update template');
			let deleteBtn=document.createElement('button');
			let deleteBtnTxt=document.createTextNode('delete template');
			let hideBtn=document.createElement('button');
			let hideBtnTxt=document.createTextNode('hide template');

			let saveChangeBtn=document.createElement('button');
			let saveChangeBtnTxt=document.createTextNode('save Change');
			let cancelBtn=document.createElement('button');
			let cancelBtnTxt=document.createTextNode('cancel');


			let action=document.createElement('input');
			action.value='updateTemplate';
			action.type='hidden';

			let templateID=document.createElement('input');
			templateID.value='sicko';
			templateID.type='hidden';

			fileUploadForm.append(file);
			fileUploadForm.append(templateID);
			fileUploadForm.append(action);


			templateName.append(templateNameTxt);
			updateBtn.append(updateBtnTxt);
			deleteBtn.append(deleteBtnTxt);
			hideBtn.append(hideBtnTxt);

			saveChangeBtn.append(saveChangeBtnTxt);
			cancelBtn.append(cancelBtnTxt);

			fileUploadForm.append(cancelBtn);
			fileUploadForm.append(saveChangeBtn);
			fileUpload.append(fileUploadForm);

			fileUploadForm.setAttribute('action','/uploadTemplate');
			fileUploadForm.setAttribute('method','post');

			cont.setAttribute('class','templateItemHolder');
			// cont.setAttribute('id','');
			fileUpload.setAttribute('class','templateFileHolder');
			file.setAttribute('type','file');
			// fileUpload.setAttribute('id','');

			updateBtn.setAttribute('class','updateTemplate');
			deleteBtn.setAttribute('class','deleteTemplate');
			hideBtn.setAttribute('class','hideTemplate');
			cancelBtn.setAttribute('class','cancelUpdate');
			saveChangeBtn.setAttribute('class','saveUpdate');
			bigCont.setAttribute('class','templateContainer');

			cont.append(templateName);
			cont.append(updateBtn);
			cont.append(deleteBtn);
			cont.append(hideBtn);
			cont.append(fileUpload)
			bigCont.append(cont);
			console.log(this.templateList);

		}
		this.templateModal.append(bigCont);

	}
	load_html(){}
	load_css(){}
}
export default TemplateUI;