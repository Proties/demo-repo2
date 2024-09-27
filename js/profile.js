"strict"
import User from './user.js';
import StackedPosts from './stackPosts.js';
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
        // document.getElementById('fullBio').innerHTML=this.fullBio;

        // document.getElementById('userBio').textContent=info.bio;
        // document.getElementById('userProfilePicture').src=pic;
    }
 

 }
// class MakeProfile extends Profile{
//     constructor(){
//         super();
//     }
// }
export class OtherProfile extends ProfileUI{
    constructor(){
        super();
        this.stack=new StackedPosts();
        this.makeChanges();
    }
    makeChanges(){

        document.getElementById("uploadBtn").style.display='none';
        document.getElementById("editProfileButton").style.display='none';
        document.getElementById("uploadModal").style.display='none';
        let modal=document.getElementsByClassName('modal');
        for(let i=0;i<modal.length;i++){
            console.log( modal[i]);
            modal[i].remove();
        }
        
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
        this.is_logged_in();
    }
    is_logged_in(){
        if(document.getElementsByClassName('templateSelection')[0]!==undefined){
            document.getElementsByClassName('templateSelection')[0].style.display='block';
            document.getElementsByClassName('addTemplate')[0].style.display='block';
    }
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
    submit_profile_info(){
        try{
            let xml=new XMLHttpRequest();
            xml.open('POST','/setup_profile');
            xml.setRequestHeader('Content-Type', 'application/json');
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


