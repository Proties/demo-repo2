"strict";
import {MyProfile,OtherProfile} from './profile.js';
import {Follow,UnFollow} from './follow.js';

let user=new MyProfile();

function delete_cookie(name){
    document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
function get_cookie(name){
    let data=document.cookie;

    let dec=decodeURIComponent(data);
    let sp=dec.split(';');
    for(let x=0;x<sp.length;x++){
        let c=sp[x];
        while(c.charAt(0)==' '){
            console.log(c);
            c=c.substring(1);
            if(c.indexOf(name)==0){
            let parsed=c.substring(name.length,c.length);
            let dtt=JSON.parse(parsed);

            return dtt;
        }
    }
}
}
function get_user_info(){
	let data=get_cookie('myprofile');
	if(data==undefined){
		return;
	}
	user.id=data.id;
	user.username=data.username;
	user.profilePicture=data.profilePicture;
	user.email=data.email;

	
}
function is_subcriprion_on(){

}
function clear_search_bar(){
	document.getElementById('').innerHTML='';
}
function populate_recent_profiles(){
	let list=get_cookie('recentSearches=');
	if(list==undefined){
		return;
	}
	let len=list.length;
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id;
		other.src;
		other.username;
		other.newPosts;
		other.followStatus;
		let cont=other.make_small_container();
		other.removeBtn.addEventListner('click',remove_profile);
		other.followBtn.addEventListner('click',follow_user);
		other.unfollowBtn.addEventListner('click',unfollow_user);
		document.getElementById('').append(cont);
	}
}
function populate_popular_profiles(){
	let list=get_cookie('popularProfiles=');
	if(list==undefined){
		return;
	}
	let len=list.length;
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id;
		other.src;
		other.username;
		other.newPosts;
		other.followStatus;
		let cont=other.make_small_container();
		other.removeBtn.addEventListner('click',remove_profile);
		other.followBtn.addEventListner('click',follow_user);
		other.unfollowBtn.addEventListner('click',unfollow_user);
		document.getElementById('').append(cont);
	}
}

function close_search_modal(){

}
function follow_user(evt){

}
function unfollow_user(evt){

}
function remove_profile(evt){

}

function addEventListners(){
	let leftScroll;
	let rightScroll;
	let submitSearch;

}
addEventListners();