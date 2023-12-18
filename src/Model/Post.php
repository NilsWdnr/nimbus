<?php

namespace nimbus\Model;

use nimbus\Model;

final class Post extends Model {
    public function get_all() : array
    {
        $posts = $this->db->select_all('posts','date');
        return $posts;
    }

    public function get_by_id(int $id) : array
    {
        $post = $this->db->select_where('posts','id',$id);
        return $post;
    }
}