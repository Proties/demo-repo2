<?php  declare(strict_types=1);
// this class will have acces to database
namespace Posts;
class CollaboratorList{
	private array $collaborators;
	public function __construct(){
		
	}

	public suggest_user(string $name):array
	{

	}
	public function search_user(Collaborator $user):array
	{
		return $arr;
	}
	public function add_user(Collaborator $userID):void
	{
		array_push($this->collaborators, $user);
	}
	public function remove_user(Collaborator $userID):void
	{
		unset($this->get_users()[$userID]);
	}
	public function move_user_up(Collaborator $userID,$int):void
	{
		array_push($this->collaborators, $user);
	}
	public function move_user_down(Collaborator $userID,$int):void
	{
		
	}
	public function get_collaborators():array
	{
		return $this->collaborators;
	}
}
?>