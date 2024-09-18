"strict"
class Profile extends User{
    constructor(){
        super();
    }
}
class MakeProfile extends Profile{

}
class ProfileUI extends Profile{
    constructor(){
        super();
        this._posts=[];
        this._editProfile=false;
        this._deletePost=false;
        this._uploadPost=false;
        this._editPost=false;
    }
    get posts(){
        return this._posts;
    }
    add_post(ps){
        this.posts.push(ps);
    }
    populate_profile_pic(){

    }
    populate_user_info(info){
        console.log(info[0]);
        document.getElementById('username').innerHTML=info[0].username;
        // document.getElementById('userBio').textContent=info.bio;
        // document.getElementById('userProfilePicture').src=pic;
    }
    populate_post(arr){
    let postEle=document.getElementsByClassName("postfeed-wrapper")[0];
    let container=document.getElementsByClassName('post-section')[0];
    console.log(arr);
    if(arr.length>1){
        let old=postEle.getElementsByTagName('img')[0].src=arr[0].img;
        for(let i=1;i<arr.length;i++){
            let newPost=postEle.cloneNode(true);
            newPost.getElementsByTagName('img')[0].src=arr[i].img;
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

}

class OtherProfile extends ProfileUI{
    constructor(){
        super();
    }
}

class MyProfile extends ProfileUI{
    constructor(){
        super();
        this._editProfile=true;
        this._deletePost=true;
        this._uploadPost=true;
        this._editPost=true;
        this._showSettings=true;
    }
}
class 
function get_cookie(name){
    let data=document.cookie;
    let dec=decodeURIComponent(data);
    let sp=dec.split(';');
    for(let x=0;x<sp.length;x++){
        let c=sp[x];
        while(c.charAt(0)==' '){
            c=c.substring(1);
            if(c.indexOf(name)==0){
           
            let parsed=c.substring(name.length,c.length);
            let dtt=JSON.parse(parsed);
            return dtt;
        }
    }
}
}
function get_data_from_cookie(){
    let user_data=get_cookie('username=');
    let data=get_cookie('profile=');

    // if my profile
    let profile=new MyProfile();
    profile.populate_user_info();
    profile.populate_post();
    //else
    let otherProfile=new OtherProfile();
    otherProfile.populate_user_info();
    otherProfile.populate_post();
    if(data==null || data==undefined){
        console.log('profile cookie not valid');
        return;
    }
    console.log(user_data);
    console.log(data.user[0]['username']);
    if(user_data!==data.user[0]['username']){
        document.getElementById("uploadBtn").style.display='none';
        document.getElementById("editProfileButton").style.display='none';
        document.getElementById("uploadModal").style.display='none';
        let modal=document.getElementsByClassName('modal');
        for(let i=0;i<modal.length;i++){
            console.log( modal[i]);
            modal[i].remove();
        }
        // document.getElementsByClassName("modal-content")[0].style.display='none';
        // document.getElementsByClassName("modal-content")[1].style.display='none';
    }
    console.log(data);

    populate_user_info(data.user);
    populate_post(data.posts);

}

// get_data_from_local_store();
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
            populate_post(data.posts);
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
        let old=postEle.getElementsByTagName('img')[0].src=arr[0].img;
        for(let i=1;i<arr.length;i++){
            let newPost=postEle.cloneNode(true);
            newPost.getElementsByTagName('img')[0].src=arr[i].img;
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
function open_upload_window(evt){
    const uploadModal = document.getElementById('uploadModal').style.display='block';
    console.log(uploadModal);
    console.log(evt);
}
function addEventListeners(){
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadModal = document.getElementById('uploadModal');
    const captionModal = document.getElementById('captionModal');
    const fileInput = document.getElementById('fileInput');
    const uploadProgress = document.getElementById('uploadProgress');
    const uploadFromDeviceBtn = document.getElementById('uploadFromDeviceBtn');
    let open_window=document.getElementsByClassName('upload-button')[0];

    // Open upload modal
    open_window.addEventListener('click', open_upload_window);

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target == uploadModal || event.target == captionModal) {
            uploadModal.style.display = 'none';
        }
    });

    // Close modal when clicking the close button
    const closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            uploadModal.style.display = 'none';
        });
    });

    // Upload post from device
    uploadFromDeviceBtn.addEventListener('click', () => {
        try{
            let item={};
            let file=fileInput.files[0];
            let read=new FileReader();
            read.readAsDataURL(file);
            read.onloadend=()=>{
                
                item.img=read.result;
                console.log(JSON.stringify(item));
                let num=(window.location.href).indexOf("@");
                let str=window.location.href;
                let name=str.substring(num+1);
                console.log(name);
                console.log('user nmae=======');
                let data={
                    img:item,
                    username:name
                    
                };
                xm=new XMLHttpRequest();
                xm.open('POST','/upload_post');
                xm.onload=function(){
                    console.log(this.responseText);
                    let dt=JSON.parse(this.responseText);
                    if(dt.status=='failed'){
                        if(dt.msg=='create account'){
                            alert('create account');
                        }
                    }
                    for(let d=0;d<dt.errorArray.length;d++){
                        console.log(dt.errorArray[d]);
                    }
                }
                xm.send(JSON.stringify(data));
            }
            
           
        }catch(err){
            console.log(err);
        }
    });

    
}

addEventListeners();
get_data_from_cookie();
