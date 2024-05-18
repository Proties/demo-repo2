<?php
// profile pict 
// user bio 
// array of post 
// create a  directory that house all users profiles
// create a user specific directory that is a child that he user owns

// create a whole file of css that the user owns
// create a html that the user owns 
// add user profile to our usersProlie directory
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Personalprofile.html');
    return;
}
switch($case){
    case 'addPost':
        break;
    case 'acountManagement':
        break;
    case 'viewPost':
        break;
}
?>