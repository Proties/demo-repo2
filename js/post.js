"strict"
function handler(){
	let f=document.getElementById('fileID').files[0];
	console.log(f);
	let read=new FileReader();
	read.readAsText(f);
	read.readAsDataURL(f);
	read.onload=function(){
		const fileContent=read.result;
		console.log(read.path);

	}
	try{
		let xm=new XMLHttpRequest();
		xm.open('POST','/test');
		xm.onload=function(){
			console.log(this.responseText);
		}
		xm.send();
	}catch(err){
		console.log(err);
	}
	
	console.log('works really well');
}
