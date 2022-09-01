<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getParent(){
        return Menu::where('parent_id', 0)->get();
    }

    public function create($req){
        try {
            Menu::create([
                'name' => (string)$req->input('name'),
                'parent_id' => (int)$req->input('parent_id'),
                'description' => (string)$req->input('description'),
                'content' => (string)$req->input('content'),
                'active' => (int)$req->input('active '),
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }


}
