"strict";
import {MyProfile,OtherProfile} from './profile.js';
import {Follow,UnFollow} from './follow.js';

let user=new MyProfile();
console.log('=======working');
window.addEventListener('error',function(error){
    console.log(error);
    console.log(error.error.message);
    const t=new Date();
    const time=t.getTime();
    const date=t.getDate();
    const id=0;
    const browser=navigator.userAgent;
 
    try{
        let xml=new XMLHttpRequest();
        xml.open('POST','/log');
        xml.setRequestHeader('Content-Type','application/json');
        let item={
             message:error.error.message,
            stack:error.error.stack,
            filename:error.filename,
            stack:error.error.srcElement,
            stack:error.timeStamp,
            lineno:error.lineno,
            date:date,
            time:time,
            userID:id,
            device:browser
       
        };
        xml.send(JSON.stringify(item));
        xml.onload=function(){
            console.log('succesfull sent====');
            console.log(this.responseText);
        }
        console.log('sent error log to server');
    }catch(err){
        console.log(err);
    }
    
});
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

function clear_search_bar(){
	document.getElementById('').innerHTML='';
}
function populate_recent_profiles(){
	let list=get_cookie('recentSearches=');
	if(list==undefined){
		return;
	}
	console.log('===== recent profiles');
	let len=list.length;
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id=list[i].userID;
		other.src=list[i].src;
		other.username=list[i].username;
		other.newPosts=list[i].newPosts;
		other.followStatus=list[i].followStatus;
		let cont=other.make_small_container();
		other.removeBtn.addEventListner('click',remove_profile);
		other.followBtn.addEventListner('click',follow_user);
		other.unfollowBtn.addEventListner('click',unfollow_user);
		document.getElementById('recent-posts').append(cont);
	}
}
function populate_popular_profiles(){
	let list=get_cookie('popularProfiles=');
	if(list==undefined){
		return;
	}
	console.log('===== popular profiles');
	let len=list.length;
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id=list[i].userID;
		other.src=list[i].src;
		other.username=list[i].username;
		other.newPosts=list[i].newPosts;
		other.followStatus=list[i].followStatus;
		other.cont.setAttribute('class','follow-item-'+i);
		other.profilePicture.setAttribute('class','user-icon');
		other.followBtn.setAttribute('class','who-follow-btn');
		

		let cont=other.make_small_container();
		other.removeBtn.addEventListner('click',remove_profile);
		other.followBtn.addEventListner('click',follow_user);
		other.unfollowBtn.addEventListner('click',unfollow_user);
		document.getElementById('who-to-follow').append(cont);
	}
}
function addEventListeners(){
	let submit=document.getElementById('searchBtn');
	submit.addEventListner('click',function(evt){
		let input=document.getElementById('search').innerHTML;
		try{
			let xml=new XMLHttpRequest();
			xml.open();
			xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			xml.onload=function(){
				console.log('get search results====');
				console.log(this.responseText);
				let data=JSON.parse(this.responseText);
				console.log(data.results);
			}
			xml.send();

		}catch(err){
			console.log(err);
		}
	});
}
addEventListeners();
populate_recent_profiles();
populate_popular_profiles();
