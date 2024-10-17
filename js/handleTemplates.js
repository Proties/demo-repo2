"strict";
//get all templates 

//get return message from cookie
//	if there is an error write down the error else add template to list
function get_cookie(name){
    let data=document.cookie;

    let dec=decodeURIComponent(data);
    let sp=dec.split(';');
    for(let x=0;x<sp.length;x++){
        let c=sp[x];
        while(c.charAt(0)==' '){
            console.log(c);
            c=c.substring(1);
            if(c.indexOf(name)==0){
            let parsed=c.substring(name.length,c.length);
            let dtt=JSON.parse(parsed);

            return dtt;
        }
    }
}
}

function getUploadStatus(){
	let status=get_cookie('uploadTemplateStatus=');
	let info=get_cookie('uploadTemplateTempInfo=');
	console.log('======cookie data=====');

	console.log(status);
	return status;
}

let data=getUploadStatus();

if(data.status=='success'){
	alert('template successfully added');
	
}
else{
	alert(data.message);
	let dataLen;
	if(data.errors!==undefined){
		dataLen=data.errors.length;
	}

	for(let i=0;i<dataLen;i++){
		const k=Object.keys(data.errors[i]);
		document.getElementById(k).innerHTML=data.errors[i][k];
	}
}
