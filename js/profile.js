"strict"
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
function get_data_from_local_store(){
    let url=window.location.href;
    let f_url=url.substring(url.indexOf('@'));
    if(f_url==localStorage('user')){
        let user=localStorage.getItem('user-details');
        let posts=localStorage.getItem('profile-photos');
        console.log('welcome owner');
        populate_user_info(user);
        populate_post(posts);
    }else{
        let data=sessionStorage.getItem('user-details');
        let posts=sessionStorage.getItem('profile-photos');
        console.log('stranger');
        populate_user_info(data.user);
        populate_post(posts);
    }
}
function get_data_from_cookie(){
    let data=get_cookie('profile=');
    populate_user_info(data.user);
    populate_post(data.posts);

}
get_data_from_cookie();
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
function addEventListeners(){
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadModal = document.getElementById('uploadModal');
    const captionModal = document.getElementById('captionModal');
    const fileInput = document.getElementById('fileInput');
    const uploadProgress = document.getElementById('uploadProgress');
    const uploadFromDeviceBtn = document.getElementById('uploadFromDeviceBtn');

    // Open upload modal
    uploadBtn.addEventListener('click', () => {
        uploadModal.style.display = 'block';
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', (event) => {
        if (event.target == uploadModal || event.target == captionModal) {
            uploadModal.style.display = 'none';
            captionModal.style.display = 'none';
        }
    });

    // Close modal when clicking the close button
    const closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            uploadModal.style.display = 'none';
            captionModal.style.display = 'none';
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

    // Upload progress simulation (for demonstration)
    let progress = 0;
    const simulateUploadProgress = setInterval(() => {
        if (progress >= 100) {
            clearInterval(simulateUploadProgress);
            uploadModal.style.display = 'none'; // Hide upload modal after upload complete
            captionModal.style.display = 'block'; // Show caption modal after upload complete
        } else {
            progress += 10;
            uploadProgress.style.width = `${progress}%`;
        }
    }, 1000);
}
addEventListeners();
