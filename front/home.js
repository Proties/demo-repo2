"strict"
function initialise_posts(){
    try{
        let xm=new XMLHttpRequest();
        xm.open("POST","/home");
        xm.onload=function(){
            let data=xm.responseText;
            data=JSON.parse(data);
            for(let i=0;i<data.posts.length;i++){
               console.log(data.posts[i]);
            }
        }
        xm.send("q=intialise");
    }catch(err){
        console.log(err);
    }
}
function eventListener(){
    let likeBtn=document.getElementsByClassName("");
    let unLikeBtn=document.getElementsByClassName("");
    let viewCommentBtn=document.getElementsByClassName("");
    let commentBtn=document.getElementsByClassName("");
    let bottom=document.getElementById("");

    for(let a=0;a<likeBtn.length;a++){

    }
    for(let a=0;a<unLikeBtn.length;a++){

    }
    for(let b=0;b<viewCommentBtn.length;b++){
        
    }
    for(let c=0;c<commentBtn.length;c++){
        
    }

}
function send(e){
    try{

    }catch(err){
        console.log(err);
    }
}
initialise_posts();