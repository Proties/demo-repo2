<?php  declare(strict_types=1);
// this class will have acces to database
namespace Posts;
class CollaboratorList{
	private array|null $collaborators;
	public function __construct(array $arr=null){
		$this->collaborators=$arr;
		
	}

	public function suggest_user(Users $user):array
	{
		$arr=[];
		$len=count($this->collaborators);
		for($i=0;$i<$len;$i++){
			if($name ==$this->collaborators[$i]->get_username()){
				array_push($this->collaborators,$this->collaborators[$i]);
			}
		}
		return $arr;
	}
	public function search_user(Collaborator $user):bool
	{
		return $arr;
	}
	public function add_user(Collaborator $user)
	{
		try{
			$collabDB=new CollaboratorDB();
			$collabDB->write_collaborator();
			$collabDB->write_collaboratorUser();
			array_push($this->collaborators, $user);
		}catch(Exception $err){
			return $err;
		}
		

	}
	public function remove_user(Collaborator $user):void
	{
		unset($this->get_users()[$userID]);
	}
	
	public function get_collaborators():array
	{
		return $this->collaborators;
	}
}
?>