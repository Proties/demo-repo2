"strict"
class Board{
	construct(){
		this._newElement;
		this._oldElement;
		this._elements=[];
	}
	add_element(ele){
		this._elements.push(ele);
	}
}
// board rules

// if an element is above a container make display flex
// 	when moving button around a container change
// 	when moving txt around a container change
// 	when moving image around a container change

// if an element is above container adjust zindex
// if element is above image allow 
// if an element is above a button move button up/down
// if an element is above text change the zindex of the underlying element