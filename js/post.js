"strict"
import {Video} from './video.js';
import {Image} from './image.js';
export class Post{
	constructor(){
		this._id;
		this._dateMade;
		this._timeMade;
		this._status;
		this._user;
		this._image=new Image();
		this._video=new Video();
		this._title;
		this._className='';
		this._collaborators=[];
		this._;
	}
	set className(i){
		this._className=1;
	}
	get className(){
		return this._className;
	}
	set id(i){
		this._id=1;
	}
	get id(){
		return this._id;
	}
	set dateMade(i){
		this._dateMade=1;
	}
	get dateMade(){
		return this._dateMade;
	}
	set timeMade(i){
		this._timeMade=1;
	}
	get timeMade(){
		return this._timeMade;
	}
	set status(i){
		this._status=1;
	}
	get status(){
		return this._status;
	}
	set user(i){
		this._user=_user;
	}
	get user(){
		return this._user;
	}
	set image(i){
		this._image=i;
	}
	get image(){
		return this._image;
	}
	set user(i){
		this._user=_user;
	}
	get user(){
		return this._user;
	}
}

export class PostUI extends Post{
	constructor(){
		super();
		this._postItem;
		this._parentContainer;
		this._cont;
		this._yTop=this.cont.offsetTop;
		this._yBottom=this.cont.offsetBottom;
	}
	set yTop(i){
		this._yTop=i;
	}
	get yTop(){
		return this._yTop;
	}
	set yBottom(i){
		this._yBottom=i;
	}
	get yBottom(){
		return this._yBottom;
	}
	set cont(i){
		this._cont=i;
	}
	get cont(){
		return this._cont;
	}
	set parentContainer(i){
		this._parentContainer=i;
	}
	get parentContainer(){
		return this._parentContainer;
	}
	
	populate_post(){

		let cont=document.getElementsByClassName('posts-container')[0];
        let image=cont.getElementsByTagName('img')[0];
        image.setAttribute('src',this.src);
        cont.setAttribute('id',this.id);
        this.cont=cont;
	}

	make_post(){
		let con=document.createElement('div');
        let img=document.createElement('img');
       
        con.setAttribute('class','post');
        con.setAttribute('id',this.id);
        img.setAttribute('src',this.src);
        con.append(img);
        this.parentContainer.append(con);
	}
	make_video_post(){
		let con=document.createElement('div');
        let video=document.createElement('video');
       
        con.setAttribute('class','post');
        con.setAttribute('id',this.id);
        img.setAttribute('src',this.src);
        con.append(video);
        this.parentContainer.append(con);
	}
	

}
export class PreviewPost extends PostUI{
	constructor(){
		super();
	}
}