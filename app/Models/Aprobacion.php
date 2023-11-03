<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprobacion extends Model
{
    use HasFactory;
    protected $table = 'xxhr_aprobacion';
    protected $fillable = ['EMP_NUM_MANDO', 'EMP_NUM', 'ESTATUS'];
    protected $primaryKey = 'ID_APROBACION';
    public $timestamps = false;
}
