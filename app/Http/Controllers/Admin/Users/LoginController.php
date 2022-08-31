<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store(Request $req){
        // hàm dd() là vừa var_dump() vừa die()
        // dd($req->input());


        $this->validate($req, [
            'email'=>'required|email:filter',
            'password'=>'required'
        ]);

        if(Auth::attempt([
            'email'=>$req->input('email'),
            'password'=>$req->input('password')
        ], $req->input('remember'))){
            
            return redirect()->route('admin');
        }

        Session::flash('error', 'Email hoặc Password không chính xác');
        return redirect()->back();
    }
}
