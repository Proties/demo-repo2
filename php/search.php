<?php 
// this script takes a user name that a users search for and return all matching user name 
$username=$_POST['userName'];
$list_of_user_names=array();
if($username===$list_of_user_names[$i]){
    return true;
}
function search_user_for_name(){
    try{

        return $data;
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }
}


?>