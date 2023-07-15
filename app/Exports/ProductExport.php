<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection, ShouldAutoSize
{
    public function collection()
    {
        $products = Product::all();
        $arr = [];
        foreach ($products as $product) {
            $supplies = $product->supplies;
            if ($supplies) {
                foreach ($supplies as $supply) {
                    $arr[$product->name][] = $supply->IMEI;
                }
            }
        }


        $data = [];
        foreach ($arr as $key => $value) {
            $supp = count($value);
            $data[] = [$key . " " . 'Storage: ' . "$supp", ...$value];
        }

        return collect($data);
    }
}
