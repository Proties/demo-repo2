"strict"
import {MyProfile,OtherProfile} from './profile.js';
import StackedPosts from './stackPosts.js';
import {MakePostUI} from './makePost.js';
import {PostUI} from './post.js';
import TemplateUI from './template.js';
import {Follow,UnFollow} from './follow.js';
let currentProfile;
let myProfile;
const uploadPost=new MakePostUI();


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
function get_data_from_cookie(){
    let user_data=get_cookie('username=');
    let setUpProfile=get_cookie('setUpProfile=');
    let data=get_cookie('profile=');
    initialiseProfile(user_data); 
    intialiseProfileObject(data,setUpProfile);
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
        myProfile.id=data.id;
        myProfile.username=data.username;
        myProfile.fullname=data.fullname;
        myProfile.shortBio=data.shortBio;
        myProfile.longBio=data.longBio;
    }
}
async function intialiseProfileObject(data,myData){
    // if(data==undefined){
    //     return;
    // }
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
        currentProfile.id=profile_data.id;
        console.log(profile_data);
       
        currentProfile.shortBio=profile_data.shortBio;
        currentProfile.longBio=profile_data.longBio;
        currentProfile.fullname=profile_data.fullname;
        currentProfile.make_user_info();
        
        console.log(currentProfile);
        let con=document.getElementsByClassName('container')[0];
        temp.get_list();
        let select=document.getElementById('selectTemplateInput');
        let templateLists=template_info_from_cookie();
        console.log('template list=====');
        console.log(templateLists);
        if(templateLists==false){
            return;
        }
        temp.templateList=templateLists.templateList;
        console.log('templateList========');
        console.log(templateLists.templateList);
        if(templateLists.templateList!==undefined){
            for(let t=0;t<temp.templateList.length;t++){
            let o=document.createElement('option');
            let oTxt=document.createTextNode(temp.templateList[t].filename);
            console.log(temp.templateList[t].filename);
            o.append(oTxt);
            select.append(o);
        }
        }
        
        document.getElementsByClassName('templateSelection')[0].style.display='block';
        document.getElementsByClassName('addTemplate')[0].style.display='block';
        temp.parentContainer=document.body;
        temp.selectTemplateInput=document.getElementById('selectTemplateInput');
        temp.selectTemplateInput.addEventListener('change',function(evt){
            let index=evt.target.selectedIndex;
            let value=evt.target.options[index].value;
            temp.selectedTemplate=value;
            temp.get_template_from_server();
        });
        temp.addTemplateBtn=document.getElementById('addTemplatefile');
        temp.addTemplateBtn.addEventListener('click',function(evt){
            temp.add_templateFile();
            // clear_template_list();
            temp.template_more_options();
            let updateBtns=document.getElementsByClassName('updateTemplate');
            let deleteBtns=document.getElementsByClassName('deleteTemplate');
            let hideBtns=document.getElementsByClassName('hideTemplate');
            let closeWin=document.getElementsByClassName('closeWindow')[0];
            closeWin.addEventListener('click',function(evt){
                let parentContaner=evt.target.parentNode;
                parentContaner.style.display='none';
            });
            for(let up=0;up<updateBtns.length;up++){
                updateBtns[up].addEventListener('click',function(evt){
                    console.log('updating tmpaltes');
                    let parent=evt.target.parentNode;
                    const updateContainer=parent.getElementsByClassName('templateFileHolder')[0];
                    updateContainer.style.display='block';
                    parent.getElementsByClassName('cancelUpdate')[0].addEventListener('click',function(evt){
                        updateContainer.style.display='none';
                    });
                    parent.getElementsByClassName('saveUpdate')[0].addEventListener('click',function(evt){
                        evt.preventDefault();
                        updateContainer.style.display='none';
                    });

                });
            }
            for(let db=0;db<deleteBtns.length;db++){
                deleteBtns[db].addEventListener('click',(evt)=>{
                    console.log('delete tmpaltes');
                    confirm('are you sure ');
                    try{
                        let xml=new XMLHttpRequest();
                        xml.open('POST','/profile');
                        xml.setRequestHeader('Content-type','x/application-form-urlencoded');
                        xml.send('action=deleteTemplate&templateName='+name);
                    }catch(err){
                        console.log(err);
                    }
                });
            }
            for(let hb=0;hb<hideBtns.length;hb++){
                hideBtns[hb].addEventListener('click',function(evt){
                    console.log('hhide tmpaltes');
                    const element=evt.target;

                    element.innerHTML='show Template';
                    element.className='showTemplate';
                    element.removeEventListener('click',this);
                    try{
                        let xml=new XMLHttpRequest();
                        xml.open('POST','/profile');
                        xml.setRequestHeader('Content-type','x/application-form-urlencoded');
                        xml.send('action=hideTemplate&templateName='+name);
                    }catch(err){
                        console.log(err);
                    }
                });
            }
            document.getElementById('templateModal').style.display='block';
            let sub=document.getElementById('submitTemplateFiles');
            sub.addEventListener('click',validateTemplateSubmission);
        });
    currentProfile.make_user_info();
    // console.log('posts==========');
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
        post.src=data.posts[p].img;
        post.make_post();
    }
    }
} 
    else{
       console.log('======other profile data');
       console.log(data);
        currentProfile=new OtherProfile();

       
        currentProfile.username=data.user[0].username;
        currentProfile.shortBio=data.user[0].shortBio;
        currentProfile.longBio=data.user[0].longBio;
        currentProfile.fullname=data.user[0].fullname;
        currentProfile.make_user_info();
        console.log(currentProfile);
        let parentContainer=document.getElementsByClassName("posts-section")[0];
        console.log('parentContainer=========');
        console.log(parentContainer);
        for(let p=0;p<data.posts.length;p++){
            let post=new PostUI();
            
            post.parentContainer=parentContainer;
            post.id=data.posts[p].postID;
            // post.src='/Image/Art.png';
            post.src=data.posts[p].img;
            post.populate_post();
            post.make_post();
        }

       
    }
}



function open_upload_window(evt){
    uploadPost.make_drop_drag_window();
    const uploadModal = document.getElementById('uploadModal').style.display='block';
  
}
function expandTrophies(){

}
async function followProfile(evt){
    // let btn=evt.target;
    let url=window.href;
    console.log(url);
    let follow=new Follow(myProfile,currentProfile);
    follow.sendFollow();
}
function unfollowProfile(evt){
    // let btn=evt.target;
    let url=window.href;
    console.log(url);
    let follow=new UnFollow(myProfile,currentProfile);
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
