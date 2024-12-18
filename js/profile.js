"strict"
import User from './user.js';
import StackedPostsUI from './stackPosts.js';
import {PostUI} from './post.js';
import {Follow,UnFollow} from './follow.js';
class Profile extends User{
    constructor(){
        super();
        this._type;
        this._shortBio='short bio info to be filled in';
        this._fullBio='full bio info';
    }
    set shortBio(i){
        this._shortBio=i;
    }
    get shortBio(){
        return this._shortBio;
    }
    set fullBio(i){
        this._fullBio=i;
    }
    get fullBio(){
        return this._fullBio;
    }
}
export class MakeProfile extends Profile{
     constructor(){
        super();
    }
}
class ProfileUI extends Profile{
    constructor(){
        super();
        this._posts;
    
        this._editProfile=false;
        this._deletePost=false;
        this._uploadPost=false;
        this._editPost=false;
        this._parentContainer;
        this._templates=[];
    }
    add_template(i){
        this._templates.push(i);
    }
    get templates(){
        return this._templates;
    }
    set parentContainer(i){
        this._parentContainer=i;
    }
    get parentContainer(){
        return this._parentContainer;
    }
    set posts(i){
        this._posts=i;
    }
    get posts(){
        return this._posts;
    }
    
    add_post(ps){
        this.posts.push(ps);
    }
    make_profilePic(){

    }
    make_bio(){}
    make_user_info(){
        document.getElementById('username').innerHTML=this.username;
        document.getElementById('shortBio').innerHTML=this.shortBio;
        // document.getElementById('profilePicture').innerHTML=this.profilePicture;
        // document.getElementById('longBio').innerHTML=this.longBio;
        // document.getElementById('fullname').innerHTML=this.fullname;
     

    }
 

 }
export class OtherProfile extends ProfileUI{
    constructor(){
        super();
        this._postsHtml=[];
        this._data;
        this._cont;
        this._bigcont;
        this._follow=new Follow();
        this._unfollow=new UnFollow();
        this._newPosts=0;
        this._followBtn;
        this._unfollowBtn;
        this._removeBtn;
        this._profilePicture;
        this._followingStatus;

        this._className;

       
    }
    set postsHtml(i){
        this._postsHtml=i;
    }
    get postsHtml(){
        return this._postsHtml;
    }
    set className(i){
        this._className=i;
    }
    get className(){
        return this._className;
    }
    set followingStatus(i){
        this._followingStatus=i;
    }
    get followingStatus(){
        return this._followingStatus;
    }
    set newPosts(i){
        this._newPosts=i;
    }
    get newPosts(){
        return this._newPosts;
    }
    set profilePicture(i){
        this._profilePicture=i;
    }
    get profilePicture(){
        return this._profilePicture;
    }
    set removeBtn(i){
        this._removeBtn=i;
    }
    get removeBtn(){
        return this._removeBtn;
    }
    set followBtn(i){
        this._followBtn=i;
    }
    get followBtn(){
        return this._followBtn;
    }
    set unfollowBtn(i){
        this._unfollowBtn=i;
    }
    get unfollowBtn(){
        return this._unfollowBtn;
    }
  
    get follow(){
        return this._follow;
    }
  
    get unfollow(){
        return this._unfollow;
    }
    set data(i){
        this._data=i;
    }
    get data(){
        return this._data;
    }
    set cont(i){
        this._cont=i;
    }
    get cont(){
        return this._cont;
    }
    set bigCont(i){
        this._bigcont=i;
    }
    get bigCont(){
        return this._bigcont;
    }
     make_posts(){
        if (this.data.posts.length>1) {
            this.posts=new StackedPostsUI();
            this.posts.parentContainer=this.cont;
            for(let s=0;s<this.data.posts.length;s++){
                this.posts.add_image=this.data.posts[s].src;
            }
          


        }
        this.posts=new PostUI();
        this.posts.parentContainer=this.cont;
        this.posts.image=this.data.posts.src;

    }
    makeChanges(){

        document.getElementById("uploadBtn").style.display='none';
        document.getElementById("settingsBtn").style.display='none';
        document.getElementById("editProfileButton").style.display='none';
        document.getElementById("uploadModal").style.display='none';
        document.getElementById("ReviewuploadModal").style.display='none';
        let modal=document.getElementsByClassName('modal');
        for(let i=0;i<modal.length;i++){
            console.log( modal[i]);
            modal[i].remove();
        }
        
    }
    make_container(){
        let cont=document.createElement('div');
        let profilePicBtn=document.createElement('a');
        let profilePic=document.createElement('img');
        let post=document.createElement('div');
        let contTwo=document.createElement('div');
        let contThree=document.createElement('div');
        let contFour=document.createElement('div');

        let account=document.createElement('div');
        let usernameCont=document.createElement('div');
        let username=document.createElement('h3');
        let usernameTxt=document.createTextNode(this.data.username);
        username.append(usernameTxt);
        usernameCont.append(username);
        

        

        let follow=document.createElement('button');
        let followTxt=document.createTextNode('follow');
        
        let unFollow=document.createElement('button');
        let unFollowTxt=document.createTextNode('unfollow');
        
        

        account.setAttribute('class','Account');
        usernameCont.setAttribute('class','Identity');
        follow.setAttribute('class','follow-button');
        unFollow.setAttribute('class','follow-button');
        
        profilePic.setAttribute('src',this.profilePicture);
        profilePic.setAttribute('class','profile-button-img');
        profilePicBtn.setAttribute('href','/@'+this.data.username);
        
        contTwo.setAttribute('class','post-actions');
        contThree.setAttribute('class','profile-button');
        contFour.setAttribute('class','post');

        
        let arrayPosts=['Primary-post','Secondary-post','Tertiary-post'];
        let arrayContainerPosts=['post-container-primary','post-container-secondary','post-container-teriary'];
        
        if(this.data.post!==undefined){
             cont.setAttribute('class','post-container-primary');
        }
        else if(this.data.posts.length==2){
            cont.setAttribute('class','post-container-secondary');
        }
        else{
            cont.setAttribute('class','post-container-teriary');
        }

       if(this.data.posts!==undefined){
             for(let ss=0;ss<this.data.posts.length;ss++){
                if(this.data.posts[ss]==null && this.data.posts[ss]==undefined){
                    continue;
                }
                let shareCont=document.createElement('div');
                let shareImage=document.createElement('img');
                let c=document.createElement('div');
                let img=document.createElement('img');
                let vid=document.createElement('video');
                let source=document.createElement('source');
               
                shareCont.setAttribute('class','share-button');
                shareImage.setAttribute('src','/Image/Share.png');
                c.setAttribute('class',arrayPosts[ss]);    
                c.setAttribute('id',this.data.posts[ss].postLink);    
                
                if(this.data.posts[ss]['imageFileName']!==undefined && this.data.posts[ss]['imageFileName']!==null){
                    img.setAttribute('src',this.data.posts[ss]['imageFilePath']+''+this.data.posts[ss]['imageFileName']);
                    img.setAttribute('class','post-image');
                    img.setAttribute('loading','lazy');
                    shareCont.append(shareImage);
                    c.append(shareCont);
                    c.append(img);
                    this.postsHtml.push(c);
                }
                else{
                    source.setAttribute('src',this.data.posts[ss]['videoFilePath']+''+this.data.posts[ss]['videoFileName']);
                    vid.setAttribute('class','post-image');
                    vid.setAttribute('loading','lazy');
                    vid.setAttribute('controls','true');
                    vid.append(source);
                    shareCont.append(shareImage);
                    c.append(shareCont);
                    c.append(vid);
                    this.postsHtml.push(c);
                }

                contFour.append(c);
        }
        }
        else if(this.data.post!==undefined || this.data.post!==null){
            if(this.data.post.videoFileName!==undefined){
                let shareCont=document.createElement('div');
                let shareImage=document.createElement('img');
                let contFive=document.createElement('div');
                let im=document.createElement('video');
                let source=document.createElement('source');

               
                source.setAttribute('src',this.data.post.videoFilePath+''+this.data.post.videoFileName);
                im.setAttribute('loading','lazy');
                contFive.setAttribute('class','Primary-post');
                contFive.setAttribute('id',this.data.post.postLink);
                shareCont.setAttribute('class','share-button');
                shareImage.setAttribute('src','/Image/Share.png');
                // im.setAttribute('controls','true');
                shareCont.append(shareImage);
                
                im.append(source);
                contFive.append(shareCont);
                contFive.append(im);
                this.postsHtml.push(contFive);

                contFour.append(contFive);
                // cont.append(contFour);
                // cont.append(contTwo);
                console.log('========container');
                console.log(cont);
            }else{

            let shareCont=document.createElement('div');
            let shareImage=document.createElement('img');
            let contFive=document.createElement('div');
            let im=document.createElement('img');
            im.setAttribute('src',this.data.post.imageFilePath+''+this.data.post.imageFileName);
            im.setAttribute('loading','lazy');
            contFive.setAttribute('class','Primary-post');
            contFive.setAttribute('id',this.data.post.postLink);
            shareCont.setAttribute('class','share-button');
            shareImage.setAttribute('src','/Image/Share.png');
            shareCont.append(shareImage);
            contFour.append(shareCont);
            contFive.append(im);
            this.postsHtml.push(contFive)
            contFour.append(contFive);
            
        }
        }
        else{

        }
            // this.parentContainer.append(cont);
        profilePicBtn.append(profilePic);
        let currentFollowing;
        if(this.data.following==true){
            unFollow.append(unFollowTxt);
            this.unfollowBtn=unFollow;
            currentFollowing=unFollow;
            
        }
        else{
            follow.append(followTxt);
            this.followBtn=follow;
            currentFollowing=follow;
        }
        
        

        account.append(profilePicBtn);
        account.append(usernameCont);
        contThree.append(account);
        contThree.append(currentFollowing);
        contTwo.append(contThree);
       
        cont.append(contTwo);
        cont.append(contFour);
        console.log(' ======cont======');
        console.log(cont);
        this.bigCont=cont;
        this.parentContainer.append(cont);
    }
    make_small_container(){
        let cont=document.createElement('div');
        let userInfo=document.createElement('div');
        let usernameTxt=document.createTextNode(this.username);
        let username=document.createElement('h3');
        let postsNo=document.createElement('p');
        let postsNoTxt=document.createTextNode(this.newPosts+' new posts');
        let profilePictureLink=document.createElement('a');
        let profilePicture=document.createElement('img');

        let unfollowBtn=document.createElement('button');
        let followBtn=document.createElement('button');
        let unfollowBtnTxt=document.createTextNode('unfollow');
        let followBtnTxt=document.createTextNode('follow');


        let removeBtn=document.createElement('span');
        removeBtn.innerHTML='&times';
        let removeBtnTxt=document.createTextNode('');

        cont.setAttribute('id',this.id);
        userInfo.setAttribute('class','user-info');
        cont.setAttribute('class','profile-item');
        username.setAttribute('class','user-name-p');
        postsNo.setAttribute('class','post-count');
        profilePictureLink.setAttribute('href','/@'+this.username);
        profilePicture.setAttribute('class','user-icon-p');
        profilePicture.setAttribute('src',this.src);
        followBtn.setAttribute('class','follow-btn');
        removeBtn.setAttribute('class','close-icon');

        username.append(usernameTxt);
        postsNo.append(postsNoTxt);
        profilePictureLink.append(profilePicture);
        unfollowBtn.append(unfollowBtnTxt);
        followBtn.append(followBtnTxt);
        removeBtn.append(removeBtnTxt);

       

        cont.append(profilePictureLink);
        if(this.className=='profile-item'){
            userInfo.append(username);
            userInfo.append(postsNo);
            cont.append(userInfo);
        }
        else{
            cont.append(username);
            cont.append(followBtn);
            this.followBtn=followBtn;
        }
        
        
        if(this.followingStatus==false){
            cont.append(followBtn);
            this.followBtn=followBtn;
        }
        
      
        cont.append(removeBtn);
        this.profilePicture=profilePicture;
        this.cont=cont;

        this.removeBtn=removeBtn;
        
        
        return cont;

    }
    remove_profile(evt){
        try{
        
            let xml=new XMLHttpRequest();
            xml.open('POST','/search_page');
            xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xml.onload=function(){
              
                    console.log('====== server response====');
                    console.log(this.responseText);
                    let data=JSON.parse(this.responseText);
                    if(data.status=='failed'){
                        alert(data.message);
                    }
                    if(data.status=='success'){
                         const element=evt.target.parentNode;
                        element.remove();
                        this.username=data.data.username;
                        this.profilePicture=data.data.profilePicture;
                        this.followingStatus=data.data.followingStatus;
                        this.id=data.data.userID;
                     
                    }
                    
                
            }
            xml.send('actions=remove_profile&userID='+this.id+'&username='+this.username);
            
        }catch(err){
            console.log('error');
        }
       

    }
    remove_popular_profile(evt){
        console.log('=====remvoe popular');

     
        try{
            let xml=new XMLHttpRequest();
            xml.open('POST','/search_page');
            xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xml.onload=function(){
   
                  console.log('====== server response====');
                   let data=JSON.parse(this.responseText);
                    if(data.status=='failed'){
                        alert(data.message);
                    }
                    if(data.status=='success'){
                        const element=evt.target.parentNode;
                        element.remove();
                        this.useraname=data.data.username;
                        this.profilePicture=data.data.profilePicture;
                        this.followingStatus=data.data.followingStatus;
                        this.id=data.data.username;
                        this.make_small_container();
                    }
                    
                
            }
            xml.send('actions=remove_popular_profile');
        
        }catch(err){
            console.log('error');
        }
       

    }
    follow_user(evt){
        try{
           
            let xml=new XMLHttpRequest();
            xml.open('POST','/search_page');
            xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xml.onload=function(){
               
                     console.log('====== server response====');
                    let data=JSON.parse(this.responseText);
                    if(data.status=='failed'){
                        alert(data.message);
                    }
                    if(data.status=='success'){
                        this.followingStatus=data.data.followingStatus;
                    }
             
                
            }
            xml.send('actions=follow');
            
        }catch(err){
            console.log('error');
        }
    }
    follow_recommended_user(evt){
        try{
           
            let xml=new XMLHttpRequest();
            xml.open('POST','/search_page');
            xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xml.onload=function(){
               
                     console.log('====== server response====');
                    let data=JSON.parse(this.responseText);
                    if(data.status=='failed'){
                        alert(data.message);
                    }
                    if(data.status=='success'){
                         const element=evt.target.parentNode;
                        element.remove();
                        
                        this.useraname=data.data.username;
                        this.profilePicture=data.data.profilePicture;
                        this.followingStatus=data.data.followingStatus;
                        this.id=data.data.username;
                        this.make_small_container();
                    }
             
                
            }
            xml.send('actions=follow');
            
        }catch(err){
            console.log('error');
        }
    }
    lazy_loading(){
        const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
        if (entry.isIntersecting) {
              const image = entry.target;
              image.src = image.dataset.src;
              observer.unobserve(image);
                }
            });
        }, {
          threshold: 0.5, // Load image when 50% of it is visible
        });

        // Get all images with data-src attribute
        const images = document.querySelectorAll('img[data-src]');

        // Observe each image
        images.forEach((image) => {
            observer.observe(image);
        });
            }
}
export class MyProfile extends ProfileUI{
    constructor(){
        super();
        this._editProfile=true;
        this._deletePost=true;
        this._uploadPost=true;
        this._editPost=true;
        this._showSettings=true;
        this._showProfile;
        this._analytics;
        this._registrationBtn=document.getElementById('userRegistration');
        this._data;
        this._setupProfileModal=document.getElementById('profileSetupModal');
        
    }
    is_logged_in(){
            document.getElementById('followBtn').style.display='none';
            
    }
      
            
    set registrationBtn(i){
       this._registrationBtn=i;
    }
    get registrationBtn(){
       return this._registrationBtn;
    }
    set setupProfileModal(i){
       this._setupProfileModal=i;
    }
    get setupProfileModal(){
       return this._setupProfileModal;
    }
    setup_profile(){
        this.setupProfileModal.style.display='block';
    }
    set data(i){
        this._data=i;
    }
    get data(){
        return this._data;
    }
    make_posts(){
        if (this.data.posts.length>1) {
            this.posts=new StackedPostsUI();
            for(let s=0;s<this.data.posts.length;s++){
                this.posts.images=this.data.posts[s].src;
            }
            this.posts.make_stack();
            return this.posts.cont;

        }
        this.posts=new PostUI();
        this.posts.image=this.data.posts.src;
        this.posts.make_post();
        return this.posts.cont;
    }
    submit_profile_info(){
        try{
            let xml=new XMLHttpRequest();
            xml.open('POST','/setup_profile');
            xml.setRequestHeader('Content-Type', 'application/json');
            xml.onload=()=>{
                console.log('======== setup page');
                let data=JSON.parse(this.responseText);
                if(data!==false || data!==undefined){
                    if(data.status=='success'){
                        alert('it works');
                        user.setupProfileModal.style.display='none';
                        user.registrationBtn.style.display='none';
                        return;
                    }
                    
                    console.log(data);
                    for(let e=0;e<data.errors.length;e++){
                        let k=Object.keys(data.errors[e]);
                  
                        document.getElementById(k).innerHTML=data.errors[e][k];
                    }
                }
            }
            xml.send(JSON.stringify(this.data));
        }catch(err){
            console.log(err)
        }

    }
    makeChanges(){

        document.getElementById("uploadBtn").style.display='block';
        document.getElementById("settingsBtn").style.display='block';
        // document.getElementById("uploadModal").style.display='none';
        // document.getElementById("ReviewuploadModal").style.display='none';
        // let modal=document.getElementsByClassName('modal');
        // for(let i=0;i<modal.length;i++){
        //     console.log( modal[i]);
        //     modal[i].remove();
        // }

        
    }
    is_logged_in_homepage(){
        let reg=document.getElementById('userRegistration');
        reg.style.display='none';
        let link=document.createElement('a');
        let profilePic=document.createElement('img');
        link.setAttribute('href','/profile');
        profilePic.setAttribute('src','/Image/Test Account.png');
        profilePic.setAttribute('class','');
        console.log('========works=====');
        console.log(profilePic);
        link.append(profilePic);
        document.getElementsByClassName('nav-right')[0].append(link);
    }
    


}
class AdminProfile extends MyProfile{
    constructor(){
        super();
        this._uploadTemplates=true;
        this._removeTemplates=true;
        this._hideTemplates=true;
        this._showTemplates=true;
    }

}


