<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMoney extends Model
{
    use HasFactory;
    
    protected $table='moneys';
    protected $fillable=['id_numcc', 'valor', 'type', 'deleted_at'];

    public function relUser()
    {
        return $this->hasOne('App\Models\ModelUser', 'numcc');
    }
}
