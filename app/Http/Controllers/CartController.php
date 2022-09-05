<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $req){
        $result = $this->cartService->create($req);

        if($result === false){
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function show(){
        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $req){
        $this->cartService->update($req);

        return redirect()->back();
    }

    public function remove($id){
        $this->cartService->remove($id);

        return redirect()->back();
    }

    public function addCart(Request $req){
        $this->cartService->addCart($req);

        return redirect()->back();
    }
}
