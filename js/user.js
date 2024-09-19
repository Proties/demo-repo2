"strict"
class User{
    constructor(){
        this._id;
        this._firstName;
        this._lastName;
        this._username;
        this._email;
        this._password;
        this._logged_in=false;
        this._item={
            username:'rotondwa',
            bio:'happy'
        };
        
    }
    set item(i){
        this._item=i;
    }
    set id(i){
        this._id=i;
    }
    set firstName(i){
        this._fname=i;
    }
    set lastName(i){
        this._lname=i;
    }
    set email(i){
        this._email=i;
    }
    set password(i){
        this._password=i;
    }
    set logged_in(i){
        this._logged_in=i;
    }


    get item(){
        return this._item;
    }
    get id(){
        return this._id;
    }
    get fisrtName(){
        return this._fname;
    }
    get lastName(){
        return this._lname;
    }
    get email(){
        return this._email;
    }
    get password(){
        return this._password;
    }
    get logged_in(){
        return this._logged_in;
    }
}
export default User;