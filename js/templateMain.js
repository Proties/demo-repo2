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
	clear_templates(){
		let templates=document.getElementsByClassName('template-container');
		let i=0;
		let max=templates.length;
		while(max>i){
			if(templates[i]!==undefined){
				templates[i].remove();
				i++;
			}
		}
		console.log('done====');
	}
	get_templates(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/');
			
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.onload=function(){
				// this.clear_templates();
				console.log('======== get tmeplates====');
				console.log(this.responseText);
				let bigContainer=document.getElementsByClassName('templatewrapper')[0];
				let data=JSON.parse(this.responseText);
				if(data.status=='failed'){
					alert(data.message);
					return;
				}
				let len=data.templateList.length;
				for(let t=0;t<len;t++){
					let cont=document.createElement('div');
					let contOne=document.createElement('div');
					let contTwo=document.createElement('div');
					let tempForm=document.createElement('form');
					let price=document.createElement('span');
					let submitBtn=document.createElement('button');
					
				
					let type=document.createElement('span');
					let typeTxt=document.createTextNode(data.templateList[t].type);
					if(data.templateList[t].type=='Premium'){
						tempForm.setAttribute('action','/subscribe_to_premiunm');
						tempForm.setAttribute('method','post');
						let input=document.createElement('input');
						let inputTwo=document.createElement('input');
						
						input.setAttribute('value',this.templateList[t].templateID);
						input.setAttribute('name','templateID');
						input.setAttribute('type','hidden');

						inputTwo.setAttribute('value',this.templateList[t].templateName);
						inputTwo.setAttribute('name','templateName');
						inputTwo.setAttribute('type','hidden');

						

						tempForm.append(input);
						tempForm.append(inputTwo);
						let submitBtnTxt=document.createTextNode('select Template');
						let priceTxt=document.createTextNode('Premium');
						submitBtn.append(submitBtnTxt);
						price.append(priceTxt);
					}
					if(data.templateList[t].type=='Free'){
						let submitBtnTxt=document.createTextNode('select Template');
						let priceTxt=document.createTextNode('Free');
					
						submitBtn.append(submitBtnTxt);
						price.append(priceTxt);
					}
					if(data.templateList[t].type=='Paid'){
						tempForm.setAttribute('action','/buy_template');
						tempForm.setAttribute('method','post');
						let input=document.createElement('input');
						let inputTwo=document.createElement('input');
						
						input.setAttribute('value',this.templateList[t].templateID);
						input.setAttribute('name','templateID');
						input.setAttribute('type','hidden');

						inputTwo.setAttribute('value',this.templateList[t].templateName);
						inputTwo.setAttribute('name','templateName');
						inputTwo.setAttribute('type','hidden');

						tempForm.append(input);
						tempForm.append(inputTwo);
						let submitBtnTxt=document.createTextNode('Buy Template');
						submitBtn.append(submitBtnTxt);
						let priceTxt=document.createTextNode('R'+data.templateList[t].price);
						price.append(priceTxt);
					}
					
					let image=document.createElement('img');
					let name=document.createElement('span');
					let nameTxt=document.createTextNode(data.templateList[t].name);
					let id;
					
					cont.setAttribute('class','template-container');
					contOne.setAttribute('class','template');
					cont.setAttribute('id','template'+data.templateList[t].id);
					contTwo.setAttribute('class','template-case');
					
					price.setAttribute('class','badge');
					image.setAttribute('class','template-img');
					name.setAttribute('class','Template-label');
					image.setAttribute('src',data.templateList[t].image);

					
					
					name.append(nameTxt);

				
					contOne.append(price);
					contOne.append(image);
					
					
					contTwo.append(contOne);
					contTwo.append(name);
					cont.append(contTwo);
					
					tempForm.append(contOne);
					tempForm.append(submitBtn);
					cont.append(tempForm);

					bigContainer.append(cont);
					
					
				}
				
			}
			xml.send('action=get_templates');
			
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