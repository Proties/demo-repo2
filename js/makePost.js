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
class ReviewPostUI{
	constructor(){
		this._reviewPostModal=document.getElementById('ReviewuploadModal');
		this._reviewPostModal.style.display='none'
		this._file;
		this._src;
		this._username=document.getElementById('post-username');
		this._profilePicture=document.getElementById('post-profile-picture');
		this._placeHolderMedia=document.getElementById('media-placeholder');
		this._caption=document.getElementById('post-caption');
		this._tags=document.getElementById('post-tags');
		this._currentMedia;
	}
	set currentMedia(r){
		this._currentMedia=r;
	}
	get currentMedia(){
		return this._currentMedia;
	}
	set file(r){
		this._file=r;
	}
	get file(){
		return this._file;
	}
	set src(r){
		this._src=r;
	}
	get src(){
		return this._src;
	}
	set username(r){
		this._username=r;
	}
	get username(){
		return this._username;
	}
	set profilePicture(r){
		this._profilePicture=r;
	}
	get profilePicture(){
		return this._profilePicture;
	}
	set reviewPostModal(r){
		this._reviewPostModal=r;
	}
	get reviewPostModal(){
		return this._reviewPostModal;
	}
	set placeHolderMedia(r){
		this._placeHolderMedia=r;
	}
	get placeHolderMedia(){
		return this._placeHolderMedia;
	}
	set caption(r){
		this._caption=r;
	}
	get caption(){
		return this._caption;
	}
	set tags(r){
		this._tags=r;
	}
	get tags(){
		return this._tags;
	}
	check_media_type(){
		console.log('=============type file');
		console.log(this.file.type);
		if(this.file.type=="image/png"){
			this.create_image();
		}else{
			this.create_video();
		}
	}
	create_image(){
		let image=document.createElement('img');
		image.setAttribute('class','basic');
		image.setAttribute('src',this.src);
		this.placeHolderMedia.append(image);
	}
	create_video(){
		let video=document.createElement('video');
		video.setAttribute('class','basic');
		video.setAttribute('src',this.src);
		this.placeHolderMedia.append(video);
	}
	download_media(){
		const image=new Image();
	    let reader=new FileReader();
	    reader.onload=(evt)=>{
	
	    	this.src=reader.result;
	    	this.check_media_type();
	    
	    	// console.log(reader.result);
	    }
	    reader.readAsDataURL(this.file);
	  
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
		console.log('drag and drop active========');
		let uploadBox=document.getElementsByClassName('dragndrop')[0];
		
	
		uploadBox.addEventListener('dragover',function(evt){
			evt.preventDefault();
			evt.target.style.border='0.2em solid blue';
			console.log('reading events');
		});


		uploadBox.addEventListener('drop',(evt)=>{
			evt.preventDefault();
			
			let file=evt.dataTransfer.files[0];
		
			if(evt.dataTransfer.files!==undefined){
				this.reviewUpload.file=file;
				this.reviewUpload.download_media();
				this.reviewUpload.reviewPostModal.style.display='block';
				document.getElementById('uploadModal').style.display='none';
				
		
				
		
				
			}

			
			
		});
	}
	

}

