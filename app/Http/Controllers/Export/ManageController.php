<?php

namespace App\Http\Controllers\Export;

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
        $arr = self::export_help();
        $view=self::return_view($arr);
        return Excel::download($view, 'invoices.xlsx');

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

    public static function return_view($arr)
    {
        return view('templates.pdf',
            ['arr' => $arr]
        );
    }
}
