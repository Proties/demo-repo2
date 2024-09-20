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
		
		this._height=12;
		this._width=12;
		this._position='relative';
		this._top;
		this._bottom;
		this._zIndex;
		this._opacity;
		this._color;

		this._backgroundColor;
		
		this._display;
	}
	set position(l){
		this._position=l;
	}
	set paddingLeft(l){
		this._padding_left=l;
	}
	set paddingTop(l){
		this._padding_top=l;
	}
	set paddingRight(l){
		this._padding_right=l;
	}
	set paddingBottom(l){
		this._padding_bottom=l;
	}

	set borderBottom(l){
		this._border_bottom=l;
	}
	set borderTop(l){
		this._border_top=l;
	}
	set borderLeft(l){
		this._border_left=l;
	}
	set borderRight(l){
		this._border_right=l;
	}

	set marginBottom(l){
		this._marginBottom=l;
	}
	set marginTop(l){
		this._marginTop=l;
	}
	set marginRight(l){
		this._marginRight=l;
	}
	set marginLeft(l){
		this._marginLeft=l;
	}


	get paddingLeft(){
		return this._padding_left;
	}
	get paddingTop(){
		return this._padding_top;
	}
	get paddingRight(){
		return this._padding_right;
	}
	get paddingBottom(){
		return this._padding_bottom;
	}

	get borderBottom(){
		return this._border_bottom;
	}
	get borderTop(){
		return this._border_top;
	}
	get borderLeft(){
		return this._border_left;
	}
	get borderRight(){
		return this._border_right;
	}

	get marginBottom(){
		return this._marginBottom;
	}
	get marginTop(){
		return this._marginTop;
	}
	get marginRight(){
		return this._marginRight;
	}
	get marginLeft(){
		return this._marginLeft;
	}

	get position(){
		return this._position;
	}




}
class Element extends Styles{
	constructor(){
		super();
		this._id;
		this._x1;
		this._y1;
		this._x2;
		this._y2;
	}
	set id(x){
		this._id=x;
	}
	get id(){
		return this._id;
	}
	set x1(x){
		this._x1=x;
	}
	set y1(x){
		this._y1=x;
	}
	set x2(x){
		this._x2=x;
	}
	set y2(x){
		this._y2=x;
	}
	set width(width){
		this._width=width;
	}
	set height(height){
		this._height=height;
	}

	get x1(){
		return this._x1;
	}
	get y1(){
		return this._y1;
	}
	get x2(){
		return this._x2;
	}
	get y2(){
		return this._y2;
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
		this.make_container();
	}
	set cont(x){
		this._cont=x;
		
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
	make_container(){
		let cont=document.createElement('div');
		cont.setAttribute('class','elementMov');
		this.cont=cont;
	}
	cont_attributes(){
		this.cont.id=this.id;

		this.cont.style.position=this.position;
		this.cont.style.top=this.top;
		this.cont.style.left=this.left;
		this.cont.style.right=this.right;
		this.cont.style.bottom=this.bottom;
		this.cont.style.display=this.display;
		this.cont.style.width=this.width+'px';
		this.cont.style.height=this.height+'px';
		this.cont.style.backgroundColor=this.backgroundColor;
		this.cont.style.color=this.color;

		this.cont.style.marginTop=this.marginTop;
		this.cont.style.marginLeft=this.marginLeft;
		this.cont.style.marginRight=this.marginRight;
		this.cont.style.marginBottom=this.marginBottom;

		this.cont.style.paddingTop=this.paddingTop;
		this.cont.style.paddingLeft=this.paddingLeft;
		this.cont.style.paddingRight=this.paddingRight;
		this.cont.style.paddingBottom=this.paddingBottom;

		this.cont.style.fontSize=this.fontSize;
		this.cont.style.fontFamily=this.fontFamily;
		this.cont.draggable=true;
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
		
		
		this.cont.setAttribute('id',this.id);
		this.cont.append(top);
		this.cont.append(right);
	
		this.cont.append(left);
		
		this.cont.append(bottom);

		this.cont.append(topLeftDia);
		this.cont.append(topRightDia);
		this.cont.append(bottomLeftDia);
		this.cont.append(bottomRightDia);
	}
	get_coords(){
		this.y1=this.cont.offsetTop;
		this.x1=this.cont.offsetLeft;
		this.x2=this.x1+this.height;
		this.y2=this.y1+this.height;
	}
	draw_centreLine(){
		// draw horizontal line across the centre of the div
		// draw a vertical line across the div
	}
}
export default ElementUI;