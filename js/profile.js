function initialise(){
    try{
        let xm=new XMLHttpRequest();
        xm.open("POST","/profile");
        xm.onload=function(){
            let data=JSON.parse(this.responseText);
            let user_info=data.user;
            for(let i=0;i<data.posts.length;i++){
                console.log('mm');
            }

        }
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.send("action=initialise");

    }catch(err){
        console.log(err);
    }
}
function eventListeners(){
    let postImage;
    let likePost;
    let commentPost;


}
initialise();
