"strict"
import {MyProfile,OtherProfile} from './profile.js';
import {PostUI} from './post.js';
import StackedPosts from './stackPosts.js';
import RegistrationUI from './registration.js';
import LoginUI from './login.js';
import TemplatePicker from './templateMain.js';
import {Follow,UnFollow} from './follow.js';
import VideoUI from './video.js';

import {MobileGallery,DesktopGallery} from './imageGallery.js';

let user=new MyProfile();
let allData;
let profileList=[];
let registrationForm=new RegistrationUI();
let temp=new TemplatePicker();

// temp.events_handler();
// temp.get_templates();
// let video=new VideoUI();
// video.make_form_submission();
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function delete_cookie(name){
    document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
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
function post_preview(){
    console.log('====== workinh=====');
    let status=get_cookie('postPreview=');
    if(status!==undefined){
        alert('previwing post now');
         let postTitle='happy';
        console.log(evt.target);
        let data=status.data;
        delete_cookie('postPreview');
        source=data.img;
        let source=evt.target.src;
        let postImageSrc=evt.target.src;
        const patttern=/(.mp4)/;
       

        const modal = document.getElementById("postModal");
        const modalPostImage = document.getElementById("modalPostImage");
        let cont=evt.target.parentNode.parentNode.parentNode;
        let profile=cont.getElementsByClassName("profile-button")[0];
      
        if(patttern.test(source)){
            let video=document.createElement('video');
            video.setAttribute('src',source);
            modal.append(video);
            modal.style.display = "block";
        }
        else{
            modalPostImage.src = postImageSrc;
            modal.style.display = "block";
        }
        
        document.getElementById("closeModal").addEventListener('click',closeModal);

    }
    else{
        return;
    }
}
post_preview();
function get_ish_form_cookie(){
    let profilesObjs=get_cookie("users=");
    let user_data=get_cookie("user=");
    if(profilesObjs==undefined){
        console.log('no posts ');
    }else{
        initialiseObjects(profilesObjs);
    }
        
    }
    // init_categories(dtt.categories);

function get_registration_info_from_cookie(){
    let registration=get_cookie('registration=');
    if(registration!==undefined && registration!==false){
        return registration;
  
    }
    return false;
}
function get_profile_setup_info_from_cookie(){
    let profileSetUp=get_cookie('setUpProfile=');
    if(profileSetUp!==undefined && profileSetUp!==false){
        delete_cookie('setUpProfile');
        return profileSetUp;
    }
    return profileSetUp;
}
function get_username_search_results_info_from_cookie(){
    let usernames=get_cookie('usernameSearchResults=');
    console.log(usernames);
    if(usernames!==undefined && usernames!==false){
        console.log('----usernames results-------');
        delete_cookie('usernameSearchResults');
        console.log(usernames);
        return usernames;
    }
    return false;
}
function getDonationStatus(){
    let stat=get_cookie('donationStatus=');
    if(stat!==undefined){
        alert(stat.message);
        delete_cookie('donationStatus');
    }
}
getDonationStatus();
function clear_posts(){
    let postOne=document.getElementsByClassName('post-container-primary');
    let postTwo=document.getElementsByClassName('post-container-secondary');
    let postThree=document.getElementsByClassName('post-container-teriary');
    let len=postOne.length;
    let lenTwo=postTwo.length;
    let lenThree=postThree.length;
    let i=0;
    while(i<len){
        postOne[i].remove();
        postTwo[i].remove();
        postThree[i].remove();
        i++;
    }

}

window.addEventListener('error',function(error){
    console.log(error);
    console.log(error.error.message);
    const t=new Date();
    const time=t.getTime();
    const date=t.getDate();
    const id=0;
    const browser=navigator.userAgent;
 
    try{
        let xml=new XMLHttpRequest();
        xml.open('POST','/log');
        xml.setRequestHeader('Content-Type','application/json');
        let item={
            message:error.error.message,
            stack:error.error.stack,
            filename:error.filename,
            stack:error.error.srcElement,
            stack:error.timeStamp,
            lineno:error.lineno,
            date:date,
            time:time,
            userID:id,
            device:browser
       
        };
        xml.send(JSON.stringify(item));
        xml.onload=function(){
            console.log('succesfull sent====');
            console.log(this.responseText);
        }
        console.log('sent error log to server');
    }catch(err){
        console.log(err);
    }
    
});

function initialisePersoalObejct(){
    const cookie_user=get_cookie('user=');
     if(cookie_user!==undefined){
        user.username=cookie_user.username;
        user.fullName=cookie_user.fullname;
        user.bio=cookie_user.bio;
        user.is_logged_in_homepage();
       
    }
}
initialisePersoalObejct();
function initialiseObjects(cookie_data){
   let parentCont=document.getElementsByClassName("postfeed-wrapper")[0];
   if(cookie_data!==undefined){
        // if(cookie_data.status=='failed'){
        //     let p=document.createElement('h1');
        //     let pTxt=document.createTextNode('No new Posts');
        //     p.append(pTxt);
        //     parentCont.append(p);

        //     return;
        // }
        
        for(let i=0;i<cookie_data.length;i++){
            console.log('=======array loop enternder');
            let profileItem=new OtherProfile();
            let gallery=new DesktopGallery();
            let mgallery=new MobileGallery();

            profileItem.id=cookie_data[i].id;
            profileItem.username=cookie_data.username;
            profileItem.firstName=cookie_data[i].firstName;
            profileItem.lastName=cookie_data[i].lastName;
            profileItem.fullname=cookie_data[i].fullname;
            profileItem.profilePicture=cookie_data[i].profilePicture;
            profileItem.data=cookie_data[i];
            profileItem.parentContainer=parentCont;
            profileItem.posts=cookie_data[i].posts;
           // profileItem.make_container();
            // profileItem.make_posts();
            // profileItem.make_profilePic();
            profileItem.make_container();
       
          
            for(let p=0;p<profileItem.postsHtml.length;p++){
                console.log('====== posts =====');
                console.log(profileItem.postsHtml[p]);
                profileItem.postsHtml[p].addEventListener('click',openModal);
            }
            console.log('=====test=====');
            console.log(profileItem.cont);
            // gallery.bigCont=profileItem.bigCont;
            // gallery.create_gallery();
            // gallery.eventHandling();


            mgallery.bigCont=profileItem.bigCont;
            // mgallery.create_gallery();
            mgallery.eventHandling();

            console.log('++++++= following +++++++');
            console.log(cookie_data[i].following);
            profileItem.unfollow.influencer=profileItem.id;
            if(cookie_data[i].following==true){
                profileItem.unfollow.btn=profileItem.unfollowBtn;
                console.log(profileItem.unfollowBtn);
                console.log(profileItem.unfollow.btn);
                profileItem.unfollow.btn.addEventListener('click',function(evt){
                    console.log('unfollow');
                    profileItem.unfollow.sendUnFollowHomePage(evt);

                });
            }else{
                profileItem.follow.influencer=profileItem.id;
                profileItem.follow.btn=profileItem.followBtn;
                profileItem.follow.btn.addEventListener('click',function(evt){
                    profileItem.follow.sendFollowHomePage(evt);
                });
            }
         
            
            
            // parentCont.append(profileItem.cont);
            profileList.push(profileItem);

    }
    console.log(profileList);
   }

    
}



function clear_search_results(){
    let list=document.getElementById('suggestion-list');
    for(let l=0;l<list.childNodes.length;l++){
        list.childNodes[l].remove();
    }
}
// this function get called when user entres text on the search box it then takes the text to the serve
// and preforms a search of matchin words on the database of usernames
function search_user(){
    let text=document.getElementById("search").value;
    let list=document.getElementById('suggestion-list');
    
    console.log(text);
    
    try{
        let xml=new XMLHttpRequest();
        xml.open('POST','/');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("action=search&q="+text);
        let searchData=get_username_search_results_info_from_cookie();
        if(searchData.status=='success'){
        list.style.display='block';
        list.innerHTML='';
        console.log('works');
        clear_search_results();
        let len=searchData.Results.length;

        for(let i=0;i<len;i++){
            const l=document.createElement('li');
            l.setAttribute('class','searchItem');
            l.textContent=searchData.Results[i].username;
            list.appendChild(l);
            console.log(searchData.Results[i]);

        }
        let listItem=document.getElementsByClassName('searchItem');
        for(let i=0;i<listItem.length;i++){
            listItem[i].addEventListener("click",function(evt){
                console.log("works=======");
                console.log(evt.target.innerHTML);
                window.location.href="/@"+evt.target.innerHTML;

            });

        }
        }
        
        
    }catch(err){
        console.log(err);
    }
    document.addEventListener('click',function(evt){
        if(evt.target.className!=='searchItem'){
            list.style.display='none';
        }
        
    });
    // document.getElementById("search").addEventListener("focusout",()=>{
    //     list.style.display='none';
        
    // });
}
function clear_error_messages(){
    document.getElementById("errPassword").innerHTML='';
    document.getElementById("errName").innerHTML='';
    document.getElementById("errLastName").innerHTML='';
    document.getElementById("errEmail").innerHTML='';
}
// this function direct the user to a users profile when a user account is selected
function openUserProfile(evt){
    let username=evt.target.parentNode;
    console.log(username);
    console.log(username.id);
    window.location.href=username.id;
}

function select_post(evt){
   let link=evt.target.id;
   window.loaction.href=link;
}

/*

this function is called when a user presses the share button on a post 

*/
async function shareModalPost(evt){
    let postElement=evt.target.parentNode.parentNode;
   
    const urlText=location.href+postElement.id;
    const testShareData={
        url:urlText,
    };
    try{
        await navigator.share(testShareData);
        alert('ok');
    }catch(err){
        console.log('could not share');
    }
}
// this function listens to all events that take place ont the site and handles them
function eventListeners(){
    let userProfile=document.getElementsByClassName("profile-button-img");
    let search_input=document.getElementById("search");
    let sharePost=document.getElementsByClassName('share-button');
    
    let viewMore=document.getElementsByClassName("view-more-btn")[0];
    let registerBtn = document.getElementById('userRegistration');
    let closeReg = document.getElementById("closeModalReg");
    let donate=document.getElementById('donateBtn');
    let mobileDonate=document.getElementById('mobileDonateBtn');
    let openDonation=document.getElementById('openDonationModal');
    let modal = document.getElementById("registerModal");

    openDonation.addEventListener('click',function(evt){
        let mobileDonationForm=document.getElementById('donation-modal');
        mobileDonationForm.style.display='block';
        mobileDonate.addEventListener('click',function(evt){
        let dform=mobileDonationForm.getElementsByClassName('donationForm')[0];
       
        if(dform.style.display=='none'){
            dform.style.display='block';

        }else{
            dform.style.display='none';
        }
        console.log(dform.style.display);
    });
        let closeDonationModal=mobileDonationForm.getElementsByClassName('close-icon')[0];
        closeDonationModal.addEventListener('click',function(evt){
           mobileDonationForm.style.display='none';
        });
     });
   
    //this will check if user is at the end of the html page
    // if so it will trigger the conditional code
    if(profileList.length<5){
        let p=document.createElement('h3');
        let pTxt=document.createTextNode('no new posts');
        p.append(pTxt);
        document.getElementsByClassName('postfeed-wrapper')[0].append(p);


    }else if(profileList.length==5){
        try{
            let xml=new XMLHttpRequest();
            xml.open('GET','/');
            xml.send();

        }catch(err){
            console.log('working');
        }
        window.addEventListener('scroll',function(evt){
            const scrolledToBottom = window.innerHeight + window.scrollY >= document.body.offsetHeight;
            if(scrolledToBottom){
            get_ish_form_cookie();

        
    }else{
        
    }
    });
    
    }
   

    if(document.getElementById('donation')!==undefined && document.getElementById('donation')!==null){
        const donation=document.getElementById('donation');
        donation.addEventListener('click',function(evt){
             document.getElementById('donationModal').style.display='block';
             const closeModal=donation.getElementsByClassName('close-icon')[0];
             closeModal.addEventListener('click',function(evt){
             document.getElementById('donationModal').style.display='none';
            });
        });
    }
    
    

    if(document.getElementById('donateBtn')!==undefined && document.getElementById('donateBtn')!==undefined){
        donate.addEventListener('click',function(evt){
        let dform=document.getElementsByClassName('donationForm')[0];
       
        if(dform.style.display=='none'){
            dform.style.display='block';

        }else{
            dform.style.display='none';
        }
        console.log(dform.style.display);
    });
    }

   
    for(let sp=0;sp<sharePost.length;sp++){
        sharePost[sp].addEventListener('click',async(evt)=>{
            evt.stopPropagation();
            shareModalPost(evt);
            });
    }
    

    search_input.addEventListener("input",search_user);
   
 
    registerBtn.addEventListener('click',function(evt) {
        modal.style.display = "block";
        let login =document.getElementById('openLoginModal');

        login.addEventListener('click',function(evt){
            document.getElementById('registerModal').style.display='none';
            document.getElementById('LoginModal').style.display='block';
            });

        let close=document.getElementById('closeLoginModal');
        close.addEventListener('click',function(evt){
            document.getElementById('LoginModal').style.display='none';
        });
    
        // registrationForm.submissionBtn.addEventListener('click',function(evt){
        //     evt.preventDefault();
        //     clear_error_messages();
        //     registrationForm.form_submitted=evt;
        // });
      });

    closeReg.addEventListener('click',function(evt) {
        modal.style.display = "none";
    });
  
}
function checkoutStatus(){
    let status=get_cookie('checkoutStatus=');
    if(status!==undefined){
        alert(status.message);
        delete_cookie('checkoutStatus');
        return status;
    }
    return false;
}
checkoutStatus();

get_ish_form_cookie();
eventListeners();


function openModal(evt) {
    evt.stopPropagation();
    let media=document.getElementsByClassName('modal-image-content');
    let maxLen=media.length;
    for(let mc=0;mc<maxLen;mc++){
        media[mc].remove();
    }


    let mediaType='video';
  
    console.log('====== opening modal =====');

    let postTitle='happy';
    const element=evt.target;
    console.log(element);
    
    if(element.src!==undefined && element.src!==null && element.src!==''){
        mediaType='image';
        console.log(evt.target.src);
   }
    else{
        // (element.getElementsByTagName('source')[0]!==undefined){
        // element.getElementsByTagName('source')[0].src;
        console.log('===== a ok');
        console.log(element.getElementsByTagName('source')[0].src);
        mediaType='video';
    }
    const source=evt.target.src;
    let postImageSrc=evt.target.src;
    const patttern=/(.png|.gif|.jpeg|.jpg)/;
   

    const modal = document.getElementById("postModal");
    const modalPostImage = document.getElementById("modalPostImage");
    const cont=document.getElementById('modalContainerHolder');
  
    modal.style.display = "block";
    if(mediaType=='video'){
        const videoSource= element.getElementsByTagName('source')[0].src;
        let video=document.createElement('video');
        let sourceElement=document.createElement('source');
        sourceElement.setAttribute('src',videoSource);
        video.setAttribute('controls',true);
        video.setAttribute('class','modal-image-content');
        video.append(sourceElement);
        cont.append(video);
        console.log(element);
        console.log('=====display video');
    }
    else{
        let image=document.createElement('img');
        image.setAttribute('src',source);
        image.setAttribute('class','modal-image-content');
        cont.append(image);
        console.log(element);
        console.log('=====display image');
   
    }
    
    document.getElementById("closeModal").addEventListener('click',closeModal);
}

function handleLogginIn(){
    let status=get_cookie('LoggingInStatus=');
    if(status!==undefined){
        if(status.status=='success'){
            
             document.getElementById('LoginModal').style.display='none';
             delete_cookie('LoggingInStatus');
             //delete cookie
             //hide login form
             // hide registration btn
             // show profile icon 

             return;
         }
         if(status.status=='failed'){
            document.getElementById('LoginModal').style.display='block';
           
                console.log('===========something=========');
                console.log(status);
                let max=status.errors.length;
               
                    for(let i=0;i<max;i++){
                        const key=Object.keys(status.errors[i]);
                        console.log('data======');
                        console.log(key[0]);
                        console.log(status.errors[i][key]);
                        document.getElementById(key[0]).innerHTML=status.errors[i][key];
                    
                
            }
           
         }
    }
    delete_cookie('LoggingInStatus');
}
handleLogginIn();
function closeModal() {
    history.replaceState(null, null, '/');
    const modal = document.getElementById("postModal");
    modal.style.display = "none";
}

// validate setup profile status
let dataTwo=get_cookie('setupProfileStatus=');
if(dataTwo!==undefined){
    if(dataTwo.status=='failed'){
    user.setupProfileModal.style.display='block';
    user.registrationBtn.style.display='block';
    console.log(dataTwo);
    for(let e=0;e<dataTwo.errors.length;e++){
        console.log('creating tags');
        let k=Object.keys(dataTwo.errors[e]);
        console.log(k);
        console.log(dataTwo.errors[e][k]);
        document.getElementById(k).innerHTML=dataTwo.errors[e][k];
    }
    }
    else{
      
       
    } 
}
                              

// Form submission
document.getElementById("registerForm").onsubmit=formHandling;
async function formHandling(evt){
    console.log('working');
    let modal=document.getElementById('registerModal');
    evt.preventDefault();
    clear_error_messages();


    // let form=document.getElementById("registerForm");
    // let formData=new FormData(document.getElementById("registerForm"));
    let item={
        name:document.getElementById('registrationName').value,
        lastName:document.getElementById('registrationSurname').value,
        password:document.getElementById('registrationPassword').value,
        email:document.getElementById('registrationEmail').value
    };
  
    item=JSON.stringify(item);
    try{
        
        let xm=new XMLHttpRequest();
        xm.open('POST','/registration');
        xm.setRequestHeader('Content-Type', 'application/json');

        xm.onreadystatechange=function(){
            
            if(this.readyState==4){
               console.log('========return data');
               console.log(this.responseText);
               let data=JSON.parse(this.responseText);
                if(data.status=='failed'){
                     for(let i=0;i<data.errorArray.length;i++){
                        const k=Object.keys(data.errorArray[i]);
                        console.log(k);
                        console.log(data.errorArray[i][k]);
                        document.getElementById(k).innerHTML=data.errorArray[i][k];
                    }
                }
            else{
                
                modal.style.display='none';
                user.setup_profile();
            }
           
            document.getElementById('submitProfileSetup').addEventListener('click',function(evt){
                evt.preventDefault();
                let profileItem={
                    username:document.getElementById('profileName').value,
                    gender:document.getElementById('gender').value,
                    bio:document.getElementById('biography').value,
                    occupation:document.getElementById('occupation').value
                };
                if(profileItem.username!==null  &&
                    profileItem.gender!==null && profileItem.occupation!==null){
                    document.getElementById('profileSetupForm').submit();
                }
                

            });
        }

        }
    
        xm.send(item);
}
catch(err){
        console.log(err);
    }
}
