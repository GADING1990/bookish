<?php

namespace App\Models;

use CodeIgniter\Model;

class model_admin extends Model
{
    protected $table = 'petugas';
    protected $primaryKey ='id_role';
    
    public function tambah_admin($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

        public function semua_daftar_admin()
        {
            $query = $this->db->table($this->table);
            $batasan = $query->select('*')
            ->where('role', 'admin')
            ->get()
            ->getResultArray();
            return $batasan;
        }
        public function edit_admin($data, $id_role)
        {
            $builder = $this->db->table($this->table);
            $builder->where('id_role', $id_role);
            return $builder->update($data);
        }
        public function hapus_admin($id_role)
        {
            $builder = $this->db->table($this->table);
            return $builder->delete(['id_role' => $id_role]);
        }

    public function kode_admin() {
        $query = $this->db->table('petugas');
        $query->like('petugas', 'A', 'after');
        $query->select('petugas');
        $result = $query->get()->getResult();
    
        $existingNumbers = array_map(function ($code) {
            return (int)substr($code->petugas, -3);
        }, $result);
    
        // Jika tidak ada nomor yang digunakan, gunakan 1, jika ada gunakan nomor selanjutnya
        $newNumber = empty($existingNumbers) ? 1 : min(array_diff(range(1, max($existingNumbers) + 2), $existingNumbers));
    
        return 'A-' . sprintf("%03d", $newNumber);
    }

    public function dapatkan_admin($email=false)
    {
        if($email === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['email'=>$email]);
        }
    }
}
