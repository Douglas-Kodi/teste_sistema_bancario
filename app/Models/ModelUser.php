<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    use HasFactory;
    
    protected $table='users';
    protected $fillable=['numcc', 'name', 'cpf', 'email', 'password', 'deleted_at'];

    public function relMoney()
    {
        return $this->hasMany('App\Models\ModelMoney', 'id_numcc');
    }
}
