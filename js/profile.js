function initialise(){
    try{
        let xm=new XMLHttpRequest();
        xm.open("POST","/profile");
        xm.onload=function(){
            let data=JSON.parse(this.responseText);
            for(let a=0;a<data.length;a++){
                
            }

        }
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.send("action=initialise");

    }catch(err){
        console.log(err);
    }
}
function select_post_item(evt){
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/profile');
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onload=function(){
            let data=JSON.parse(this.responseText);

            console.log(data);

        }
        xm.send("action=select_post&postID"+id);
    }catch(err){
        console.log(err);
    }
}
function like_post_item(evt){
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/profile');
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onload=function(){
            
        }
        xm.send("action=like&postID="+id);
    }catch(err){
        console.log(err);
    }
}
function comment_on_post(evt){
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/profile');
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.onload=function(){
            
        }
        xm.send("action=comment&postID="+id);
    }catch(err){
        console.log(err);
    }
}


function eventListeners(){
    let selectPost=document.getElementsByClassName("");
    let likePost=document.getElementsByClassName("");
    let commentPost=document.getElementsByClassName("");

    for(let i=0;i<selectPost.length;i++){
        selectPost[i].addEventListener("click",select_post_item);
    }
    for(let i=0;i<likePost.length;i++){
        likePost[i].addEventListener("click",like_post_item);
    }
    for(let i=0;i<commentPost.length;i++){
        commentPost[i].addEventListener("click",comment_on_post);
    }


}
initialise();
eventListeners();
