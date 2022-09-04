<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function show(){
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')->get();
    }
    
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
                'active' => (string)$req->input('active'),
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($menu, $req) : bool{
        // làm nhanh
        // $menu->fill($req->input());
        // $menu->save();

        // làm thủ công
        if($req->input('parent_id') != $menu->id){
            $menu->parent_id = (int) $req->input('parent_id');
        }
            
        $menu->name = (string) $req->input('name');
        $menu->description = (string) $req->input('description');
        $menu->content = (string) $req->input('content');
        $menu->active = (string) $req->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công danh mục');
        return true;
    }

    public function destroy($req){
        $id = (int)$req->input('id');

        $menu = Menu::where('id', $id)->first();

        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getByID($id){
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $req){
        $query =  $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);
            

        if($req->input('price')){
            $query->orderBy('price', $req->input('price'));
        }
            
        
        return $query->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }

}
