"strict"
import User from './user.js'
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
        console.log(this.item);
        console.log(typeof this);
        document.getElementById('username').innerHTML=this.item.username;
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
        this.stack=StackedPosts();
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

// export default {MyProfile,OtherProfile};

