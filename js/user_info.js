"strict"

// this script will write all the user profile details to a permant local store;
let w;
let allArray=[];
let ob={};
function startWorker(){
if(typeof(w)=='undefined'){
	w=new Worker('js/worker.js');
	let arr=get_cookie('users=');
	w.postMessage([arr,'happy']);
}

	w.onmessage=function(evt){
		let data=evt.data;
		add_items(data);
		
	};
	
}
function stopWorker(){
	w.terminate();
	w=undefined;
}

startWorker();

console.log(ob);
function add_items(data){
allArray.push(data);
sessionStorage.setItem("user-profiles",allArray);
console.log(allArray);
}
// sessionStorage.setItem("user-profiles",);
// sessionStorage.setItem("post-comments");	
// localStorage.setItem("profile-photos",);
// localStorage.setItem("user-details",);



