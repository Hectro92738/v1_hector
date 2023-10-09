<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class XxhrEstructuraUteq extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'xxhr_estructura_uteq';
    protected $fillable = ['EMAIL', 'EMP_NUM', 'ESTATUS', 'PASSWORD'];
    protected $primaryKey = 'EMP_NUM'; // Especifica la columna de clave primaria

    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->EMP_NUM;
    }

    public function getAuthIdentifierName()
    {
        return 'EMAIL';
    }

    
}
