function initialise(){
    try{
        let url=window.location.href;
        let f_url=url.substring(url.indexOf('@'));
        console.log(f_url);
        let big_data=[];
        let xm=new XMLHttpRequest();
        xm.open("POST","/"+f_url);
        xm.onload=function(){
            console.log(this.responseText);
            let data=JSON.parse(this.responseText);
            populate_user_info(data.user);
            for(let i=0;i<data.post.length;i++){
                let base64Image=data.post[i].img;
                const binaryS=atob(base64Image);
                const arrayBuffer = new ArrayBuffer(binaryS.length);
                const uint8Array = new Uint8Array(arrayBuffer);
                for (let i = 0; i < binaryS.length; i++) {
                    uint8Array[i] = binaryS.charCodeAt(i);
                  }
                const blob = new Blob([uint8Array], { type: 'image/png' });
                let item={img:blob};
                big_data.push(item);
            }
            populate_post(big_data);
           
        }
        xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xm.send("action=initialise_user");

    }catch(err){
        console.log(err);
    }
}
function populate_user_info(info){
    console.log(info[0]);
    document.getElementById('username').innerHTML=info[0].username;
    // document.getElementById('userBio').textContent=info.bio;
    // document.getElementById('userProfilePicture').src=pic;
}
function populate_post(arr){
    let postEle=document.getElementsByClassName("postfeed-wrapper")[0];
    let container=document.getElementsByClassName('post-section')[0];
    console.log(arr);
    if(arr.length>1){
        let old=postEle.getElementsByTagName('img')[0].src=URL.createObjectURL(arr[0].img);
        for(let i=1;i<arr.length;i++){
            let newPost=postEle.cloneNode(true);
            newPost.getElementsByTagName('img')[0].src=URL.createObjectURL(arr[i].img);
            console.log(newPost);
            container.appendChild(newPost);
        }
        return;
    }
   
    postEle.getElementsByTagName('img')[0].src=arr[0].img;
    
    // let title=document.getElementsByClassName('');
    // let img=document.getElementsByClassName('');
    // let id=document.getElementsByClassName('');
    // for(let i=0;i<arr.length;i++){
    //     title[i].innerHTML=arr[i].title;
    //     img[i].src=arr[i].image;
    //     id[i].id=arr[i].id;
    // }

}



function upload_post(){
    let file=document.getElementById('');
    let read=new FileReader();
    read.readAsDataURL(file);
    read.onload=function(){

    }
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','');
        xm.onload=function(){}
        xm.send();
    }catch(err){
        console.log(err);
    }
}
initialise();
