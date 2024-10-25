<?php

namespace App\Models;

use CodeIgniter\Model;

class model_member extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'nama_lengkap', 'username', 'password', 'email','no_tlp', 'alamat'];

    public function dapatkan_member($email = false)
    {
        if ($email === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['email' => $email]);
        }
    }

    public function tambah_member($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function total_member()
    {
        $query = $this->db->table($this->table)
            ->select('COUNT(DISTINCT user_id) as total_member')
            ->get();
            return $query->getRow();
    }
    public function semua_member()
    {
        $query = $this->db->table($this->table);
        $batasan = $query->select('*')
            ->get()
            ->getResultArray();
        return $batasan;
    }
    public function edit_user($data, $user_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $user_id);
        return $builder->update($data);
    }
    public function hapus_user($user_id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['user_id' => $user_id]);
    }
}