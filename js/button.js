"strict"
class Button extends ElementUI{
	constructor(){
		super();
	
	}
	make_item(){
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('button');
		btn.append(btnTxt);
		this.cont.append(btn);
		
	}
}