"strict"
class Video{
	constructor(){
		this._id;
		this._src;
		this._width;
		this._length;

	}
	set id(i){
		this._id=i;
	}
	set src(i){
		this._src=i;
	}
	set width(i){
		this._width=i;
	}
	set length(i){
		this._length=i;
	}

	get id(){
		return this._id;
	}
	get src(){
		return this._src;
	}
	get width(){
		return this._width;
	}
	get length(){
		return this._length;
	}
}
class VidoeUI extends Video{
	constructor(){
		super();
		this._cont;
		this._parent=document.body;

	}
	set cont(c){
		this._cont=c;
	}
	get cont(){
		return this._cont;
	}
	get parent(){
		return this._parent;
	}
	make_form_submission(){
		let form=document.createElement('form');
		let lbl=document.createElement('Label');
		let lblTxt=document.createTextNode('Video Submission: ');
		let input=document.createElement('input');
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('Submit Video');


		form.setAttribute('class','modal');
		form.setAttribute('action','/upload_video');
		form.setAttribute('enctype','multipart/form-data');
		form.setAttribute('method','post');
		input.setAttribute('type','file');
		input.setAttribute('name','video');
		btn.setAttribute('id','submitVideo');
		lbl.append(lblTxt);
		btn.append(btnTxt);
		form.append(lbl);
		form.append(input);
		form.append(btn);

		this.parent.append(form);
		
	}
	make_video(){
		let container=document.createElement('video');
		let video=document.createElement('video');
		container.setAttribute('class',);
		container.setAttribute('id',);
		video.setAttribute('class',);
		video.setAttribute('id',);
		container.append(video);
		this.cont=container;
	}
	send_video_to_server(){
		try{

		}catch(err){
			console.log(err)
		}
	}
	get_video_to_server(){
		try{

		}catch(err){
			console.log(err)
		}
	}
}
export default VidoeUI;
