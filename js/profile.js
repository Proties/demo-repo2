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
                
            }
            return;
            let data={
                postImage:read,
                categoryName:document.getElementById("categoryName"),
                caption:document.getElementById("caption"),
                previewStatus:document.getElementById("preview")
            };
            data=JSON.stringify(data);
            xm=new XMLHttpRequest();
            xm.open('POST','/upload_post');
            xm.onload=function(){
                console.log(this.responseText);
                let dt=JSON.parse(this.responseText);
                for(let d=0;d<dt.errorArray.length;d++){
                    console.log(dt.errorArray[d]);
                }
            }
            xm.send(data);
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
