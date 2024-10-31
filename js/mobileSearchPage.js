"strict";
import {MyProfile,OtherProfile} from './profile.js';
import {Follow,UnFollow} from './follow.js';

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
function is_subcriprion_on(){}
function clear_search_bar(){}
function populate_recent_profiles(){
	let list=get_cookie('recentSearches=');
	if(list==undefined){
		return;
	}
	let len=list.length;
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id=;
		other.username=;
		other.newPosts=;
		other.profilePicture=;
		let cont=document.createElement('div');
		let username=document.createElement('h3');
		let posts=document.createElement('p');
		let profilePictureLink=document.createElement('a');
		let profilePicture=document.createElement('img');

		other.username;
		other.make_profilePicture()
		cont.append();
		cont.append();
		document.getElementById('').append(cont);
	}
}
function populate_popular_profiles(){}

function close_search_modal(){

}
function remove_profile(){}
function addEventListners(){
	let follow;
	let unfollow;
	let leftScroll;
	let rightScroll;
	let submitSearch;
	let removeRecentProfile;
	let removePopularProfile;
}
addEventListners();