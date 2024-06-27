<?php 
class BashOps{

// this will updates all class maps for our files
public function update_class_maps(){
	exec('chown 755 updateFIles.sh');
	exec('bash updateFIles.sh');
}	
}
// this will updates all class maps for our files

?>