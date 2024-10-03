"strict"
import User from './user.js';
import StackedPostsUI from './stackPosts.js';
import PostUI from './post.js';
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
        document.getElementById('profilePicture').innerHTML=this.profilePicture;
        document.getElementById('longBio').innerHTML=this.longBio;
        document.getElementById('fullname').innerHTML=this.fullname;
        // document.getElementById('fullBio').innerHTML=this.fullBio;

        // document.getElementById('userBio').textContent=info.bio;
        // document.getElementById('userProfilePicture').src=pic;
    }
 

 }
export class OtherProfile extends ProfileUI{
    constructor(){
        super();
        this.posts;
        this._data;
        this._cont;
       
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
        let contFive=document.createElement('div');
        let contSix=document.createElement('div');
        let contSeven=document.createElement('div');
        let contEight=document.createElement('div');

        profilePicBtn.setAttribute('class','profile-button');
        profilePic.setAttribute('src',this.profilePicture);
        cont.setAttribute('class','post-container');
        contTwo.setAttribute('class','post-actions');
        contThree.setAttribute('class','profile-button');
        contFour.setAttribute('class','post');

        let arrayPosts=['top-post','middle-post','bottom-post'];
        if(this.data.posts!==undefined){
             for(let ss=0;ss<this.data.posts.length;ss++){
                let c=document.createElement('div');
                let img=document.createElement('img');
                c.setAttribute('class',arrayPosts[ss]);    
                img.setAttribute('src',this.data.posts[ss].src);
                c.append(img);
                contFour.append(c);
        }
        }
       

        // if(this.data.posts.length>1){
        //     let img=document.createElement('img');
        //     contSix.setAttribute('class','top-post');    
        //     console.log('=======test =======');
        //     console.log(this.data.posts);
        //     img.setAttribute('src',this.data.posts[0].src);
        //     contSix.append(img);
        //     contFour.append(contSix);
        //   }  
        // if(this.data.posts.length>2){
        //     let imgTwo=document.createElement('img');
        //     imgTwo.setAttribute('src',this.data.posts[1].src);
        //     contSeven.setAttribute('class','middle-post');
        //     contSeven.append(imgTwo);
        //     contFour.append(contSeven);
        // }
        // if(this.data.posts.length==3){
        //     let imgThree=document.createElement('img');
        //     contEight.setAttribute('class','bottom-post');
        //     contEight.append(imgThree);
        //     imgThree.setAttribute('src',this.data.posts[2].src);
        //     contFour.append(contEight);
        // }
        else{
            profilePicBtn.append(profilePic);
            contTwo.append(profilePicBtn);
            contFour.append(contFive);
            let im=document.createElement('img');
            im.setAttribute('src',this.data.posts.src);
            cont.append(contFour);
            cont.append(contTwo);
            contFive.setAttribute('class','single-post');
            console.log('========container');
            console.log(cont);
            this.parentContainer.append(cont);
   
        }

        profilePicBtn.append(profilePic);
        contTwo.append(profilePicBtn);
        cont.append(contTwo);
        cont.append(contFour);
        this.parentContainer.append(cont);
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
            xml.readystatechange=function(){
                console.log('======== setup page');
                console.log(this.responseText);
                if(d!==false || d!==undefined){
                    if(d.status==='success'){
                        alert('it works');
                        user.setupProfileModal.style.display='none';
                        user.registrationBtn.style.display='none';
                        return;
                    }
                    console.log(d);
                    for(let e=0;e<d.errors.length;e++){
                        let k=Object.keys(d.errors[e]);
                  
                        document.getElementById(k).innerHTML=d.errors[e][k];
                    }
                }
            }
            xml.send(JSON.stringify(this.data));
        }catch(err){
            console.log(err)
        }

    }
    hide_registration_btn(){
        let reg=document.getElementById('userRegistration');
        reg.style.display='none';
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


