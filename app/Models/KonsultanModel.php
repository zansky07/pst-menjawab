<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsultanModel extends Model
{
    protected $table = 'konsultan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'email',
        'whatsapp'
    ];
}
