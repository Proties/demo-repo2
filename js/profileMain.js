"strict"
import {MyProfile,OtherProfile} from './profile.js';
import StackedPosts from './stackPosts.js';
import {MakePostUI} from './makePost.js';
import {PostUI} from './post.js';
import TemplateUI from './template.js';
import {Follow,UnFollow} from './follow.js';
import EditProfile from './editProfile.js';

let currentProfile;
let myProfile;
const uploadPost=new MakePostUI();
const editProfile=new EditProfile();

let temp=new TemplateUI();
function get_cookie(name){
    let data=document.cookie;
    let dec=decodeURIComponent(data);
    let sp=dec.split(';');
    for(let x=0;x<sp.length;x++){
        let c=sp[x];
        while(c.charAt(0)==' '){
            console.log(c);
            c=c.substring(1);
            if(c.indexOf(name)==0){
           
            let parsed=c.substring(name.length,c.length);
            let dtt=JSON.parse(parsed);
            return dtt;
        }
    }
}
}
function getUploadStatus(){
    let data=get_cookie('postUploadStatus=');
  
    console.log('======getting upload status');
        
        if(data==undefined || data==false){
            return;
        }
        if(data.status=='success'){
            alert('success')
        }else{
            //call review window 
            //fill  in user details that user provided
            alert(data.message);
        }
        console.log(data);
        console.log('======getting upload status');
    }
    

getUploadStatus();
function get_data_from_cookie(){
    let user_data=get_cookie('myprofile=');
    let setUpProfile=get_cookie('setUpProfile=');
    let data=get_cookie('profile=');
    if(user_data!==undefined){
        initialiseProfile(user_data); 
    }else{
         intialiseProfileObject(data,setUpProfile);
    }
    
   
}

function get_template_upload_status(){
    let uploadStatus=get_cookie('templateUpload=');
    if(uploadStatus!==undefined){
        return uploadStatus;
    }
    return false;
}
function template_info_from_cookie(){
    let list=get_cookie('templateList=');
    if(list!==undefined){
        return list;
    }
    console.log(list);
    return false;
}
function readFile(file){
    let fileOne=file.files[0];
    // let fileTwo=file.files[1];
    let reader=new FileReader();
    console.log(file);
    reader.onload=function(evt){
        console.log(evt.target.result);
        temp.html=evt.target.result;
        
        console.log('====== file reader=====');
        temp.html=reader.result;
        console.log(fileOne);
        temp.filename=fileOne.name;
        temp.sendToHtmlServer();
        let uploadStatus=get_template_upload_status();
        console.log('template status ==========');
        console.log(uploadStatus);
        if(uploadStatus.status=='success'){
            alert('successfull');
            //add new file into template list
            return true;
        }
        alert('could not add template because '+uploadStatus.error);

        return false;    
    }
    reader.readAsText(fileOne);
    // reader.readAsText(fileTwo);
            
}
function clear_placeholder_posts(){
    let postCont=document.getElementsByClassName('posts-container');
    let i=0;
    let max=postCont.length;
    while(i<max){
        postCont[i].remove();
        i++;
    }
}
function clear_template_list(){
    let list=document.getElementsByClassName('templateContainer')[0];
    for(let tl=0;tl<list.childNodes.length;tl++){
        list.removeChild(list.childNodes[tl]);
    }
}
async function validateTemplateSubmission(evt){
    evt.preventDefault();
    console.log('validating template submissions');
    let file=document.getElementById('templateFiles');
    let form=document.getElementById('uploadTemplateForm');
    let data=await readFile(file);
    document.getElementById('templateModal').style.display='none';
}
function initialiseProfile(data){
    myProfile=new MyProfile();
    if(data!==undefined){
        myProfile.id=data.userInfo.userID;
        myProfile.username=data.userInfo.username;
        myProfile.fullname=data.userInfo.fullname;
        myProfile.shortBio=data.userInfo.shortBio;
        myProfile.longBio=data.userInfo.longBio;
       
        myProfile.posts=data.posts;
        myProfile.make_user_info();
        myProfile.is_logged_in();
        let parentContainer=document.getElementsByClassName("posts-section")[0];
        console.log('parentContainer=========');
        console.log(parentContainer)
        const postLen=myProfile.posts.length;
        // clear_placeholder_posts();
        for(let p=0;p<postLen;p++){
            let post=new PostUI();
       
            post.parentContainer=parentContainer;

            post.id=myProfile.posts[p].postID;
            console.log(myProfile.posts[p]);
            // post.src='/Image/Art.png';
            if(myProfile.posts[p].imageFilePath!==null || myProfile.posts[p].imageFileName!==null){
                post.src=myProfile.posts[p].imageFilePath+'/'+myProfile.posts[p].imageFileName;
                post.make_post();
            }else{
                post.src=myProfile.posts[p].videoFilePath+'/'+myProfile.posts[p].videoFileName;
                post.make_video_post();
            }
            
            // post.check_media_type();
    }
    }
    console.log('======my profile object=====');
    console.log(myProfile);
    console.log('======my profile object=====');
}
async function intialiseProfileObject(data,myData){
   
    let profile_data;
    console.log(data);
    let url=location.href;
    let last=url.lastIndexOf('/');
    url=url.slice(last+1,url.length);
    console.log('======myprofile ======');
    console.log(url);
    if(url=='profile'){
        console.log('======myprofile ======');
        console.log(url);
        if(myData!==undefined){
            profile_data=myData;
        }
        url=url.slice(1,url.length);
        console.log('profile data======');
        console.log(profile_data);
        currentProfile=new MyProfile();
        currentProfile.is_logged_in();
        currentProfile.username=profile_data.username;
        currentProfile.id=profile_data.userInfo.userID;
        console.log(profile_data);
       
        currentProfile.shortBio=profile_data.shortBio;
        currentProfile.longBio=profile_data.longBio;
        currentProfile.fullname=profile_data.fullname;
        currentProfile.make_user_info();
        currentProfile.is_logged_in();
        
        console.log(currentProfile);
        let con=document.getElementsByClassName('container')[0];
        
    currentProfile.make_user_info();
   clear_placeholder_posts();
    console.log(data);
    if(data!==undefined){
        let parentContainer=document.getElementsByClassName("posts-section")[0];
        console.log('parentContainer=========');
        console.log(parentContainer);
        for(let p=0;p<data.posts.length;p++){
            let post=new PostUI();
            // post.populate_post();
            post.parentContainer=parentContainer;

            post.id=data.posts[p].postID;
            // post.src='/Image/Art.png';
            console.log('========image file path');
            if(data.posts[p].imageFilePath!==undefined || data.posts[p].imageFilePath!==null){
                post.src=data.posts[p].imageFilePath+'/'+data.posts[p].imageFileName;
                post.make_post();
            }else{
                post.src=data.posts[p].videoFilePath+'/'+data.posts[p].videoFileName;
                post.make_video_post();
            }
            
    }
    }
 }

    else{
       console.log('======other profile data');
       console.log(data);
        currentProfile=new OtherProfile();

       
        currentProfile.username=data.user.username;
        currentProfile.shortBio=data.user.shortBio;
        currentProfile.longBio=data.user.longBio;
        currentProfile.fullname=data.user.fullname;
        currentProfile.make_user_info();
        console.log(currentProfile);
        let parentContainer=document.getElementsByClassName("posts-section")[0];
        console.log('parentContainer=========');
        console.log(parentContainer);
        // clear_placeholder_posts();
        const otherProfilePostLen=data.posts.length;
        for(let p=0;p<otherProfilePostLen;p++){
            let postTwo=new PostUI();
            
            postTwo.parentContainer=parentContainer;
            postTwo.id=data.posts[p].postID;
            if(data.posts[p].imageFileName==undefined){
                postTwo.src=data.posts[p].videoFilePath+''+data.posts[p].videoFileName;
                postTwo.check_media_type();
            }else{
                postTwo.src=data.posts[p].imageFilePath+''+data.posts[p].imageFileName;
                postTwo.check_media_type();
            }
            
           
        }

       
    }
}

function clear_upload_file(){
    
}
function clear_review_data(){
    
}

function open_upload_window(evt){
    clear_upload_file();
    clear_review_data();
    uploadPost.make_drop_drag_window();
    const uploadModal = document.getElementById('uploadModal');
    uploadPost.uploadFile.addEventListener('change',function(evt){
        uploadModal.style.display='none';
        uploadPost.reviewUpload.reviewPostModal.style.display='block';
        let file=document.getElementById('fileInput');
        uploadPost.reviewUpload.file=file.files[0];
        console.log('=======upload files=====');
        uploadPost.reviewUpload.download_media();
        console.log(uploadPost.reviewUpload.file);
        uploadPost.reviewUpload.closeReviewModalBtn.addEventListener('click',function(evt){
            uploadPost.reviewUpload.reviewPostModal.style.display='none'
        });
        uploadPost.reviewUpload.submitForm.addEventListener('click',function(evt){
            evt.preventDefault();
            try{
                uploadPost.reviewUpload;
            }catch(err){
                console.log(err);
            }
            
        });
    });
    uploadModal.style.display='block';
  
}
function expandTrophies(){

}
async function followProfile(evt){
    // let btn=evt.target;
    let url=window.href;
    console.log(url);
    let follow=new Follow();
    follow.myProfile;
    follow.currentProfile;
    follow.sendFollow();
}
function unfollowProfile(evt){
    // let btn=evt.target;
    let url=window.href;
    console.log(url);
    let follow=new UnFollow();
    follow.myProfile=myProfile;
    follow.currentProfile=currentProfile;
    // follow.sendFollow();

    //replace follow btn with unfollow btn
   
}
function addEventListeners(){
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadModal = document.getElementById('uploadModal');
    const captionModal = document.getElementById('captionModal');
    const fileInput = document.getElementById('fileInput');
    const uploadProgress = document.getElementById('uploadProgress');
    const uploadFromDeviceBtn = document.getElementById('uploadFromDeviceBtn');
    let open_window=document.getElementsByClassName('upload-button')[0];
    let closeTemplateWindow=document.getElementById('closepicktemplate');
    let followUser=document.getElementById('followBtn');
    
    
    let expandTrophyCase=document.getElementsByClassName('add-trophies-button')[0];
    // Open upload modal
    expandTrophyCase.addEventListener('click',expandTrophies);
    followUser.addEventListener('click',followProfile);
    closeTemplateWindow.addEventListener('click',function(evt){
        document.getElementById('PickTemplateModal').style.display='none';
    });
    open_window.addEventListener('click', open_upload_window);

    // Close modal when clicking outside the modal content
    // window.addEventListener('click', function(event) {
        
    //     if (event.target == uploadModal || event.target == captionModal) {
    //         uploadModal.style.display = 'none';
    //     }
    // });

    // Close modal when clicking the close button
    const closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            uploadModal.style.display = 'none';
        });
    });
}
    // Upload post from device
//     uploadFromDeviceBtn.addEventListener('click', () => {
//         try{
//             let item={};
//             let file=fileInput.files[0];
//             let read=new FileReader();
//             read.readAsDataURL(file);
//             read.onloadend=()=>{
                
//                 item.img=read.result;
//                 console.log(JSON.stringify(item));
//                 let num=(window.location.href).indexOf("@");
//                 let str=window.location.href;
//                 let name=str.substring(num+1);
//                 console.log(name);
//                 console.log('user nmae=======');
//                 let data={
//                     img:item,
//                     username:name
                    
//                 };
//                 xm=new XMLHttpRequest();
//                 xm.open('POST','/upload_post');
//                 xm.onload=function(){
//                     console.log(this.responseText);
//                     let dt=JSON.parse(this.responseText);
//                     if(dt.status=='failed'){
//                         if(dt.msg=='create account'){
//                             alert('create account');
//                         }
//                     }
//                     for(let d=0;d<dt.errorArray.length;d++){
//                         console.log(dt.errorArray[d]);
//                     }
//                 }
//                 xm.send(JSON.stringify(data));
//             }
            
           
//         }catch(err){
//             console.log(err);
//         }
//     });

    
// }

addEventListeners();
get_data_from_cookie();
