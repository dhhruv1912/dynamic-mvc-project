<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; 

    protected $fillable = [
        'name',
        'desc',
        'tag',
        'model',
        'sku',
        'price',
        'tax',
        'qty',
        'mqty',
        'out_of_stock',
        'shipping',
        'avl_date',
        'mfc',
        'cat',
        'disc',
        'spc',
        'mimg',
        'simg',
        'status'
    ];
}
