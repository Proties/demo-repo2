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
		list.add('buttonElementItem');
		this.cont.append(btn);

		
	}
}