"strict"
class Post{
	constructor(){
		this._id;
		this._dateMade;
		this._timeMade;
		this._status;
		this._user;
		this._image;
		this._title;
		this._collaborators=[];
		this._;
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

class PostConnection(){
	constructor(){}
	update_post(){}
	delete_post(){}
	get_post_data(){}
	send_post_data(){}
}
class PostUI extends Post{
	constructor(){
		super();
		this._postItem;
	}

	make_post(){}

}
