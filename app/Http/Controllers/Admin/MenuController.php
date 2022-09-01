<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;


class MenuController extends Controller
{

    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    // [get] /admin/menus/list
    public function index(){
        return view('admin.menu.list', [
            'title'=>'Danh sách danh mục mới nhất',
            'menus'=>$this->menuService->getAll()
        ]);
    }

    // [get] /admin/menus/add
    public function create(){
        return view('admin.menu.add', [
            'title'=>'Thêm danh mục mới',
            'menus'=>$this->menuService->getParent()
        ]);
    }

    // [post] /admin/menus/add
    public function store(CreateFormRequest $req){
        
        $result = $this->menuService->create($req);

        return redirect()->back();
    }
}
