<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $req, $id, $slug = ''){
        $menu = $this->menuService->getByID($id);

        $products = $this->menuService->getProduct($menu, $req);

        return view('menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu' => $menu
        ]);
    }
}
