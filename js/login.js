"strict";
class Login{
	constructor(){
		this._id;
		this._password;
		this._username;
		this._loginBtn;
		this._status;

	}
	set id(i){
		this._id=i;
	}
	get id(){
		return this._id;
	}
	set password(i){
		this._password=i;
	}
	get password(){
		return this._password;
	}
	set username(i){
		this._username=i;
	}
	get username(){
		return this._username;
	}
	set loginBtn(i){
		this._loginBtn=i;
	}
	get loginBtn(){
		return this._loginBtn;
	}
	
}
class LoginUI extends Login{
	constructor(){
		super();
		this._loginBtn=document.getElementById('');
		this._loginSubmitBtn=document.getElementById('');
	}
	submit_login_details(){
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/login');
			xml.readystatechange=function(){
				let data=JSON.parse(this.responseText);
				if(data.status=='success'){
					alert('succesfull logged in');

				}
				else{
					let errorLen=data.errors.length;
					for(let e=0;e<errorLen;e++){

					}
				}
				
			}
			xml.send(this.data);
		}catch(err){
			console.log(err);
		}
	}
}
export default LoginUI;