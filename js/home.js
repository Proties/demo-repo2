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
        let dataItem=[];
        console.log(data);
        init_user(data.user);
        init_categories(data.categories);
        for(let i=0;i<data.users.length;i++){
    
        const base64Image = data.users[i].primary_post.img; // your Base64-encoded image string
        const base64Image_two = data.users[i].primary_post.img;

        const binaryString = atob(base64Image);
        const arrayBuffer = new ArrayBuffer(binaryString.length);
        const uint8Array = new Uint8Array(arrayBuffer);

        const binaryString_two = atob(base64Image_two);
        const arrayBuffer_two = new ArrayBuffer(binaryString_two.length);
        const uint8Array_two = new Uint8Array(arrayBuffer_two);
        
        for (let i = 0; i < binaryString.length; i++) {
          uint8Array[i] = binaryString.charCodeAt(i);
        }
        for (let i = 0; i < binaryString_two.length; i++) {
            uint8Array_two[i] = binaryString_two.charCodeAt(i);
          }
        const blob = new Blob([uint8Array], { type: 'image/png' }); // or 'image/jpeg' or other image types
        const blob_two = new Blob([uint8Array_two], { type: 'image/png' }); // or 'image/jpeg' or other image types
        let item={primary:blob,seconday:blob_two,username:data.users[i].user_info.username};
        // now you can use the blob object to display the image
        // const img = document.getElementsByClassName('post-image');
        // img[i].src = URL.createObjectURL(blob);
        // img[i].id=data[i]['id'];
        
        dataItem.push(item);
        }
        init_img(dataItem);
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
    // document.getElementById("search").addEventListener("focusout",()=>{
    //     list.style.display='none';
        
    // });
    
    
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
// this function listens to all events that take place ont the site and handles them
function eventListeners(){
    let userProfile=document.getElementsByClassName("profile-button");
    let search_input=document.getElementById("search");
    let selectcategory=document.getElementsByClassName("tag");
    let likePost=document.getElementsByClassName("");
    let selectTopPost=document.getElementsByClassName("top-post");
    let selectBottomPost=document.getElementsByClassName("bottom-post");
    let commentPost=document.getElementsByClassName("");
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
        commentPost[i].addEventListener('click',comment_post);
    }
    registerBtn.addEventListener('click',function() {
        modal.style.display = "block";
      });

    closeReg.addEventListener('click',function(evt) {
        modal.style.display = "none";
    });
  
}
function init_user(arr){
    if(arr.username==null || arr.username==''){
        console.log('null username');
        return ;
    }
    console.log(arr.username);
    document.getElementsByClassName("profile-link")[0].href="/@"+arr.username;
}
function init_categories(arr){
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
        ele.src = URL.createObjectURL(arr[n].primary);
        ele_two.src = URL.createObjectURL(arr[n].seconday);
        
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
    // Your form submission code here
    // You can access form fields using document.getElementById or other methods
    // Example: var username = document.getElementById("username").value;
    // After processing, you can close the modal
    modal.style.display = "none";
};