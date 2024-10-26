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
        this._posts=[];
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
      
        this._data;
        this._cont;
        this._follow=new Follow();
        this._unfollow=new UnFollow();

        this._followBtn;
        this._unfollowBtn;

       
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
        let profilePicBtn=document.createElement('div');
        let profilePic=document.createElement('img');
        let post=document.createElement('div');
        let contTwo=document.createElement('div');
        let contThree=document.createElement('div');
        let contFour=document.createElement('div');


        

        let follow=document.createElement('button');
        let followTxt=document.createTextNode('follow');
        
        let unFollow=document.createElement('button');
        let unFollowTxt=document.createTextNode('unfollow');
        
        

        follow.setAttribute('class','follow-button');
        unFollow.setAttribute('class','follow-button');
        profilePicBtn.setAttribute('class','profile-button-img');
        profilePic.setAttribute('src',this.profilePicture);
        
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
                if(this.data.posts[ss]==null){
                    continue;
                }
                let shareCont=document.createElement('div');
                let shareImage=document.createElement('img');
                let c=document.createElement('div');
                let img=document.createElement('img');
                let vid=document.createElement('video');
               
                shareCont.setAttribute('class','share-button');
                shareImage.setAttribute('src','/Image/Share.png');
                c.setAttribute('class',arrayPosts[ss]);    
                // img.setAttribute('src',this.data.posts[ss].imageFileName+''+this.data.posts[ss].imageFileName);
                console.log(this.data.posts[ss]);
                const k=Object.keys(this.data.posts[ss]);
                console.log(k[0]);
                console.log(k[1]);
                console.log(this.data.posts[ss][k]);
                if(k[0]=='imageFileName' &&  k[1]=='imageFilePath'){
                    img.setAttribute('src',this.data.posts[ss].imageFilePath+''+this.data.posts[ss].imageFileName);
                    img.setAttribute('class','post-image');
                    img.setAttribute('loading','lazy');
                    img.setAttribute('controls','true');
                    img.setAttribute('width','90%');
                    img.setAttribute('height','75%');
                
                    c.append(img);
                }
                else{
                    console.log(k);
                    vid.setAttribute('src',this.data.posts[ss].videoFilePath+''+this.data.posts[ss].VideoFileName);
                    vid.setAttribute('class','post-image');
                    vid.setAttribute('loading','lazy');
                    vid.style.width='20em';
                    vid.setAttribute('controll','true');
                    c.append(vid);
                }
                
                
                shareCont.append(shareImage);
                c.append(shareCont);
                contFour.append(c);
        }
        }
        else if(this.data.post!==undefined || this.data.post!==null){
            if(this.data.post.VideoFileName!==undefined){
                let shareCont=document.createElement('div');
                let shareImage=document.createElement('img');
                let contFive=document.createElement('div');
                let im=document.createElement('video');

                if (this.data.post.imageFilePath!==null) {
                    im.setAttribute('src',this.data.post.videoFilePath+''+this.data.post.VideoFileName);
                    im.setAttribute('loading','lazy');
                }
                
                contFive.setAttribute('class','Primary-post');
                shareCont.setAttribute('class','share-button');
                shareImage.setAttribute('src','/Image/Share.png');
                im.setAttribute('controls','true');
                im.setAttribute('width','90%');
                im.setAttribute('height','75%');
                
                shareCont.append(shareImage);
                contFive.append(shareCont);
                contFive.append(im);
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

            if (this.data.post.imageFilePath!==null) {
                im.setAttribute('src',this.data.post.imageFilePath+''+this.data.post.imageFileName);
                im.setAttribute('loading','lazy');
            }
            
            contFive.setAttribute('class','Primary-post');
            shareCont.setAttribute('class','share-button');
            shareImage.setAttribute('src','/Image/Share.png');
            shareCont.append(shareImage);
            contFive.append(shareCont);
            contFive.append(im);
            contFour.append(contFive);
            // cont.append(contFour);
            // cont.append(contTwo);
            
            console.log('========container');
            console.log(cont);
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
        
        

        contThree.append(profilePicBtn);
        contThree.append(currentFollowing);
        contTwo.append(contThree);
       
        cont.append(contTwo);
        cont.append(contFour);
        console.log(' ======cont======');
        console.log(cont);
        this.parentContainer.append(cont);
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
        // document.getElementById("editProfileButton").style.display='none';
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


