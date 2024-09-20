"strict"
import User from './user.js'
import StackedPosts from './stackPosts.js';
class Profile extends User{
    constructor(){
        super();
        this._type;
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
        console.log(this.username);
        console.log(typeof this);
        document.getElementById('username').innerHTML=this.username;
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
    }
}



