"strict"
class Button extends ElementUI{
	constructor(){
		super();
	
	}
	make_item(){
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('button');
		btn.append(btnTxt);
		let list=this.cont.classList;
		list.add('buttonEle');
		this.cont.append(btn);
		
	}
}