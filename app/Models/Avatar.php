<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    protected $table = 'xxhr_avatars';
    protected $fillable = ['EMP_NUM', 'IMG'];
    protected $primaryKey = 'id'; 
    public $timestamps = false;
}
