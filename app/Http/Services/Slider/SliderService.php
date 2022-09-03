<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SliderService {
    public function insert($req){   
        try {
            Slider::create($req->input());
            Session::flash('success', 'Thêm Slider mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Slider mới lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function get(){
        return Slider::orderByDesc('id')->paginate(15);
    }
}