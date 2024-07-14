<?php 
class BashOps{

// this will updates all class maps for our files
public function update_class_maps(){
	exec('chown 755 bash/updateFIles.sh');
	exec('bash bash/updateFIles.sh');
}	
}
// this will updates all class maps for our files

?>