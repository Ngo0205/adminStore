<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PharIo\Version\Exception;

class CartController extends Controller
{


    public function index(){

        $carts = Cart::latest()->paginate(5);

        return view('admin.cart.cart',compact('carts'));
    }

    public function cartDetail($id){
        $carts = Cart::find($id);
        return view('admin.cart.cart_detail', compact('carts'));
    }

    public function delete($id){
        try {

            Cart::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
