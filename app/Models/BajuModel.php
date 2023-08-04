<?php

namespace App\Models;

use CodeIgniter\Model;

class BajuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_baju';
    protected $primaryKey       = 'id_baju';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_baju', 'nama', 'ukuran', 'harga'];

   
}
