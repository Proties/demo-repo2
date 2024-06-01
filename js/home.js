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
        console.log(data);
        
        let dataItem=[];
      
        for(let i=0;i<data.length;i++){
    
        const base64Image = data[i].user.primary_post.img; // your Base64-encoded image string
        const base64Image_two = data[i].user.primary_post.img;

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
        let item={primary:blob,seconday:blob_two};
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
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/');
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onload=function(){
            let data=JSON.parse(this.responseText);

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
// this function direct the user to a users profile when a user account is selected
function openUserProfile(evt){
    let username=evt.target.parentNode;
    let name=username.getElementsByClassName();
    console.log(name);
    window.location.href='@'+name;
}
//this function sends the category name a user has selected and returns post that match that cateogry
function select_category(evt){
    try{

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
    let userProfile=document.getElementsByClassName("");
    let search_input=document.getElementById("search");
    let category=document.getElementsByClassName("");
    let likePost=document.getElementsByClassName("");
    let selectPost=document.getElementsByClassName("");
    let commentPost=document.getElementsByClassName("");
    // let morePosts=document.getElementById("");

    search_input.addEventListener("input",search_user);
    // morePosts.addEventListener("click",more_posts);
    for(let i=0;i<category.length;i++){
        category[i].addEventListener('click',select_category);
    }
    for(let i=0;i<userProfile.length;i++){
        userProfile[i].addEventListener('click',openUserProfile);
    }
    for(let i=0;i<likePost.length;i++){
        likePost[i].addEventListener('click',like_post);
    }
    for(let i=0;i<selectPost.length;i++){
        selectPost[i].addEventListener('click',select_post);
    }
     for(let i=0;i<commentPost.length;i++){
        commentPost[i].addEventListener('click',comment_post);
    }

    
    

}
function init_img(arr){

    let p=document.getElementsByClassName("post-container");
    for(let n=0;n<p.length-1;n++){

        let ele=p[n].getElementsByClassName('post-image')[0];
        let ele_two=p[n].getElementsByClassName('post-image')[1];
        console.log(ele);
        console.log(arr[n]);
        ele.src = URL.createObjectURL(arr[n].primary);
        ele_two.src = URL.createObjectURL(arr[n].seconday);
        
        console.log("======= end ======");
    }
    // let c=document.getElementsByClassName("post-image");
    // for(let n=0;n<c.length-1;n++){
    //     console.log(c[n]);
    // }
    

}
open_postPreview();
initialise_image();
eventListeners();

