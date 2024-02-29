<?php

namespace nimbus\Model;

use nimbus\Model;

final class Product extends Model {
    public function get_all() : array
    {
        $products = $this->db->select_all('products','date_created','desc');
        return $products;
    }

    public function get_amount(int $amount) : array
    {
        $products = $this->db->select_limit('products',$amount,'date_created');
        return $products;
    }

    public function get_where(string $product_type = "", string $brand = "") : array
    {
        $conditions = [];
        if($product_type!==""){
            $conditions['product_type'] = $product_type;
        }
        if($brand!==""){
            $conditions['brand'] = $brand;
        }
        
        $products = $this->db->select_all_where('products',$conditions);
        return $products;
    }

    public function get_by_id(int $id) : array
    {
        $product = $this->db->select_where('products','id',$id);
        return $product;
    }

    public function update(int $id,array $data) : bool
    {
        return $this->db->update_where('products',$data,'id',$id);
    }

    public function insert($data) : bool
    {
        return $this->db->insert('products',$data);
    }

    public function delete(int $id) : bool
    {
        return $this->db->delete_where('products','id',$id);
    }
}