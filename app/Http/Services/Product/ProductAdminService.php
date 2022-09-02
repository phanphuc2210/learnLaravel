<?php

namespace App\Http\Services\Product;

use App\Models\Menu;

class ProductAdminService{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
}