<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mando extends Model
{
    use HasFactory;
    protected $table = 'xxhr_mando';
    protected $fillable = ['NUM_MANDO', 'ESTATUS_MANDO'];
    protected $primaryKey = 'ID_MANDO'; 
    public $timestamps = false;
}
