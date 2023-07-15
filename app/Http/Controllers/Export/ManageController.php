<?php

namespace App\Http\Controllers\Export;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ManageController extends Controller
{
    public function export_pdf()
    {
        $arr = self::export_help();
        $pdf = Pdf::loadView('templates.pdf', ['arr' => $arr]);
        return $pdf->download('invoice.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }


    public static function export_help()
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
        return $arr;
    }

}
