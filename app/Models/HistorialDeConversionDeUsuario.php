<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class HistorialDeConversionDeUsuario extends Model
{
    use HasFactory;
    public function IdUsuario()
    {
        return $this->hasOne(User::class,'id');
    }
}
