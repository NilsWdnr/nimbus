<?php

namespace nimbus\Model;

use nimbus\Model;

final class User extends Model {
    public function find_by_name(string $name): array
    {
        $result = $this->db->select_where('users','username',$name);
        return $result;
    }

    public function verify_password($username,$password): bool
    {
        $found_user = $this->find_by_name($username);
        if($found_user===[]){
            return false;
        } else if(password_verify($password,$found_user['password'])){

            $_SESSION['login'] = [
                'user_id' => $found_user['id'],
                'username' => $found_user['username']
            ];
            return true;
        }

        return false;
    }

    public function update_password($username,$new_password): bool
    {
        $hashed_password = password_hash($new_password,PASSWORD_DEFAULT);
        $data = [
            'password' => $hashed_password
        ];
        return $this->db->update_where('users',$data,'username',$username);
    }

    public function log_out(): void
    {
        unset($_SESSION['login']);
    }
}