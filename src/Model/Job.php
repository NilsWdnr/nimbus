<?php

namespace nimbus\Model;

use nimbus\Model;

class Job extends Model
{

    public function get_all(): array
    {
        $jobs = $this->db->select_all('jobs', 'date_created', 'desc');
        return $jobs;
    }

    public function get_amount(int $id): array
    {
        $jobs = $this->db->select_limit('jobs',$id,'date_created');
        return $jobs;
    }

    public function get_all_filtered($filters): array
    {
        $jobs = $this->db->select_all_where('jobs', $filters);
        return $jobs;
    }

    public function get_by_id(int $id): array
    {
        $job = $this->db->select_where('jobs', 'id', $id);
        return $job;
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->update_where('jobs', $data, 'id', $id);
    }

    public function insert($data): bool
    {
        return $this->db->insert('jobs', $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->delete_where('jobs', 'id', $id);
    }
}
