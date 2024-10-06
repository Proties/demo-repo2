"strict"
import {PostUI} from './post.js';
class StackedPosts extends PostUI{
	constructor(){
		super();
		this._stack=2;
		this._zIndex=0;
		this._images=[];

	}
	get images(){
		return this._images;
	}
	add_image(src){
		this.images.push(src);
	}
	set stack(s){
		this._stack=s;
	}
	get stack(){
		return this._stack;
	}
	set zIndex(s){
		this._zIndex=s;
	}
	get zIndex(){
		return this._zIndex;
	}
	make_stack(){
		for(let x=0;x<this.stack;x++){
			let contOne=document.createElement('div');
			let imgOne=document.createElement('img');

			contOne.append(imgOne);
			contOne.setAttribute('id','');
			contOne.setAttribute('class','');
			imgOne.setAttribute('src',this.images[x]);
			contOne.style.zIndex=this.zIndex;
			this.zIndex++;
			this.cont.append(contOne);
		}
		this.parentContainer.append(this.cont);
	}
}
export default StackedPosts;