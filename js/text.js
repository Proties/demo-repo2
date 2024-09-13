"strict"

class Text extends ElementUI{
	constructor(ele){
		super();
		this._subcont=ele;
	}
	make_item(){
		let text=document.createElement('p');
		let textTxt=document.createTextNode('text');
		text.append(textTxt);
		this.cont.append(text);
	}

}

class Heading extends Text{}
class SubHeading extends Text{}
class Paragragh extends Text{}
class Line extends Text{}