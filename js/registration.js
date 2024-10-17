"strict"
import User from './user.js';
class Registration extends User{
    constructor(){
        super();
        this._id;
        this._status;
        this._form=document.getElementById('registerForm');
        this._submissionBtn=document.getElementById('registerUserBtn');
        this._data={
            firstName:this.firstname,
            lastName:this.lastName,
            email:this.email,
            password:this.password
        };

    }
    set form(i){
        this._form=i;
    }
    get form(){
        return this._form;
    }
    set status(i){
        this._status=i;
    }
    get status(){
        return this._status;
    }
    set submissionBtn(i){
        this._submissionBtn=i;
    }
    get submissionBtn(){
        return this._submissionBtn;
    }
    get data(){
        return JSON.stringify(this._data);
    }

    
}
class RegistrationUI extends Registration{
    constructor(){
        super();
        this._first_name_input;
        this._lase_name_input;
        this._email_input;
        this._password_input;

        this._first_name_error;
        this._lase_name_error;
        this._email_error;
        this._password_error;
        this._formModal;
        // this._formData=new FormData(this.form);


    }

    get formData(){
        return this._formData;
    }
    set formModal(i){
        this._formModal=i;
    }
    get formModal(){
        return this._formModal;
    }
    // set first_name_input(){}
    // set first_name_input(){}
    // set first_name_input(){}
    // set first_name_input(){}
    // set first_name_input(){}

    firstName_input(){
       let name=document.getElementById('name');
       this.firstName=name.value;
    }
    lastName_input(){
        let username=document.getElementById('surname');
        this.lastName=username.value;
    }
    email_input(){
        let email=document.getElementById('email');
        this.email=email.value;
    }
    password_input(){
        let password=document.getElementById('password');
        this.password=password.value;
    }

    firstName_error(){}
    lastName_error(){}
    email_error(){}
    password_error(){}
    show_form(){

    }
    validate_firstName(){}
    validate_lasrName(){}
    validate_password(){}
    validate_email(){}
    form_submitted(evt){
        
        this.firstName_input();
        this.lastName_input();
        this.email_input();
        this.password_input();
        try{
            let xm=new XMLHttpRequest();
            xm.open('POST','/registration');
            xm.setRequestHeader('Content-Type', 'application/json');
            xm.onload=function(){
 
                let data=JSON.parse(this.responseText);
                console.log(data);
                console.log('================data');
                if(data.status=='success'){
                    alert('succesfull logged in');
                    this.formModal.style.display='none';
                    return;
                }
                else if(data.status=='failed' && data.message=='user already registered'){
                    alert('user is already registered');
                    return;
                }
                else if(data.status=='failed' && data.message=='validation error'){
                for(let i=0;i<data.errorArray.length;i++){
                    const k=Object.keys(data.errorArray[i]);
                    console.log(data.errorArray[i]);
                    console.log(data.errorArray[i][k]);
                    document.getElementById(k).innerHTML=data.errorArray[i][k];
                }
            }
                
            }
            xm.send(this.data);
        }catch(err){
            console.log(err);
        }
}
}
export default RegistrationUI;
// function registration(){
//     try{
//         let xm=new XMLHttpRequest();
//         xm.open('POST','/registration');
//         xm.onload=function(){
//             let data=JSON.parse(this.responseText);

//             data.status;
//             data.message;
//         }
//         xm.send(data);
//     }catch(err){
//         console.log(err);
//     }
// }