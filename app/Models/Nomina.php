<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = ['semana','total'];

    //relación muchos a muchos
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class);
    }
}
