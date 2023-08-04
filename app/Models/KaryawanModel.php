<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_karyawan';
    protected $primaryKey       = 'id_karyawan';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_karyawan', 'nama', 'alamat', 'jeniskelamin'];

    
}
