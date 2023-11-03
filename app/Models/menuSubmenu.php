<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class menuSubmenu extends Model
{
    protected $table = 'xxhr_menu_submenu';
    protected $fillable = ['EMP_NUM', 'MENU_ID', 'SUBMENU_ID'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Define la relación "menu" con el modelo Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MENU_ID', 'ID_MENU');
    }
    // Define la relación "submenu" con el modelo Submenu
    public function submenu()
    {
        return $this->belongsTo(Submenu::class, 'SUBMENU_ID', 'ID_SUBMENU');
    }
}
