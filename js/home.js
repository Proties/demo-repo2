"strict"

function initialise_posts(){
    try{
        let xm=new XMLHttpRequest();
        xm.open("POST","/");
        xm.onload=function(){
            let data=this.responseText;
            let fdata=JSON.parse(data);
            console.log(fdata);
    
            // let postArray=data.posts;
            // let userArrays=data.topUsers;
           
        }
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.send("action=initialise");
    }catch(err){
        console.log(err);
    }
}
function comment_on_post(){
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
function like_post(){
    try{

    }catch(err){
        console.log(err);
    }
}
function suggest_user(){}
function search_user(){
    let text=document.getElementById("search").value;
    try{
        let xml=new XMLHttpRequest();
        xml.onload=function(){
            let data=JSON.parse(this.responseText);
            if(typeof data.search_results=='array'){
                for(let i=0;i<data.search_results;i++){
                    console.log(data.search_results[i]);
                }
            }
            console.log(data.search_results);
        }
        xml.open('POST','/');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("action=search&q="+text);
    }catch(err){
        console.log(err);
    }
}
function eventListeners(){
    // let likeBtn=document.getElementsByClassName("");
    // let unLikeBtn=document.getElementsByClassName("");
    // let viewCommentBtn=document.getElementsByClassName("");
    // let commentBtn=document.getElementsByClassName("");
    let search=document.getElementById("searchBtn");

    search.addEventListener("click",search_user);

    

}
initialise_posts();
eventListeners();
