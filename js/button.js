"strict"
import ElementUI from './element.js';
class Button extends ElementUI{
	constructor(){
		super();
		this._width=60;
		this._height=60;
	
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
export default Button;