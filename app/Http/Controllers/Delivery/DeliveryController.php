<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('delivery.index');
    }

    public function middle_create()
    {
        $products = Product::select('name')->distinct()->get();
        return view('delivery.middle-create', compact('products'));
    }

    public function middle_create_save(Request $request)
    {
        $dateRaw=$request->addMoreInputFields;
        $missmatches=[];
        foreach ($dateRaw as $raw){
                $product = Product::where('name', $raw["product"])->first();
                if (!$product) {
                    $missmatches = ["Product with that name don't exist: " => $raw["product"]];
                }
            }

        if (count($missmatches)>0){
            return redirect()->back()->with([$missmatches]);
        }
        else{
            $serializedData = serialize($dateRaw);
            $encodedData = urlencode($serializedData);
            return redirect()->to('deliveries/create?' . $encodedData);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->query();
        foreach ($data as $key => $value) {
            $decodedData[] = unserialize(urldecode($key));
        }
        $products=$decodedData[0];
        $items=[];
        foreach ($products as $pro){
            $items[$pro["product"]]=$pro['amount'];
        }
        return view('delivery.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public static function custom_validator($request)
    {
        $validator = Validator::make($request, [
            'product' => 'required|string',
            'amount' => 'required'
        ]);

        return $validator;
    }
}
