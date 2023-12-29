<?php

namespace App\Http\Controllers;
use App\Exports\CategoriesOffersExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ExcelController extends Controller
{
    public function export(): BinaryFileResponse
    {
        return Excel::download(new CategoriesOffersExport, 'invoices.xlsx');
    }
}
