"strict"
import {Post} from './post.js';
class MakePost extends Post{
	constructor(){
		super();
		this._status=false;
	}
	set status(i){
		this._status=i;
	}
	get status(){
		return this._status;
	}

}
class ReviewPostUI  {
	constructor(){

		this._reviewPostModal=document.getElementById('ReviewuploadModal');
		this._reviewPostModal.style.display='none'
	}
	set reviewPostModal(r){
		this._reviewPostModal=r;
	}
	get reviewPostModal(){
		return this._reviewPostModal;
	}
}
export class MakePostUI extends MakePost{
	constructor(){
		super();
		this._reviewUpload=new ReviewPostUI();
		this._uploadPostModal=document.getElementById('uploadModal');
	}
	get reviewUpload(){
		return this._reviewUpload;
	}
	get uploadPostModal(){
		return this._uploadPostModal;
	}
	make_form(){

	}
	make_drop_drag_window(){
		let uploadBox=document.getElementsByClassName('dragndrop')[0];
		uploadBox.addEventListener('dragover',function(evt){
			evt.preventDefault();
			console.log('reading events');
		});


		uploadBox.addEventListener('drop',function(evt){
			evt.preventDefault();
			console.log('dropping events');
			console.log(evt.dataTransfer.files);


			// console.log(this._reviewUpload.reviewPostModal);
			// this.reviewUpload.reviewPostModal.style.display='block';
			this.uploadPostModal.style.display='none';
		});
	}
	

}

