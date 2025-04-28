"strict"
class EditProfile{
	constructor(){
		this._closeModal=document.getElementById('closeEditProfile');
		this._modal=document.getElementById('EditProfileModal');
		this._form=document.getElementById('EditProfileForm');
		this._modal.style.display='none';
	}
	set form(i){
		this._form=i;
	}
	get form(){
		return this._form;
	}
	set modal(i){
		this._modal=i;
	}
	get modal(){
		return this._modal;
	}
	set closeModal(i){
		this._closeModal=i;
	}
	get closeModal(){
		return this._closeModal;
	}
}

export default EditProfile;