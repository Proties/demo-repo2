<?php
namespace Insta\Ranking;
use Insta\Databases\Database;
class ProfilesRank extends Database{
    private $db;
    public function __construct(){
        $this->db=Database::get_connection();
    }
}


?>