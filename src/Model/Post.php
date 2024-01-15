<?php

namespace nimbus\Model;

use nimbus\Model;

final class Post extends Model {
    public function get_all() : array
    {
        $posts = $this->db->select_all('posts','date','desc');
        return $posts;
    }

    public function get_by_id(int $id) : array
    {
        $post = $this->db->select_where('posts','id',$id);
        return $post;
    }

    public function update(int $id,array $data) : bool
    {
        return $this->db->update_where('posts',$data,'id',$id);
    }

    public function insert($data) : bool
    {
        return $this->db->insert('posts',$data);
    }

    public function delete(int $id) : bool
    {
        return $this->db->delete_where('posts','id',$id);
    }
}