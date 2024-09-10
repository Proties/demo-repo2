"strict"

class Text extends Element{
	constructor(ele){
		super();
		this._cont;
		this._subcont=ele;
		this._item;
		this.make_item();
	}
	set cont(c){
		this._cont=c;
	}
	get cont(){
		return this._cont;
	}
	set subcont(c){
		this._subcont=c;
	}
	get subcont(){
		return this._subcont;
	}
	set item(i){
		this._item=i;
	}
	get item(){
		return this._item;
	}
	make_item(){
		let cont=document.createElement('div');
		let top=document.createElement('span');
	
		let right=document.createElement('span');
		let rigthDiag=document.createElement('span');
		let left=document.createElement('span');
		let leftDia=document.createElement('span');
		let bottom=document.createElement('span');

		top.setAttribute('class','topLine');
		right.setAttribute('class','rightLine');
		rigthDiag.setAttribute('class','');
		left.setAttribute('class','leftLine');
		leftDia.setAttribute('class','');
		bottom.setAttribute('class','bottomLine');
		cont.setAttribute('class','elementMov');
		this.subcont.setAttribute('class','elementText');
		this.cont=cont;
		this.cont.append(top);
		this.cont.append(right);
		this.cont.append(rigthDiag);
		this.cont.append(this.subcont);
		this.cont.append(left);
		this.cont.append(leftDia);
		this.cont.append(bottom);
	}

}

class Heading extends Text{}
class SubHeading extends Text{}
class Paragragh extends Text{}
class Line extends Text{}