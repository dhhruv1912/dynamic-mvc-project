<?php

// namespace App\Helpers;
use App\Models\Menu;

// class Helper {

function load_menus()
{
    $data = Menu::select('name', 'icon','route', 'route_name')->where('status','1')->get()->toArray();
    return $data;
}
// }
