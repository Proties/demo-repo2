"strict"
export class Follow{
	constructor(){
		this._user;
		this._influencer;
		this._btn;
	}
	set btn(s){
		this._btn=s;
	}
	get btn(){
		return this._btn;
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
	sendFollowHomePage(evt){
		console.log('following');
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/');
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.onload=function(evt){
				let followBtn=evt.target.parentNode;
				let post=followBtn.parentNode.parentNode;
				console.log('post======');
				console.log(post);
				let data=JSON.parse(this.responseText);
				
				if(data.status=='failed'){
					alert('create an account first');
					return;
				}

				//replace follow btn with unfollow btn
				
				let unfollowBtn=document.createElement('button');
				let unfollowBtnTxt=document.createTextNode('unFollow');
				unfollowBtn.setAttribute('class','follow-button');
				unfollowBtn.append(unfollowBtnTxt);

				cont.replaceChild(unfollowItem,btn);
			}
			xml.send('actions=follow_user&followerID='+this.influencer);
		}catch(err){
			console.log(err);
		}
	}
	sendFollow(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/profile');
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.onload=function(){
				console.log('======data from server');
				console.log(this.responseText);
				let data=JSON.parse(this.responseText);
				
				if(data.status=='failed'){
					alert('create an account first');
					return;
				}

				//replace follow btn with unfollow btn
				let cont=document.getElementsByClassName('Follower')[0];
				console.log(cont.childNodes);
				let btn=cont.childNodes[5];
				let unfollowItem=document.createElement('li');
				let unfollowBtn=document.createElement('button');
				let unfollowBtnTxt=document.createTextNode('unFollow');
				unfollowBtn.setAttribute('class','follow-button');
				unfollowBtn.setAttribute('id','unFollowBtn');
				unfollowBtn.append(unfollowBtnTxt);
				unfollowItem.append(unfollowBtn);
				cont.replaceChild(unfollowItem,btn);
				let unFollowUser=document.getElementById('unFollowBtn');
				unFollowUser.addEventListener('click',unfollowProfile);
			}
			xml.send('actions=follow_user&followerID='+this.influencer.id+'&userID='+this.user.id);
		}catch(err){
			console.log(this.influencer);
			console.log(this.user.id);
			console.log(this.influencer.id);
			console.log(err);
		}
	}
}
export class UnFollow{
	constructor(){
		this._user;
		this._influencer;
		this._btn;
	}
	set btn(s){
		this._btn=s;
	}
	get btn(){
		return this._btn;
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
	sendUnFollowHomePage(evt){
		console.log('unfollowing');
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/');
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.onload=function(){
				let followBtn=evt.target.parentNode;
				let post=followBtn.parentNode.parentNode;
				console.log('post======');
				console.log(post);
				let d=JSON.parse(this.responseText);
				if(d.status=='failed'){
					alert('could not un follow');
					return;
				}
				if(d.status=='success'){		
				    let followBtn=document.createElement('button');
				    let followBtnTxt=document.createTextNode('follow');
				    followBtn.setAttribute('class','follow-button');
				    followBtn.append(followBtnTxt);
				    cont.replaceChild(followItem,btn);

			}
		}
			xml.send('actions=unfollow_user&followerID='+this.influencer);
		}catch(err){
			console.log(err);
		}
	}
	sendUnFollowTOServer(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/profile');
			xml.setRequestHeader('Content-type','x/application-form-urlencoded');
			xml.onload=function(){
				let d=JSON.parse(this.responseText);
				if(d.status=='failed'){
					alert('could not un follow');
					return;
				}
				if(d.status=='success'){
					 let cont=document.getElementsByClassName('Follower')[0];
				    console.log(cont.childNodes);
				    let btn=cont.childNodes[5];
				    let followItem=document.createElement('li');
				    let followBtn=document.createElement('button');
				    let followBtnTxt=document.createTextNode('follow');
				    followBtn.setAttribute('class','follow-button');
				    followBtn.setAttribute('id','followBtn');
				    followBtn.append(followBtnTxt);
				    followItem.append(followBtn);
				    cont.replaceChild(followItem,btn);
				    let FollowUser=document.getElementById('followBtn');
				    FollowUser.addEventListener('click',followProfile);
				}
			}
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