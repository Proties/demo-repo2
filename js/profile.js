function initialise(){
    try{
        let url=window.location.href;
        let f_url=url.substring(url.indexOf('@'));
        console.log(f_url);
        let xm=new XMLHttpRequest();
        xm.open("POST","/"+f_url);
        xm.onload=function(){
            console.log(this.responseText);
            let data=JSON.parse(this.responseText);
            // populate_user_info(data.user);
            let p=document.getElementsByClassName("post");
            for(let i=0;i<p.length;i++){
                let base64Image=data.post[i].img;
                const binaryS=atob(base64Image);
                const arrayBuffer = new ArrayBuffer(binaryS.length);
                const uint8Array = new Uint8Array(arrayBuffer);
                for (let i = 0; i < binaryS.length; i++) {
                    uint8Array[i] = binaryS.charCodeAt(i);
                  }
                const blob = new Blob([uint8Array], { type: 'image/png' });

                p[i].getElementsByTagName('img')[0].src=URL.createObjectURL(blob);
                console.log(p[i]);
            }
           
        }
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.send("action=initialise_user");

    }catch(err){
        console.log(err);
    }
}
function populate_user_info(info){
    let name=info.username;
    let pic=info.userProfilePicture;
    let bio=info.bio;
    document.getElementById('username').textContent=name;
    document.getElementById('userBio').textContent=bio;
    // document.getElementById('userProfilePicture').src=pic;
}
function populate_posts(post){
    let title=post.title;
    let description=post.description;
    let img=post.img;
    let authorName=post.authorName;
    let link=post.postLink;


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
