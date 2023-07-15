<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\Product;
use App\Models\Supply;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use stdClass;

class DeliveryController extends Controller
{

    public function index(): View
    {
        $deliveries = Delivery::orderBy('expected_date')->paginate(10);
        return view('delivery.index', compact('deliveries'));
    }

    public function middle_create(): View
    {
        return view('delivery.create-edit');
    }

    public function finish_order(int $id): View
    {
        $delivery = Delivery::find($id);
        $products = Product::select('name')->distinct()->get();
        $details = $delivery->details;
        $detailsArr = [];
        if ($details->count() > 0) {
            foreach ($details as $detail) {
                $product = Product::find($detail->product_id);
                if (isset($detailsArr[$product->name])) {
                    $detailsArr[$product->name]['quantity'] += $detail->quantity;
                } else {
                    $detailsArr[$product->name] = ['quantity' => $detail->quantity];
                }
            }
        }


        return view('delivery.finish-order', compact('delivery', 'products', 'detailsArr'));
    }

    public function middle_create_save(Request $request)
    {
        $validated = self::custom_validator_delivery($request);
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        } else {
            $delivery = new Delivery();
            $delivery->expected_date = $request->expected_date;
            $delivery->warehouse = $request->warehouse;
            $delivery->save();
            return self::redirect_start_deliveries();
        }

    }

    public function finish_order_save(Request $request, int $id)
    {
        $dateRaw = $request->addMoreInputFields;
        $missmatches = [];
        $data = [];
        foreach ($dateRaw as $key => $value) {
            $product = Product::where('name', $value["product"])->first();
            if (!$product) {
                $missmatches = ["Product with that name don't exist: " => $value["product"]];
            } else {
                if (isset($data[$value['product']])) {
                    $data[$value['product']] = $data[$value['product']] += $value['amount']++;
                } else {
                    $data[$value['product']] = $value['amount'];
                }
            }
        }
        if (count($missmatches) > 0) {
            return Redirect::back()->withErrors(['mismatches' => "Check the names you provided ,
             there was a problem with one of them on the left side you can see all products available"]);
        } else {
            if (DeliveryDetail::where('delivery_id', $id)) {
                DeliveryDetail::where('delivery_id', $id)->delete();
            }
            foreach ($data as $key => $value) {
                $product = Product::where('name', $key)->first();
                $details = new DeliveryDetail();
                $details->delivery_id = $id;
                $details->product_id = $product->id;
                $details->quantity = $value;
                $details->save();
            }
            return redirect()->to(route('deliveries.details', ['id' => $id]));
        }

    }

    public function show_details(int $id)
    {
        $delivery = Delivery::find($id);
        $details = $delivery->details;
        $array = [];
        foreach ($details as $detail) {
            $product = Product::find($detail->product_id);
            if (isset($array[$product->name])) {
                $array[$product->name][] += $detail->quantity;
            } else {
                $array[$product->name][] = $detail->quantity;
            }
        }
        $items = [];
        foreach ($array as $key => $value) {
            $sum = 0;
            foreach ($value as $val) {
                $sum += $val;
            }
            $items[$key] = $sum;
        }
        return view('delivery.create', compact('items', 'delivery'));
    }


    public function store(Request $request)
    {
        $items = $request->all();
        $times = [];
        foreach ($items as $key => $value) {
            if ($key == '_token' || $key == 'status' || $key == 'delivery_id') {
                continue;
            } else {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        $product = Product::where('name', $key)->first();
                        try {
                            $supply = new Supply();
                            $supply->IMEI = $val;
                            $supply->product_id = $product->id;
                            $supply->save();
                        } catch (QueryException $e) {
                            if ($e->getCode() == '23000') {
                                return Redirect::back()->withErrors(['imei' => "The IMEI $val is already taken."]);
                            }
                        }
                    }
                } else {
                    $product = Product::where('name', $key)->first();
                    try {
                        $supply = new Supply();
                        $supply->IMEI = $value;
                        $supply->product_id = $product->id;
                        $supply->save();
                    } catch (QueryException $e) {
                        if ($e->getCode() == '23000') {
                            return Redirect::back()->withErrors(['imei' => 'The IMEI code is already taken.']);
                        }
                    }
                }
            }
        }
        if ($request->status == 'finished') {
            $delivery = Delivery::find($request->delivery_id);
            $delivery->status = 'finished';
            $delivery->save();
        }
        return self::redirect_start_deliveries();
    }


    public function edit(string $id)
    {
        $delivery = Delivery::find($id);
        $type = 'update';
        return view('delivery.create-edit', compact('delivery', 'type'));
    }

    public function update(Request $request, string $id)
    {
        $delivery = Delivery::find($id);
        $validated_request = self::custom_validator_delivery($request);
        if ($validated_request->fails()) {
            return redirect()->back()->withErrors($validated_request)->withInput();
        } else {
            $delivery->expected_date = $request->input('expected_date');
            $delivery->warehouse = $request->input('warehouse');
            $delivery->status = $request->input('status');
            $delivery->save();
            return self::redirect_start_deliveries();
        }
    }


    public function destroy(string $id)
    {
        $delivery = Delivery::find($id);
        $delivery->delete();
        return self::redirect_start_deliveries();
    }

    public static function custom_validator_delivery($request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse' => 'required|string|min:5|max:50',
            'expected_date' => 'required'
        ]);
        return $validator;
    }

    public static function redirect_start_deliveries(): RedirectResponse
    {
        return Redirect::to('/deliveries');
    }
}
