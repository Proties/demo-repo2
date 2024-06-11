"strict"

// if username in the  url and username in cookie dont match execute the following
// hide post button 
// hide edit button
// hide add caption button 
let username_in_url=window.location.href;
let username_in_session;
// let xm=new XM
//then user does not owner the profile page currently beign viewed
if(username_in_url!==username_in_session){

    document.getElementById('uploadBtn').style.display='none';
    document.getElementById('editProfileButton').style.display='none';
}


