<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $slider;
    protected $menu;

    public function __construct(SliderService $slider, MenuService $menu)
    {
        $this->slider = $slider;
        $this->menu = $menu;
    }

    public function index(){
        return view('main', [
            'title' => 'Shop nước hoa ABC',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show()
        ]);
    }
}
