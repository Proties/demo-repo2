"strict";
import {MyProfile,OtherProfile} from './profile.js';
import {Follow,UnFollow} from './follow.js';
import {ProfileGallery} from './imageGallery.js';

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
	let list=get_cookie('recentSearchResults=');
	if(list==undefined){
		console.log('===== no recent profiles');
		return;
	}
	
	
	let len=list.length;
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id=list[i].userID;
		other.src=list[i].profilePicture;
		other.username=list[i].username;
		other.newPosts=list[i].newPosts;
		other.className='profile-item';
		other.followStatus=list[i].followStatus;
		let cont=other.make_small_container();
		other.removeBtn.addEventListener('click',other.remove_profile);
		if(list[i].followStatus==false){
			other.followBtn.addEventListener('click',other.follow_user);
		}
		
		
		document.getElementById('recent-posts').append(cont);
	}
}
function populate_popular_profiles(){
	let list=get_cookie('popularProfiles=');
	if(list==undefined){
		console.log('====popular posts list empty');
		return;
	}
	let contprofiles=[];
	console.log('===== popular profiles');
	let len=list.length;
	let c=1;
	let mgllery=new ProfileGallery();
	
	for(let i=0;i<len;i++){
		let other=new OtherProfile();
		other.id=list[i].userID;
		other.src=list[i].profilePicture;
		other.username=list[i].username;
		other.newPosts=list[i].newPosts;
		other.className='follow-item-'+i;
		other.followStatus=list[i].followStatus;
		let cont=other.make_small_container();
		
		other.cont.setAttribute('class','follow-item-'+c);
		c++;
		other.profilePicture.setAttribute('class','user-icon');
		other.removeBtn.addEventListener('click',other.remove_popular_profile);
		other.followBtn.setAttribute('class','who-follow-btn');
		other.followBtn.addEventListener('click',other.follow_user);
		
		contprofiles.push(cont);
		document.getElementById('who-to-follow').append(cont);
	}
	mgllery.bigCont=document.getElementById('who-to-follow');
	mgllery.imageList=contprofiles;
	mgllery.eventHandling();
}
function addEventListeners(){
	let submit=document.getElementById('searchBtn');
	const input=document.getElementById('search');
	const donation=document.getElementById('displaModal');
	

	donation.addEventListener('click',function(evt){
		let modal=document.getElementById('donation-modal');
		modal.style.display='block';
		const closeModal=modal.getElementsByClassName('close-icon')[0];
		closeModal.addEventListener('click',function(evt){
		document.getElementById('donation-modal').style.display='none';
	});
	});
	
	input.addEventListener('input',search_user);

	submit.addEventListener('click',function(evt){
		let text=input.innerHTML;
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
			xml.send('actions='+text);

		}catch(err){
			console.log(err);
		}
	});
}

function visit_profile(){

}
function clear_results(){
	let list=document.getElementById('suggestion-list')
	let l=list.getElementsByTagName('li');
	for(let i=0;i<l.length;i++){
		l[i].remove();
	}
}
// this function get called when user entres text on the search box it then takes the text to the serve
// and preforms a search of matchin words on the database of usernames
function search_user(){
    let text=document.getElementById("search").value;
    let list=document.getElementById('suggestion-list');
    
    console.log(text);
    
    try{
        let xml=new XMLHttpRequest();
        xml.open('POST','/search_page');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.onload=function(){
        	console.log('==== search works====');
        	list.style.display='block';
       		
        	let searchData=JSON.parse(this.responseText);
        	console.log('=====return data=====');
        	console.log(searchData['searchResults']);
        	let len=searchData['searchResults'].length;
        	const results=searchData['searchResults'];
        	clear_results();
        	for(let i=0;i<len;i++){
	            const l=document.createElement('li');
	            const cont=document.createElement('div');

	            const profilePic=document.createElement('img');
	            const username=document.createElement('p');
	            const usernameTxt=document.createTextNode(results[i].username);
	         
	            cont.setAttribute('class','searchItem');
	            cont.setAttribute('id','userID'+results[i].userID);
	            profilePic.setAttribute('class','');
	            profilePic.setAttribute('src',results[i].profilePicture);
	            username.setAttribute('class','username');

	            username.append(usernameTxt);
	          	cont.append(profilePic);
	            cont.append(username);
	            l.append(cont);
	            list.append(l);
	        }
	        let listItem=document.getElementsByClassName('searchItem');
        for(let i=0;i<listItem.length;i++){
            listItem[i].addEventListener("click",function(evt){
            	evt.stopPropagation();
            	const element=evt.target;
            	console.log(element);
            	let selectedUsername=element.innerHTML;
            	try{
            		let xml=new XMLHttpRequest();
            		xml.open('POST','/search_page');
            		xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            		
            		xml.onload=function(){
            			console.log("works=======");
		                console.log(evt.target.innerHTML);
		                window.location.href="/@"+evt.target.innerHTML;

            		}
            		xml.send('actions=visit_profile&username='+selectedUsername);

            	}catch(err){
            		console.log(err);
            	}
                
            });

        }
        }
        xml.send("actions=search&q="+text);


        
        
        
        
    }catch(err){
        console.log(err);
    }
    document.addEventListener('click',function(evt){
        if(evt.target.className!=='searchItem'){
            list.style.display='none';
        }
        
    });
    // document.getElementById("search").addEventListener("focusout",()=>{
    //     list.style.display='none';
        
    // });
}
addEventListeners();
populate_recent_profiles();
populate_popular_profiles();
