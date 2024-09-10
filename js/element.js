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
class ElementUI{
	draw_borders(){}
	draw_centreLine(){}
}