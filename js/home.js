"strict"
import MyProfile from './profile.js'
let user=new MyProfile();
let allData;
let profileList=[];



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
                console.log(c);
            let parsed=c.substring(name.length,c.length);
            let dtt=JSON.parse(parsed);

            return dtt;
        }
    }
}
}
function get_ish_form_cookie(){
            allData=get_cookie("users=");
            let user_data=get_cookie("username=");
            if(allData==undefined && user_data==undefined){
                console.log('no posts or user account');
                return;
            }else if(user_data!==undefined){
                console.log(user_data);
                init_user(user_data);
            }else{
                initialiseObjects(allData);
                console.log(allData);
                // init_img(allData);
                // init_user(user_data);
            }
            
            
            // init_categories(dtt.categories);
}
function initialiseObjects(data){
    let parentCont=document.getElementsByClassName("post-container");
    for(let i=0;i<data.length;i++){
        let profileItem=new OtherProfile();
        profileItem.stack=data.length;
        profileItem.add_image(data[i]);
        profileItem.parentContainer=parentCont;
        profileItem.make_stack();
        profileItem.make_profilePic();

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
// this function get called when user entres text on the search box it then takes the text to the serve
// and preforms a search of matchin words on the database of usernames
function search_user(){
    let text=document.getElementById("search").value;
    let list=document.getElementById('suggestion-list');
    
    
    
    try{
        let xml=new XMLHttpRequest();
        xml.onreadystatechange=function(){
            if(this.readyState==4 ){
                let data=JSON.parse(this.responseText);
            console.log(data);

            list.style.display='block';
            list.innerHTML='';
            console.log('works');
            let len=data.searchResults.length;
            for(let i=0;i<len;i++){
                const l=document.createElement('li');
                l.textContent=data.searchResults[i];
                // l.id="/@"+username;
                list.appendChild(l);
                console.log(data.searchResults[i]);
                l.addEventListener("click",(evt)=>{
                    console.log("works");
                    console.log(evt.target.textContent);
                    window.location.href="/@"+evt.target.textContent;
                });
            }
            
            }
        }
        xml.open('POST','/');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        text=JSON.stringify(text);
        xml.send("action=search&q="+text);
    }catch(err){
        console.log(err);
    }
    document.getElementById("search").addEventListener("focusout",()=>{
        list.style.display='none';
        
    });
}
function clear_error_messages(){
    document.getElementById("errPassword").innerHTML='';
    document.getElementById("errName").innerHTML='';
    document.getElementById("errUsername").innerHTML='';
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
    viewMore.addEventListener("click",display_more_users);
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

// Form submission
document.getElementById("registerForm").onsubmit = function(event) {
    event.preventDefault();
    clear_error_messages();
    let form=document.getElementById("registerForm");
    let formData=new FormData(document.getElementById("registerForm"));
    let item={
        name:document.getElementById('name').value,
        username:document.getElementById('username').value,
        password:document.getElementById('password').value,
        email:document.getElementById('email').value
    };
    item=JSON.stringify(item);
    try{
        
        let xm=new XMLHttpRequest();
        xm.open('POST','/registration');
        xm.setRequestHeader('Content-Type', 'application/json');
        xm.onload=function(){
            console.log('form validation');
            
            let data=JSON.parse(this.responseText);
            console.log(data);
            if(data.status=='success'){
                alert('succesfull logged in');
                document.getElementById('registerModal').style.display='none';
                return;
            }
            for(let i=0;i<data.errorArray.length;i++){
                const k=Object.keys(data.errorArray[i]);
                console.log(data.errorArray[i]);
                console.log(data.errorArray[i][k]);
                document.getElementById(k).innerHTML=data.errorArray[i][k];
            }
            
        }
        xm.send(item);
    }catch(err){
        console.log(err);
    }
   
    modal.style.display = "none";
};