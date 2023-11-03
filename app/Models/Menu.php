<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Menu  extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'xxhr_menu';
    protected $fillable = ['NAME_MENU', 'ESTATUS', 'ICON_MENU'];
    protected $primaryKey = 'ID_MENU';
    public $timestamps = false;

}
