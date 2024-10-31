"strict"
class Gallery{
	constructor(){
		this._imageList=[];
		this._imageSize=0;
		this._currentImage;
		this._bigCont;

	}
	set bigCont(s){
		this._bigCont=s;
	}
	get bigCont(){
		return this._bigCont;
	}
	set currentImage(s){
		this._currentImage=s;
	}
	get currentImage(){
		return this._currentImage;
	}
	get imageList(){
		return this._imageList;
	}
	get imageSize(){
		return this._imageSize;
	}

	add_image(data){
		this.imageList.push(
			{
				id:data.id,
				src:data.src,
				caption:data.caption


			});

	}
	remove_image(){

	}
}
export class MobileGallery extends Gallery{
	constructor(){
		super();
		
	}
	swipe_left(){}
	swipe_right(){}
	swipe_down(){}
	swipe_up(){}

	eventHandling(){

	}

}
export class DesktopGallery extends Gallery{
	constructor(){
		super();
		this._rigthBtn;
		this._leftBtn;
		
	}
	set rigthBtn(s){
		this._rigthBtn=s;
	}
	set leftBtn(s){
		this._leftBtn=s;
	}

	get rigthBtn(){
		return this._rigthBtn;
	}
	get leftBtn(){
		return this._leftBtn;
	}
	create_rightBtn(){
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('->');
		btn.append(btnTxt);
		this.rightBtn=btn;
	}
	create_leftBtn(){
		let left=document.createElement('button');
		let leftTxt=document.createTextNode('<-');
		left.append(leftTxt);
		this.leftBtn=left;
	}
	create_gallery(){
		this.create_rightBtn();
		this.create_leftBtn();
		this.bigCont.append(this.rightBtn);
		this.bigCont.append(this.leftBtn);
		let container;
		for(let i=0;i<this.imageSize;i++){
			
		}
		this.bigCont.append(container);
	}
	eventHandling(){
		
	}

}