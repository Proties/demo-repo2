"strict"
import {MyProfile,OtherProfile} from './profile.js';
import {PostUI} from './post.js';
import StackedPosts from './stackPosts.js';
import RegistrationUI from './registration.js';

let user=new MyProfile();
let allData;
let profileList=[];
let registrationForm=new RegistrationUI();


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
    allData=get_cookie("users=");
    let user_data=get_cookie("user=");
    if(allData==undefined && user_data==undefined){
        console.log('no posts or user account');
        return;
    }else if(user_data!==undefined){
        console.log(user_data);
        initialiseObjects(allData,user_data,);
    }else{
        initialiseObjects(allData,user_data);
        console.log(allData);
        // init_img(allData);
        // init_user(user_data);
    }
    // init_categories(dtt.categories);
}
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
    return false;
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
function initialiseObjects(cookie_data,cookie_user){
    console.log('=========cookie data========');
    console.log(cookie_data);
    console.log(cookie_user);
    console.log(cookie_user);
    if(cookie_user!==undefined){
        user.username=cookie_user.username;
        user.fullName=cookie_user.fullname;
        user.bio=cookie_user.bio;
        user.registrationBtn.style.display='none';
    }
   if(cookie_data!==undefined){
        let parentCont=document.getElementsByClassName("postfeed-wrapper")[0];
        for(let i=0;i<cookie_data.length;i++){
            let profileItem=new OtherProfile();
            profileItem.stack=cookie_data.length;
            profileItem.add_image=cookie_data[i];
            profileItem.parentContainer=parentCont;
            profileItem.make_stack();
            profileItem.make_profilePic();
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
    let userProfile=document.getElementsByClassName("profile-button");
    let search_input=document.getElementById("search");
    
    let selectTopPost=document.getElementsByClassName("top-post");
    let selectBottomPost=document.getElementsByClassName("bottom-post");
    let viewMore=document.getElementsByClassName("view-more-btn")[0];
    let registerBtn = document.querySelector(".register-button");
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

    registerBtn.addEventListener('click',function() {
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

// get_registration_info_from_cookie();
// Form submission
document.getElementById("registerForm").onsubmit=formHandling;
async function formHandling(evt){
    let modal=document.getElementById('registerModal');
    event.preventDefault();
    clear_error_messages();


    let form=document.getElementById("registerForm");
    let formData=new FormData(document.getElementById("registerForm"));
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
        // xm.onreadystatechange=function(){
        //     console.log('form validation');
            
        //     let data=JSON.parse(this.responseText);
        //     console.log(data);
        //     if(data.status=='success'){
        //         alert('succesfull logged in');
        //         modal.style.display='none';

        //         user.setup_profile();
        //         document.getElementById('submitProfileSetup').addEventListener('click',function(evt){
        //             evt.preventDefault();
        //             let profileItem={
        //                 username:document.getElementById('profileName').value,
        //                 fullname:document.getElementById('fullName').value,
        //                 gender:document.getElementById('gender').value,
        //                 bio:document.getElementById('biography').value,
        //                 occupation:document.getElementById('occupation').value
        //             };
        //             user.data=profileItem;
        //             user.submit_profile_info();

        //         });
                

        //         return;
        //     }
        //     for(let i=0;i<data.errorArray.length;i++){
        //         const k=Object.keys(data.errorArray[i]);
        //         console.log(data.errorArray[i]);
        //         console.log(data.errorArray[i][k]);
        //         document.getElementById(k).innerHTML=data.errorArray[i][k];
        //     }
            
        // }
        xm.send(item);

        let data=get_registration_info_from_cookie();
        console.log(data);
        if(data.status=='success'){
            alert('succesfull logged in');
            modal.style.display='none';
            user.setup_profile();
            document.getElementById('submitProfileSetup').addEventListener('click',function(evt){
                evt.preventDefault();
                let profileItem={
                    username:document.getElementById('profileName').value,
                    fullname:document.getElementById('fullName').value,
                    gender:document.getElementById('gender').value,
                    bio:document.getElementById('biography').value,
                    occupation:document.getElementById('occupation').value
                };
                user.data=profileItem;
                user.submit_profile_info();
                let d=get_profile_setup_info_from_cookie();
                console.log(d);
                if(d!==false || d!==undefined){
                    if(d.status==='success'){
                        alert('it works');
                        user.setupProfileModal.style.display='none';
                        user.registrationBtn.style.display='none';
                        return;
                    }
                    console.log(d);
                    for(let e=0;e<d.errors.length;e++){
                        let k=Object.keys(d.errors[e]);
                  
                        document.getElementById(k).innerHTML=d.errors[e][k];
                    }
                }
             

            });
        }
        for(let i=0;i<data.errorArray.length;i++){
                const k=Object.keys(data.errorArray[i]);
                console.log(data.errorArray[i]);
                console.log(data.errorArray[i][k]);
                document.getElementById(k).innerHTML=data.errorArray[i][k];
            }
    }catch(err){
        console.log(err);
    }
}
