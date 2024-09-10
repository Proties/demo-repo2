"Strict"
class Element{
	constructor(){
		this._x;
		this._y;
		this._height;
		this._width;


	}
	set x(x){
		this._x=x;
	}
	set y(x){
		this._y=x;
	}
	set width(width){
		this._width=width;
	}
	set height(height){
		this._height=height;
	}

	get x(){
		return this._x;
	}
	get y(){
		return this._y;
	}
	get width(){
		return this._width;
	}
	get height(){
		return this._height;
	}
	
}
class ElementUI extends Element{
	constructor(){
		super();
		this._cont;
		this._subcont;
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

	draw_borders(){
		let top=document.createElement('span');
	
		let right=document.createElement('span');
		let rigthDiag=document.createElement('span');
		let left=document.createElement('span');
		let leftDia=document.createElement('span');
		let bottom=document.createElement('span');

		top.setAttribute('class','topLine');
		right.setAttribute('class','rightLine');

		left.setAttribute('class','leftLine');

		bottom.setAttribute('class','bottomLine');
		this.cont=document.createElement('div');
		this.cont.setAttribute('class','elementMov');
		

		this.cont.append(top);
		this.cont.append(right);
	
		this.cont.append(left);
		
		this.cont.append(bottom);
	}
	
	draw_centreLine(){}
}