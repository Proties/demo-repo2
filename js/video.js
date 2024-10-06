"strict";
export class Video{
	constructor(){
		this._id;
		this._src;
		this._width;
		this._height;
		this._size;
		this._name;
		this._title;
		this._dateModified;
		this._timeModified;
		this._extensions=['.mp4','.wav','.mkv'];
		this._item={
			id:this.id,
			src:this.src,
			dateModified:this.dateModified,
			lastModified:this.lastModified,
			size:this.size,
			title:this.title,
			name:this.name,
		}
	}
	set dateModified(i){
		this._dateModified=i;
	}
	get dateModified(){
		return this._dateModified;
	}
	set lastModified(i){
		this._lastModified=i;
	}
	get lastModified(){
		return this._lastModified;
	}

	set id(i){
		this._id=i;
	}
	get id(){
		return this._id;
	}
	set src(i){
		this._src=i;
	}
	get src(){
		return this._src;
	}
	set width(i){
		this._width=i;
	}
	get width(){
		return this._width;
	}
	set height(i){
		this._height=i;
	}
	get height(){
		return this._height;
	}
	set size(i){
		this._size=i;
	}
	get size(){
		return this._size;
	}
	set name(i){
		this._name=i;
	}
	get name(){
		return this._name;
	}
	set title(i){
		this._title=i;
	}
	get title(){
		return this._title;
	}
	
}
class VideoUI extends Video{
	constructor(){
		super();
	}
	checkAllowedExtensions(){}
	previewVideo(){}
}