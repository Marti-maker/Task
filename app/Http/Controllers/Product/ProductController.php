<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supply;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{

    public function index(): View
    {
        $products = Product::with('supplies')->paginate(8);
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = self::custom_validator($request);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        } else {
            try {
                $product = new Product();
                $product->name = $request->product_name;
                $product->price = $request->price;
                $product->save();

            } catch (QueryException $e) {
                if ($e->getCode() == '23000') {
                    return Redirect::back()->withErrors(['product_name' => 'The product name is already taken.']);
                }
            }
            return self::redirect_to_start();

        }

    }


    public function show(string $id)
    {
        $product = Product::find($id);
        $supplies = $product->supplies()->paginate(10);
        return view('products.show', compact('product', 'supplies'));
    }


    public function edit(string $id): View
    {
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {

        $product = Product::find($id);
        $validated = self::custom_validator($request);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        } else {
            $product->name = $request->product_name;
            $product->price = $request->price;
            $product->save();
            return self::redirect_to_start();
        }
    }


    public function destroy(string $id): RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();
        return self::redirect_to_start();
    }

    public function delete_item(int $id)
    {
        $supplu = Supply::find($id);
        $supplu->delete();
        return self::redirect_to_start();
    }

    public static function custom_validator($request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'price' => 'required'
        ]);
        return $validator;
    }

    public static function redirect_to_start(): RedirectResponse
    {
        return Redirect::to('products');
    }
}
