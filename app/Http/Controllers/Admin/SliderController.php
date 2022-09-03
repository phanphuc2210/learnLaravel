<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
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

    // [get] admin/sliders/edit/{slider}
    public function show(Slider $slider){
        return view('admin.slider.edit', [
            'title' => 'Chỉnh sửa Slider',
            'slider' => $slider
        ]);
    }

    // [post] admin/sliders/edit/{slider}
    public function update(Request $req ,Slider $slider){
        $this->validate($req, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);

        $result = $this->sliderService->update($req, $slider);

        if($result){
            return redirect('/admin/sliders/list');
        }

        return redirect()->back();
    }

    // [delete] admin/sliders/destroy
    public function destroy(Request $req){
        $result = $this->sliderService->delete($req);

        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công Slider'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
