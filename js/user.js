"strict"
class User{
	constructor(){
		this._id;
		this._fname;
		this._lname;
		this._email;
		this._password;
		this._logged_in=false;
		
	}
	set id(i){
		this._id=i;
	}
	set fname(i){
		this._fname=i;
	}
	set lname(i){
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

	get id(){
		return this._id;
	}
	get fname(){
		return this._fname;
	}
	get lname(){
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
class UserConnection{
	get_user_info(){}
}
class UserProfileUI extends User{
	constructor(){
		super();
	}
	make_profile(){}
}


