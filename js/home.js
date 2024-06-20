"strict"
// this function get post data like images,athtorname form the server
function initialise_image(){
    try{
        let xml = new XMLHttpRequest();
    xml.open('POST', '/');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.onload = function() {
        // console.log(this.responseText);
        let data=JSON.parse(this.responseText);
        // document.getElementsByClassName('profile-link').href="@"+data.user.user_info.username;
        console.log(data);
        init_user(data.user);
        init_categories(data.categories);
        init_img(data.users);
}
xml.send('action=initialise_image');
    }catch(err){
        console.log(err);
    }
}
// this function checks the url to see if a post has been selected if so it will get data from the serve
function open_postPreview(){
    let url=window.location.href;
    const pattern=/(\/@[a-zA-Z]{3,17})(\/[a-zA-Z0-9]){5,20}/;
    console.log(url);
    if(pattern.test(url)){
        console.log(url);
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/');
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onload=function(){
            let data=JSON.parse(this.responseText);
            openModal(data);
            console.log(data);
            console.log('hahaha');
        }
        xm.send('action=initialise_post_preview');
    }catch(err){
        console.log(err);
    }
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
        xml.onload=function(){
            let data=JSON.parse(this.responseText);
            console.log(data.searchResults);
            list.style.display='block';
            list.innerHTML='';
            for(let i=0;data.searchResults.length;i++){
                const l=document.createElement('li');
                l.textContent=data.searchResults[i].username;
                // l.id="/@"+username;
                list.appendChild(l);
                console.log(data.searchResults[i].username);
                l.addEventListener("click",(evt)=>{
                    console.log("works");
                    console.log(evt.target.textContent);
                    window.location.href="/@"+evt.target.textContent;
                });
            }
        }
        xml.open('POST','/');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
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
//this function sends the category name a user has selected and returns post that match that cateogry
function select_category(evt){
    try{
        let ele=evt.target;
        let name=ele.innerHTML;
        let xm=new XMLHttpRequest();
        xm.open('POST','/');
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onload=function (){
            console.log(this.responseText);
            let data=JSON.parse(this.responseText);
            let posts=[];
            if(data.length==0){
                return;
            }
            for(let i=0;i<data.users.length;i++){

                let item={primary_post:s,secondary_post:s,user:s};
                posts.push(item);
            }
            init_img(posts);
        }
        xm.send("action=select_category&categoryName="+name);
        console.log(ele);
    }catch(err){
        console.log(err);
    }
}
function select_post(evt){
   let link=evt.target.id;
   window.loaction.href=link;
}
//when user clicks the comment button the comment modal will popup
function show_coment(){
    let container=document.getElementById("writeCommentModal");
    container.style.display='flex';
    container.getElementsByTagName("button")[0].addEventListener('click',function(){
        console.log("works");
        container.style.display='none';
    });
    container.getElementsByClassName("close")[0].addEventListener('click',function(){
        console.log("works");
        container.style.display='none';
    });

    container.getElementsByTagName("button")[1].addEventListener("click",function(evt){
        console.log("prevent comment submission");
        let txt=container.getElementsByTagName('textarea')[0].value;
        console.log(txt);
        evt.preventDefault();
        try{
            let xml=new XMLHttpRequest();
            xml.open('POST','/');
            xml.onload=function(){
                console.log('submitted');
                console.log(this.responseText);
                if(data.status=='success'){
                    container.style.display='none';
                }
            }
            xml.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xml.send('action=comment');
        }catch(err){
            console.log(err);
        }

    });
}
function like_post(evt){
    let ele=evt.target;
    let postEle=ele.parentNode.parentNode.parentNode;

    try{
        console.log(postEle);
        let t=postEle.getElementsByClassName("post")[0].id;
        console.log(t);
        // let xml=new XMLHttpRequest();
        // xml.onload=function(){}
        // xml.open('POST','/');
        // xml.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        // xml.send('action=like&postID=postEle');
        alert('you have liked the post');
    }catch(err){
        console.log(err);
    }

}
// this function listens to all events that take place ont the site and handles them
function eventListeners(){
    let userProfile=document.getElementsByClassName("profile-button");
    let search_input=document.getElementById("search");
    let selectcategory=document.getElementsByClassName("tag");
    let likePost=document.getElementsByClassName("like-button");
    let selectTopPost=document.getElementsByClassName("top-post");
    let selectBottomPost=document.getElementsByClassName("bottom-post");
    let commentPost=document.getElementsByClassName("comment-button");
    let registerBtn = document.querySelector(".register-button");
    let closeReg = document.getElementById("closeModalReg");
    let modal = document.getElementById("registerModal");


    // let morePosts=document.getElementById("");

    search_input.addEventListener("input",search_user);
    // morePosts.addEventListener("click",more_posts);
    for(let i=0;i<selectcategory.length;i++){
        selectcategory[i].addEventListener('click',select_category);
    }
    for(let i=0;i<userProfile.length;i++){
        userProfile[i].addEventListener('click',openUserProfile);
    }
    for(let i=0;i<likePost.length;i++){
        likePost[i].addEventListener('click',like_post);
    }
    for(let i=0;i<selectTopPost.length;i++){
        selectTopPost[i].addEventListener('click',openModal);
    }
    for(let i=0;i<selectBottomPost.length;i++){
        selectBottomPost[i].addEventListener('click',openModal);
    }
     for(let i=0;i<commentPost.length;i++){
        commentPost[i].addEventListener('click',show_coment);
    }
    registerBtn.addEventListener('click',function() {
        modal.style.display = "block";
      });

    closeReg.addEventListener('click',function(evt) {
        modal.style.display = "none";
    });
  
}
function init_user(arr){
    // hide register button if user is available
   
    if(arr.username==null || arr.username==''){
        console.log('null username');
        return ;
    }
    document.getElementsByClassName("register-button")[0].style.display='none';
    console.log(arr.username);
    document.getElementsByClassName("profile-link")[0].href="/@"+arr.username;
}
function init_categories(arr){
    if(!Array.isArray(arr)){
        return;
    }
    let cats=document.getElementsByClassName('tag');
    let max=arr.length;
    console.log(max);
    console.log(cats.length);

        for(let i=0;i<cats.length;i++){
            if(i>max){
                cats[i].remove();
            }
        }
    console.log(cats.length);
    for(let x=0;x<arr.length;x++){
        console.log(arr[x]);
        cats[x].getElementsByTagName('span')[0].innerHTML=arr[x].categoryName;
    }
}
function init_img(arr){
    if(!Array.isArray(arr)){
        return;
    }
    let p=document.getElementsByClassName("post-container");
    console.log(arr);
    for(let n=0;n<p.length;n++){
        if(arr[n]==undefined){
            return;
        }
        console.log(arr[n]);
        let ele=p[n].getElementsByClassName('post-image')[0];
        let ele_two=p[n].getElementsByClassName('post-image')[1];
        p[n].getElementsByClassName("profile-button")[0].id="/@"+arr[n].username;
        ele.src = arr[n].primary.img;
        ele_two.src =arr[n].seconday.img;
        
        console.log("======= end ======");
    }
}
open_postPreview();
initialise_image();
eventListeners();


function openModal(evt) {
   
    let postTitle='happy';
    let postImageSrc=evt.target.src;
    const modal = document.getElementById("postModal");
    const modalPostImage = document.getElementById("modalPostImage");

    modalPostImage.src = postImageSrc;
    modal.style.display = "block";
    document.getElementById("closeModal").addEventListener('click',closeModal);
}

function closeModal() {
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