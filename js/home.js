"strict"
import {MyProfile,OtherProfile} from './profile.js';
import {PostUI} from './post.js';
import StackedPosts from './stackPosts.js';
import RegistrationUI from './registration.js';

import {Follow,UnFollow} from './follow.js';

import VideoUI from './video.js';


let user=new MyProfile();
let allData;
let profileList=[];
let registrationForm=new RegistrationUI();

// let video=new VideoUI();
// video.make_form_submission();
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
function get_ish_form_cookie(){
    let profilesObjs=get_cookie("users=");
    let user_data=get_cookie("myprofile=");
    if(profilesObjs==undefined){
        console.log('no posts ');
    }else{
        initialiseObjects(profilesObjs,user_data);
    }
        
    }
    // init_categories(dtt.categories);

function get_registration_info_from_cookie(){
    let registration=get_cookie('registration=');
    if(registration!==undefined && registration!==false){
        return registration;
  
    }
    return false;
}
function get_profile_setup_info_from_cookie(){
    let profileSetUp=get_cookie('setUpProfile=');
    if(profileSetUp!==undefined && profileSetUp!==false){
        return profileSetUp;
    }
    return profileSetUp;
}
function get_username_search_results_info_from_cookie(){
    let usernames=get_cookie('usernameSearchResults=');
    console.log(usernames);
    if(usernames!==undefined && usernames!==false){
        console.log('----usernames results-------');
        console.log(usernames);
        return usernames;
    }
    return false;
}
function clear_posts(){

}
// let testData=[
// {username:'rotondwa',fullname:'',firstName:'',lastname:'nems',following:true,profilePicture:'/Image/Test Account.png',id:12,post:{id:2,src:'/Image/Comic.png.png'}},
// {username:'rinae',fullname:'',firstName:'',lastname:'nems',following:false,profilePicture:'/Image/Test Account.png',id:25,posts:[{id:3,src:'/Image/Comic.png.png'},{id:4,src:'/Image/Comic.png.png'}]},
// {username:'sindy',fullname:'',firstName:'',lastname:'nems',following:true,profilePicture:'/Image/Test Account.png',id:43,posts:[{id:5,src:'/Image/Comic.png.png'},{id:6,src:'/Image/Comic.png.png'},{id:7,src:'/Image/Comic.png.png'}]}
// ];
// let meData={fullname:'rotondwa',username:'sackie',bio:''};
let meData=null;
// initialiseObjects(testData,meData);

function initialiseObjects(cookie_data,cookie_user){
    console.log('=========cookie data========');
    console.log(cookie_data);
    console.log(cookie_user);
    if(cookie_user!==undefined){
        user.username=cookie_user.username;
        user.fullName=cookie_user.fullname;
        user.bio=cookie_user.bio;
        user.registrationBtn.style.display='none';
    }
   if(cookie_data!==undefined){
        // clear_posts();
        let parentCont=document.getElementsByClassName("postfeed-wrapper")[0];
        for(let i=0;i<cookie_data.length;i++){
            console.log('=======array loop enternder');
            let profileItem=new OtherProfile();
            profileItem.id=cookie_data[i].id;
            profileItem.username=cookie_data.username;
            profileItem.firstName=cookie_data[i].firstName;
            profileItem.lastName=cookie_data[i].lastName;
            profileItem.fullname=cookie_data[i].fullname;
            profileItem.profilePicture=cookie_data[i].profilePicture;
            profileItem.data=cookie_data[i];
            profileItem.parentContainer=parentCont;
           // profileItem.make_container();
            // profileItem.make_posts();
            // profileItem.make_profilePic();
            profileItem.make_container();
            
            console.log('++++++= following +++++++');
            console.log(cookie_data[i].following);
            profileItem.unfollow.influencer=profileItem.id;
            if(cookie_data[i].following==true){
                profileItem.unfollow.btn=profileItem.unfollowBtn;
                console.log(profileItem.unfollowBtn);
                console.log(profileItem.unfollow.btn);
                profileItem.unfollow.btn.addEventListener('click',function(evt){
                    console.log('unfollow');
                    profileItem.unfollow.sendUnFollowHomePage(evt);

                });
            }else{
                profileItem.follow.influencer=profileItem.id;
                profileItem.follow.btn=profileItem.followBtn;
                profileItem.follow.btn.addEventListener('click',function(evt){
                    profileItem.follow.sendFollowHomePage(evt);
                });
            }
         
            
            
            // parentCont.append(profileItem.cont);
            profileList.push(profileItem);

    }
    console.log(profileList);
   }

    
}




// console.log(JSON.parse(dtt));
// this function get post data like images,athtorname form the server
function initialise_image(){
    try{
        let xml = new XMLHttpRequest();
    xml.open('POST', '/');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.onreadystatechange = function() {
        if(this.readyState==4){
        // console.log(this.responseText);
        let data=JSON.parse(this.responseText);
        // document.getElementsByClassName('profile-link').href="@"+data.user.user_info.username;
        console.log(data);
        init_user(data.user);
        init_categories(data.categories);
        init_img(data.users);
        }
}
xml.send('action=initialise_image');
    }catch(err){
        console.log(err);
    }
}

function track(){
    for(let p=0;p<postsArray.length;p++){
        postsArray[p].counter();
    }
}
// this function checks the url to see if a post has been selected if so it will get data from the serve
function open_postPreview(){
    let url=window.location.href;
    const pattern=/^(\/\@[a-zA-Z]+)(\/[a-zA-Z0-9]+)$/;
    console.log(url);
    console.log('prviewing post working');
    
    if(!pattern.test(url)){
        console.log('not valid post');
        history.replaceState(null,null,'/');
        return;
    }
    console.log('valid post');
    try{
        let xm=new XMLHttpRequest();
        xm.open('GET',url);
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onreadystatechange=function(){
            let data=JSON.parse(this.responseText);
            openModal(data);
            console.log(data);
            console.log('hahaha');
        }
        xm.send('action=initialise_post_preview');
    }catch(err){
        console.log(err);
    }

return false;

}
function clear_search_results(){
    let list=document.getElementById('suggestion-list');
    for(let l=0;l<list.childNodes.length;l++){
        list.childNodes[l].remove();
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
        xml.open('POST','/');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("action=search&q="+text);
        let searchData=get_username_search_results_info_from_cookie();
        if(searchData.status=='success'){
        list.style.display='block';
        list.innerHTML='';
        console.log('works');
        clear_search_results();
        let len=searchData.Results.length;
        for(let i=0;i<len;i++){
            const l=document.createElement('li');
            l.setAttribute('class','searchItem');
            l.textContent=searchData.Results[i].username;
            list.appendChild(l);
            console.log(searchData.Results[i]);
            
        }
        let listItem=document.getElementsByClassName('searchItem');
        for(let i=0;i<listItem.length;i++){
            listItem[i].addEventListener("click",function(evt){
                console.log("works=======");
                console.log(evt.target.innerHTML);
                window.location.href="/@"+evt.target.innerHTML;
            });
        }
        }
        
        
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
function clear_error_messages(){
    document.getElementById("errPassword").innerHTML='';
    document.getElementById("errName").innerHTML='';
    document.getElementById("errLastName").innerHTML='';
    document.getElementById("errEmail").innerHTML='';
}
// this function direct the user to a users profile when a user account is selected
function openUserProfile(evt){
    let username=evt.target.parentNode;
    console.log(username);
    console.log(username.id);
    window.location.href=username.id;
}

function select_post(evt){
   let link=evt.target.id;
   window.loaction.href=link;
}

async function display_more_users(evt){
    console.log(evt);
    try{
        let xml=new XMLHttpRequest();
        xml.open('POST','/');
        xml.readyState=function(){

        }
        xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xml.send('action=morePosts');
    }catch(err){
        console.log(err);
    }
    get_ish_form_cookie();
}

// this function listens to all events that take place ont the site and handles them
function eventListeners(){
    let userProfile=document.getElementsByClassName("profile-button-img");
    let search_input=document.getElementById("search");
    
    let selectTopPost=document.getElementsByClassName("top-post");
    let selectBottomPost=document.getElementsByClassName("bottom-post");
    let viewMore=document.getElementsByClassName("view-more-btn")[0];
    let registerBtn = document.getElementById('userRegistration');
    let closeReg = document.getElementById("closeModalReg");

    let modal = document.getElementById("registerModal");


    // let morePosts=document.getElementById("");

    search_input.addEventListener("input",search_user);
    // viewMore.addEventListener("click",display_more_users);
    // morePosts.addEventListener("click",more_posts);
   
    for(let i=0;i<userProfile.length;i++){
        userProfile[i].addEventListener('click',openUserProfile);
    }

    for(let i=0;i<selectTopPost.length;i++){
        selectTopPost[i].addEventListener('click',openModal);
    }
    for(let i=0;i<selectBottomPost.length;i++){
        selectBottomPost[i].addEventListener('click',openModal);
    }

    registerBtn.addEventListener('click',function(evt) {
        modal.style.display = "block";
        // registrationForm.submissionBtn.addEventListener('click',function(evt){
        //     evt.preventDefault();
        //     clear_error_messages();
        //     registrationForm.form_submitted=evt;
        // });
      });

    closeReg.addEventListener('click',function(evt) {
        modal.style.display = "none";
    });
  
}
function init_user(username){
    // hide register button if user is available
   
    if(username==null || username==''){
        console.log('null username');
        return ;
    }
    document.getElementsByClassName("register-button")[0].style.display='none';
    console.log(username);
    document.getElementsByClassName("profile-link")[0].href="/@"+username;
}

function init_img(arr){
    console.log(arr);
    if(!Array.isArray(arr)){
        return;
    }
    console.log(arr);
    console.log('quick look=====');
    let p=document.getElementsByClassName("post-container");
    
    console.log(arr);
    for(let n=0;n<p.length;n++){
        console.log(typeof(p[n]));
        if(typeof(arr[n])!=='object'){
           console.log('======erorr');
           continue;
        }
        let ele=p[n].getElementsByClassName('post-image')[0];
        p[n].id=arr[n].primary_post.postLinkID;
        let ele_two=p[n].getElementsByClassName('post-image')[1];
        p[n].getElementsByClassName("profile-button")[0].id="/@"+arr[n].user_info.username;
        ele.src = arr[n].primary_post.img;
        ele_two.src =arr[n].secondary_post.img;
        console.log("======= end ======");
    }
}
open_postPreview();
get_ish_form_cookie();
eventListeners();


function openModal(evt) {
   
    let postTitle='happy';
    console.log(evt.target);
    let postImageSrc=evt.target.src;
    const modal = document.getElementById("postModal");
    const modalPostImage = document.getElementById("modalPostImage");
    let cont=evt.target.parentNode.parentNode.parentNode;
    let profile=cont.getElementsByClassName("profile-button")[0];
  
    modalPostImage.src = postImageSrc;
    modal.style.display = "block";
    document.getElementById("closeModal").addEventListener('click',closeModal);
    // let username=pro;
    // let postID=cont;
    console.log('profile=====');
    console.log(profile);
    console.log('post=====');
    console.log(profile.id+'/'+cont.id);
    // window.location.href=profile.id+'/'+cont.id;
    history.replaceState(null, null, profile.id+'/'+cont.id);
    if(profile.id=='' || cont.id==''){
        throw new Error('no profile id specified');
    }
    try{
        let xml=new XMLHttpRequest();
        xml.open('GET',profile.id+'/'+cont.id);
        xml.onreadystatechange=function(){
            console.log(this.responseText);
        }
        // xml.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        // xml.send("action=initialise_preview");
        xml.send();
    }catch(err){
        console.log(err);
    }

}

function closeModal() {
    history.replaceState(null, null, '/');
    const modal = document.getElementById("postModal");
    modal.style.display = "none";
}

function getCookieFromHeaders(headers) {
  const cookieHeader = headers.match(/^(.*?cookie: .*?)\n/i);
  if (cookieHeader) {
    return cookieHeader[0].split(':')[1].trim();
  }
  return null;
}
// get_registration_info_from_cookie();
// Form submission
document.getElementById("registerForm").onsubmit=formHandling;
async function formHandling(evt){
    console.log('working');
    let modal=document.getElementById('registerModal');
    evt.preventDefault();
    clear_error_messages();


    // let form=document.getElementById("registerForm");
    // let formData=new FormData(document.getElementById("registerForm"));
    let item={
        name:document.getElementById('name').value,
        lastName:document.getElementById('surname').value,
        password:document.getElementById('password').value,
        email:document.getElementById('email').value
    };
  
    item=JSON.stringify(item);
    try{
        
        let xm=new XMLHttpRequest();
        xm.open('POST','/registration');
        xm.setRequestHeader('Content-Type', 'application/json');

        xm.onreadystatechange=function(){
            
            if(this.readyState==4){
               console.log('========return data');
               let data=JSON.parse(this.responseText);
                if(data.status=='failed'){
                     for(let i=0;i<data.errorArray.length;i++){
                        const k=Object.keys(data.errorArray[i]);
                        console.log(data.errorArray[i]);
                        console.log(data.errorArray[i][k]);
                        document.getElementById(k).innerHTML=data.errorArray[i][k];
                    }

                  
                }
            else{
                 alert('succesfull logged in');
                modal.style.display='none';
                user.setup_profile();
            }
           
            document.getElementById('submitProfileSetup').addEventListener('click',function(evt){
                evt.preventDefault();
                let profileItem={
                    username:document.getElementById('profileName').value,
                    fullname:document.getElementById('fullName').value,
                    gender:document.getElementById('gender').value,
                    bio:document.getElementById('biography').value,
                    occupation:document.getElementById('occupation').value
                };
                try{
                    user.data=profileItem;
                    let formattedData=JSON.stringify(user.data);
                    let xml=new XMLHttpRequest();
                    xml.open('POST','/setup_profile');
                    xml.setRequestHeader('Content-Type', 'application/json');
                    xml.onreadystatechange=function(){
                        console.log(this.responseText);
                        let dataTwo=JSON.parse(this.responseText);
                        if(dataTwo.status=='failed'){
                            console.log(dataTwo);
                            for(let e=0;e<dataTwo.errors.length;e++){
                                console.log('creating tags');
                                let k=Object.keys(dataTwo.errors[e]);
                                document.getElementById(k).innerHTML=dataTwo.errors[e][k];
                            }
                        }
                        else{
                            alert('it works');
                            user.setupProfileModal.style.display='none';
                            user.registrationBtn.style.display='none';
                            return;
                        }
                        
                    }
                    xml.send(formattedData);
            
                    
                    }
                catch(err){
                    console.log(err);
                }
                
             

            });
        }
        // for(let i=0;i<data.errorArray.length;i++){
        //         const k=Object.keys(data.errorArray[i]);
        //         console.log(data.errorArray[i]);
        //         console.log(data.errorArray[i][k]);
        //         document.getElementById(k).innerHTML=data.errorArray[i][k];
        //     }
        }
    
        xm.send(item);
    

                
    
}
        
   
catch(err){
        console.log(err);
    }
}
           

