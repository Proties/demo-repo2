"strict"
function initialise_image(){
    try{
        let xml = new XMLHttpRequest();
    xml.open('POST', '/');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.onload = function() {
        
        let data=JSON.parse(this.responseText);
        console.log(data);
        for(let i=0;i<data.posts.length;i++){
    
        const base64Image = data.posts[i].image; // your Base64-encoded image string
        console.log(data.posts[i].image);
        const binaryString = atob(base64Image);
        const arrayBuffer = new ArrayBuffer(binaryString.length);
        const uint8Array = new Uint8Array(arrayBuffer);
        
        for (let i = 0; i < binaryString.length; i++) {
          uint8Array[i] = binaryString.charCodeAt(i);
        }
        
        const blob = new Blob([uint8Array], { type: 'image/png' }); // or 'image/jpeg' or other image types
        
        // now you can use the blob object to display the image
        const img = document.getElementsByClassName('post-image');
        img[i].src = URL.createObjectURL(blob);
        // img[i].id=data[i]['id'];
        set_username(data.topUsers[i].userName);
       
    console.log(img[i]);
        }
}
xml.send('action=initialise_image');
    }catch(err){
        console.log(err);
    }
}
function set_username(user){
let username=document.getElementsByClassName('topUserusername');
for(let x=0;x<username.length;x++){
    username[x].innerHTML=user;
}
}
function comment_on_post(evt){
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/');
        xm.onload=function(){

        }
        xm.send("action=comment&text="+txt);
    }catch(err){
        console.log(err);
    }
}
function like_on_post(evt){
    console.log('liked');
    try{
        let ele=evt.target;
        let parent=ele.parentNode;
        let gran=parent.parentNode;
        console.log(gran.parentNode.id);
        id=6;

        let xml=new XMLHttpRequest();
        xml.open('POST','/');
        xml.onload=function(){
            console.log(this.responseText);
        }
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send('action=like&postID='+id);
        
    }catch(err){
        console.log(err);
    }
}

function search_user(){
    let text=document.getElementById("search").value;
    try{
        let xml=new XMLHttpRequest();
        xml.onload=function(){
            let data=JSON.parse(this.responseText);
            console.log(data);
            console.log(data.searchResults);
            for(let i=0;data.searchResults.length;i++){
                console.log(data.searchResults[i].username);
            }
        }
        xml.open('POST','/');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("action=search&q="+text);
    }catch(err){
        console.log(err);
    }
}
function openUserProfile(evt){
    let username=evt.target.parentNode;
    let name=username.getElementsByClassName('topUserusername')[0].textContent;
    console.log(name);
    window.location.href='@'+name;
}
function eventListeners(){
    let likeBtn=document.getElementsByClassName("like-button");
    let commentBtn=document.getElementsByClassName("");
    let topUserProfile=document.getElementsByClassName("pop-user-profile");
    let search_input=document.getElementById("search");
    search_input.addEventListener("input",search_user);
    for(let i=0;i<topUserProfile.length;i++){
        
        topUserProfile[i].addEventListener('click',openUserProfile);
    }
    for(let i=0;i<commentBtn.length;i++){
        commentBtn[i].addEventListener('click',comment_on_post);
    }
    for(let i=0;i<likeBtn.length;i++){
        likeBtn[i].addEventListener('click',like_on_post);
    }
    

}
initialise_image();
eventListeners();
