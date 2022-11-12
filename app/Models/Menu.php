<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'admin_menu'; 

    protected $fillable = [
        'name',
        'icon',
        'controller',
        'status',
        'view',
        'route',
    ];
}
