<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Submenu  extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'submenu';
    protected $fillable = ['NAME_SUBMENU', 'ESTATUS', 'ICON_SUB'];
    protected $primaryKey = 'ID_SUBMENU';
    public $timestamps = false;

}
