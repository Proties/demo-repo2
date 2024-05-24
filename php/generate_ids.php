<?php
class GenerateIDs{
    private $file_one='generated_ids.json';
    private $file_two='used_ids.json';
    private $freeIDs;
    private $usedIDs;
    private $freeIDsCount;
    private $usedIDsCount;
    private $id;
    private $duplicateIDs=array();

    public function __construct(){}

    public function set_used_ids($id){}
    public function set_free_ids($id){}
    public function set_used_ids_count($id){}
    public function set_free_ids_count($id){}
    public function set_id($id){}
    public function set_duplicates($id){}
    public function selete_duplicates($id){}

    public function get_used_ids(){
        return $this->usedIDs;
    }
    public function get_free_ids(){
        return $this->freeIDs;
    }
    public function get_used_ids_count(){
        return $this->usedIDCount;
    }
    public function get_free_ids_count(){
        return $this->freeIDCount;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_duplicates(){
        return $this->duplicates;
    }
    public function delete_duplicates(){}

    public function read_usedIDs(){}
    public function read_freeIDs(){}
    function generate_ids(){
        $list = '1234567890abcdefghijklmnopqrstuvwzyABCDEFGHIJKLMNOPQRSTUVWZY';
        $random = str_shuffle($list);
        $str = substr($random, 5, 13);
    }
    // if dupicate found delete last duplicate found
    function check_duplicate(){}
    
    //remove item from generated_ids to used_ids if the id is used succesfully
    function remove_id(){}
    
    //returns id to generated_ids file form used
    function return_id(){}
}

?>