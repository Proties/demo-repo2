"strict"
function initialise_image(){
    try{
        let xml = new XMLHttpRequest();
    xml.open('POST', '/');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.setRequestHeader("Accept", "image/jpeg"); // Set Accept header to image/jpeg
    xml.onreadystatechange = function() {
  if (this.readyState === 4 && this.status === 200) {
    console.log(this.responseText);
    let response = this.response; // Get the response as an array buffer
    let blob = new Blob([response], {type: 'image/jpeg'});
    let url = URL.createObjectURL(blob);
    let img = document.getElementById('image');
    img.src = url;
  }
};
xml.send('action=initialise_image');
    }catch(err){
        console.log(err);
    }
}
function initialise_posts(){
    try{
        let xm=new XMLHttpRequest();
        xm.open("POST","/");
        xm.onload=function(){
            let data=this.responseText;
            console.log(data);
            let fdata=JSON.parse(data);
            console.log(fdata);
            // let postArray=data.posts;
            // let userArrays=data.topUsers;
           
        }
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.send("action=initialise_posts");
    }catch(err){
        console.log(err);
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
        console.log(ele.parentNode);
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
function suggest_user(){
    let container=document.getElementById('list_suggested');
    let list=document.createElement('li');
    let txt=document.createTextNode();
    list.append(txt);
    container.append(list);
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
function eventListeners(){
    let likeBtn=document.getElementsByClassName("like-button");
    let commentBtn=document.getElementsByClassName("");
    let search=document.getElementById("searchBtn");
    let search_input=document.getElementById("search");
    search_input.addEventListener("input",search_user);
    for(let i=0;i<commentBtn.length;i++){
        commentBtn[i].addEventListener('click',comment_on_post);
    }
    for(let i=0;i<likeBtn.length;i++){
        likeBtn[i].addEventListener('click',like_on_post);
    }
    

}
initialise_posts();
initialise_image();
eventListeners();
