<?php

namespace nimbus\Model;

use nimbus\Model;

final class User extends Model {
    public function find_by_name(string $name){
        $result = $this->db->select_where('users','username',$name);
        return $result;
    }
}