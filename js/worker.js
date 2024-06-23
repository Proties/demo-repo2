"strict"
let users=[];
let arr;

onmessage = (e) =>{
	arr=e.data[0];
	for(let aa=0;aa<arr.length;aa++){
		let username=arr[aa]['user_info']['username'];
		get_user_info_p(username);
		
		
	}
}
function get_user_info_p(username){
try{
	let xml=new XMLHttpRequest();
	xml.open('GET','/@'+username);
	xml.onreadystatechange=function(){
		if(this.readyState===4 && this.status===200){
			let data=JSON.parse(this.responseText);
	
			postMessage(data);
		
		}
		
	}
	xml.send();
}catch(err){
	console.log(err)
}
}

// this script will fetch profile photos of selected users
// and return them and store them on the local session object