"strict"
function registration(){
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/registration');
        xm.onload=function(){
            let data=JSON.parse(this.responseText);
            data.status;
            data.message;
        }
        xm.send(data);
    }catch(err){
        console.log(err);
    }
}