"strict"

// this will get user data from server
async function start(){
	let user=get_cookie('user=');
	url='/@'+user['username'];
	let data=await request_data();
	if(typeof(data)=='object'){
		postMessage(data);
		return;
	}
	postMessage(false);
}
function request_data(url){
	try{
		let xml=new XMLHttpRequest();
		xml.open('GET',url);
		xml.onreadystatechange=function(){
			if(this.readyState==4){
			console.log(this.responseText);
			let data=JSON.parse(this.responseText);
			return data;
		}
		}
		xml.send();
	}catch(err){
		console.log;
	}
}
start();