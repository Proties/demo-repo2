"strict"
export class Follow{
	constructor(user,influencer){
		this._user=user;
		this._influencer=influencer;
	}
	set user(s){
		this._user=s;
	}
	get user(){
		return this._user;
	}
	set influencer(s){
		this._influencer=s;
	}
	get influencer(){
		return this._influencer;
	}
	sendFollowTOServer(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/profile');
			xml.setRequestHeader('Content-type','x/application-form-urlencoded');
			xml.send('action=follow&influencerID='+influencer.id);
		}catch(err){
			console.log(err)
		}
	}
}
export class UnFollow{
	constructor(user,influencer){
		this._user=user;
		this._influencer=influencer;
	}
	set user(s){
		this._user=s;
	}
	get user(){
		return this._user;
	}
	set influencer(s){
		this._influencer=s;
	}
	get influencer(){
		return this._influencer;
	}
	sendUnFollowTOServer(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/profile');
			xml.setRequestHeader('Content-type','x/application-form-urlencoded');
			xml.send('action=unfollow&influencerID='+influencer.id);
		}catch(err){
			console.log(err)
		}
	}
}
class FollowingList{
	constructor(){
		this._list=[];
	}
	set list(s){
		this._list=s;
	}
	get list(){
		return this._list;
	}
	get_following_list(){}
}
class FollowerList{
	constructor(){
		this._list=[];
	}
	set list(s){
		this._list=s;
	}
	get list(){
		return this._list;
	}
	get_follower_list(){}
}