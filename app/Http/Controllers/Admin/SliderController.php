<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService){
        $this->sliderService = $sliderService;
    }

    // [get] admin/sliders/add
    public function create(){
        return view('admin.slider.add', [
            'title' => 'Thêm Slider mới'
        ]);
    }

    // [post] admin/sliders/add
    public function store(Request $req){
        $this->validate($req, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);

        $this->sliderService->insert($req);

        return redirect()->back();
    }

    // [post] admin/sliders/list
    public function index(){
        return view('admin.slider.list', [
            'title' => 'Danh sách Slider mới nhất',
            'sliders' => $this->sliderService->get()
        ]);
    }
}
