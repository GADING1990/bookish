<?php

namespace App\Models;

use CodeIgniter\Model;

class model_akun extends Model
{
    protected $table = 'user';
    protected $primaryKey ='user_id';
    
    public function tambah_akun($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
    public function dapatkan_user($email=false)
    {
        if($email === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['email'=>$email]);
        }
    }
   
}