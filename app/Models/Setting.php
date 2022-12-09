<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting'; 

    protected $fillable = [
        'name',
        'value',
    ];

    static function getSettingValue($name){
        return self::where('name',$name)->pluck('value')->toArray();
    }

    static function getSettingId($name){
        return self::where('name',$name)->pluck('id')->toArray();
    }
}
