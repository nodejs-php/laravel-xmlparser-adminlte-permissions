<?php

namespace App\Http\Controllers;
use App\Exports\CategoriesOffersExport;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function Termwind\render;


class AdminController extends Controller
{
    public function export(): BinaryFileResponse
    {
        return Excel::download(new CategoriesOffersExport, 'invoices.xlsx');
    }

    public function admin(): View
    {
        return view('admin');
    }
}
