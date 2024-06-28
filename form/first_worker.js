"strict"

let i=0;
console.log('worker is working');
function count(){
	i++;
	postMessage(i);
	setTimeout("count()",5000);

}
count();
// let sub=document.getElementById("submissionContainer");


function get_submissions(){
	let xml=new XMLHttpRequest();
	xml.open('POST','/test');
	xml.onload=function(){
		console.log(this.responseText);
		let data=JSON.parse(this.responseText);
		if(data.status=='no_submissions'){
			console.log('no submissions');
		}else{
			let arr=data.formSubmissions;
			display_submision(arr);
		}
				
	}
	xml.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xml.send('action=get_submissions');

}
function display_submision(arr){
	console.log('worker is working');
	console.log(arr);
	let ele=document.createElement("div");
	let btn=document.createElement("button");
	for(let a=0;a<arr.length;a++){
		let question=document.createElement("span");
		let answer=document.createElement("span");
		question.innerHTMl=arr[a].question;
		question.innerHTMl=arr[a].answer;
		let inputBox=document.createElement("input");
		inputBox.type='checkbox';
		inputBox.value=arr[a].show;
		ele.append(question);
		ele.append(answer);
		ele.append(inputBox);
	}
	sub.append(ele);
}
get_submissions();