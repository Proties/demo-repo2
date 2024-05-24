"strict"
function initialise(){
    try{
        let xm=new XMLHttpRequest();
        xm.open('POST','/category');
        xm.onload=function(){
            let data=JSON.parse(this.responseText);
            console.log(data);

        }
        xm.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xm.send("action=initialise");
    }catch(err){
        console.log(err);
    }
}
function addEventlisteners(){
    let selectCategory;
}
initialise();