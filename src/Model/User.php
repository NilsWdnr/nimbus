<?php

namespace nimbus\Model;

use nimbus\Model;

final class User extends Model {
    public function find_by_name(string $name)
    {
        $result = $this->db->select_where('users','username',$name);
        return $result;
    }

    public function verify_password($login_data): bool
    {
        $found_user = $this->find_by_name($login_data['username']);
        if($found_user===[]){
            return false;
        } else if(password_verify($login_data['password'],$found_user['password'])){

            $_SESSION['login'] = [
                'user_id' => $found_user['id'],
                'username' => $found_user['username']
            ];
            return true;
        }

        return false;
    }
}