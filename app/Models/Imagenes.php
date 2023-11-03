<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    use HasFactory;
    protected $table = 'xxhr_imagenes';
    protected $fillable = ['IMG', 'ACTION'];
    protected $primaryKey = 'ID_IMAGEN'; 
    public $timestamps = false;
}
