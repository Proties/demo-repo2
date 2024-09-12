"Strict"
class Styles{
	constructor(){
		this._border_bottom;
		this._border_right;
		this._border_left;
		this._border_top;
		this._border_radius;

		this._padding_top;
		this._padding_right;
		this._padding_left;
		this._padding_bottom;

		this._marginLeft;
		this._marginTop;
		this._marginRight;
		this._marginBottom;

		this._font_size;
		this._font_family;
		this._text_decoration;
		
		this._height;
		this._width;
		this._postion;
		this._top;
		this._bottom;
		this._zIndex;
		this._opacity;
		this._color;

		this._backgroundColor;
		
		this._display;
	}
}
class Element{
	constructor(){
		this._id;
		this._x;
		this._y;
		
		this._top;
		this._bottom;
		this._left;
		this._right;
	}
	set id(x){
		this._id=x;
	}
	get id(){
		return this._id;
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
		this._moveable;
		this._resizable;
		this._deleteable;
		this._modifiyable;
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
		let topRightDia=document.createElement('span');
		let left=document.createElement('span');
		let leftDia=document.createElement('span');
		let topLeftDia=document.createElement('span');
		let bottom=document.createElement('span');
		let bottomRightDia=document.createElement('span');
		let bottomLeftDia=document.createElement('span');

		top.setAttribute('class','topLine');
		right.setAttribute('class','rightLine');
		left.setAttribute('class','leftLine');
		bottom.setAttribute('class','bottomLine');

		topRightDia.setAttribute('class','topRightDiag');
		topLeftDia.setAttribute('class','topLeftDiag');
		bottomRightDia.setAttribute('class','bottomRightDiag');
		bottomLeftDia.setAttribute('class','bottomLeftDiag');


		top.setAttribute('draggable','true');
		bottom.setAttribute('draggable','true');
		right.setAttribute('draggable','true');
		left.setAttribute('draggable','true');

		topRightDia.setAttribute('draggable','true');
		topLeftDia.setAttribute('draggable','true');
		bottomRightDia.setAttribute('draggable','true');
		bottomLeftDia.setAttribute('draggable','true');
		this.cont=document.createElement('div');
		this.cont.setAttribute('class','elementMov');
		

		this.cont.append(top);
		this.cont.append(right);
	
		this.cont.append(left);
		
		this.cont.append(bottom);

		this.cont.append(topLeftDia);
		this.cont.append(topRightDia);
		this.cont.append(bottomLeftDia);
		this.cont.append(bottomRightDia);
	}
	
	draw_centreLine(){}
}