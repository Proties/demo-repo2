"strict"
import {MyProfile,OtherProfile} from './profile.js';
import StackedPosts from './stackPosts.js';
import MakePostUI from './makePost.js';
import PostUI from './post.js';

let currentProfile;
let uploadPost;

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
    console.log(data);
    console.log(user_data);
    intialiseProfileObject(data);
    return;
   
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


}


function intialiseProfileObject(data){
    let url=location.href;
    let last=url.lastIndexOf('/');
    url=url.slice(last+2,url.length);
    if(url=='profile'){
        currentProfile=new MyProfile();
        currentProfile.username=data.user[0]['username'];
        currentProfile.make_user_info;
        for(let p=0;p<5;p++){
             let post=new PostUI();
             currentProfile.addPost=post;
        }
    }
    else{
        currentProfile=new OtherProfile();
        currentProfile.username=data.user[0]['username'];
        // currentProfile.username=data.user[0]['username'];
        // currentProfile.username=data.user[0]['username'];
        currentProfile.make_user_info;
        console.log(currentProfile);
        for(let p=0;p<5;p++){
            let post=new PostUI();
            currentProfile.addPost=post;
        }

       
    }
}


function upload_post(){
    uploadPost=new MakePostUI();
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
