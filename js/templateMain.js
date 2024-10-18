"strict";
class TemplateElement{

}
class TemplatePicker{
	constructor(){
		this._id;
		this._fileName;
		this._parentContainer;
		this._cont=document.getElementById('PickTemplateModal');
		this._closeWindow=document.getElementById('closepicktemplate');

	}
	set fileName(i){
		this._fileName=i;
	}
	get fileName(){
		return this._fileName;
	}
	set closeWindow(i){
		this._closeWindow=i;
	}
	get closeWindow(){
		return this._closeWindow;
	}
	set cont(i){
		this._cont=i;
	}
	get cont(){
		return this._cont;
	}
	set parentContainer(i){
		this._parentContainer=i;
	}
	get parentContainer(){
		return this._parentContainer;
	}
	get_templates(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/get_templates');
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.onload=function(){
				console.log('======== sending tmeplates====');
				console.log(this.responseText);
				let bigContainer=document.getElementsByClassName('templatewrapper')[0];
				let data=JSON.parse(this.responseText);
				let len=data.templateList.length;
				for(let t=0;t<len;t++){
					let cont=document.createElement('div');
					let contTwo=document.createElement('div');
					let contThree=document.createElement('div');
					let type=document.createElement('span');
					let typeTxt=document.createTextNode(data.templateList[t].type);
					let price;
					let image=document.createElement('img');
					let name=document.createElement('span');
					let nameTxt=document.createTextNode(data.templateList[t].name);
					let id;
					cont.setAttribute('class','template-container');
					contTwo.setAttribute('class','template-case');
					contThree.setAttribute('class','template');
					img.setAttribute('class','template-img');
					name.setAttribute('class','Template-label');
					img.setAttribute('src',data.templateList[t].image);

					type.append(typeTxt);
					name.append(nameTxt);

					cont.append(type);
					cont.append(image);
					cont.append(name);
					
					contTwo.append(cont);
					contThree.append(contTwo);
					bigContainer.append(contThree);
				}
				
			}
			xml.send();
			parentContainer.append();
		}catch(err){
			console.log(err);
		}
		
	}
	events_handler(){
		this.closeWindow.addEventListener('click',function(evt){
			let ele=evt.target.parentNode.parentNode.parentNode;
			ele.style.display='none';
		});
		let items=document.getElementsByClassName('template-img');
		let len=items.length;
		for(let i=0;i<len;i++){
			items[i].addEventListener('click',(evt)=>{
				let element=evt.target;
				console.log('picking template=====');
				console.log(element.parentNode);
				console.log(element);
				this.fileName=element.src;
				this.pick_template();
			});
		}
	}
	pick_template(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/');
			// xml.setRequestHeader('Content-Type','appliaction/x-www-form-urlencoded');
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.onload=function(){
				console.log('======== sending tmeplates====');
				console.log(this.responseText);
			}
			xml.send('action=pick_template&templateFileName='+this.fileName);
		}catch(err){
			console.log(err);
		}
	}
}
export default TemplatePicker;