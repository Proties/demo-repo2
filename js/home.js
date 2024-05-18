"strict"
function initialise_posts(){
    try{
        let xm=new XMLHttpRequest();
        xm.open("POST","/");
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
function send(e){
    try{

    }catch(err){
        console.log(err);
    }
}
eventListeners();
