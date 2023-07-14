<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $products=Product::paginate(8);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
       $validated=self::custom_validator($request);
        if ($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput();
        }else{
            $product=new Product();
            $product->name=$request->product_name;
            $product->price=$request->price;
            $product->save();
            return self::redirect_to_start();

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        $product=Product::find($id);
        return view('products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {

        $product=Product::find($id);
        $validated=self::custom_validator($request);
        if ($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput();
        }else{
            $product->name=$request->product_name;
            $product->price=$request->price;
            $product->save();
            return self::redirect_to_start();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        $product=Product::find($id);
        $product->delete();
        return self::redirect_to_start();
    }
    public static function custom_validator($request){
       $validator= Validator::make($request->all(),[
            'product_name'=>'required|string',
            'price' =>'required'
        ]);
       return $validator;
    }
    public static function redirect_to_start():RedirectResponse{
        return Redirect::to('products');
    }
}
