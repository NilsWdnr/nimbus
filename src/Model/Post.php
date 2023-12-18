<?php

namespace nimbus\Model;

use nimbus\Model;

final class Post extends Model {
    public function get_all(){
        $posts = $this->db->select_all('posts','date');
        return $posts;
    }
}