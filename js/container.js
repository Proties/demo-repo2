"strict"
class Container extends ElementUI{
	constructor(){
		super();
		this._width=189;
		this._height=200;
		this._display='block'
	}
	make_item(){
		this.cont.classList.add('containerElementItem');
	}
}