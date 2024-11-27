<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'nama',
        'email',
        'password',
        'whatsapp',
        'role'
    ];
}
