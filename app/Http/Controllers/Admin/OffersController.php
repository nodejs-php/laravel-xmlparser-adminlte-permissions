<?php

namespace App\Http\Controllers\Admin;
use App\Exports\CategoriesOffersExport;
use App\Models\CategoriesOffers;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OffersController extends AdminController
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.dashboard');
    }

    public function downloadProducts(): BinaryFileResponse
    {
        return Excel::download(new CategoriesOffersExport, 'invoices.xlsx');
    }

    public function loadAndParseProduct()
    {
        Artisan::call('products:load');

        return response()->json([
            "success" => 1,
        ]);
    }

    public function listOffers(Request $request): JsonResponse
    {

        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';
        $query = CategoriesOffers::query()->select('*');

        // Search
        $search = $request->cSearch;
        //Log::info($search);
        if ($search) {
            $query = $query->where(function ($query) use ($search) {
                $query->orWhere('category_name', 'like', "%" . $search . "%");
                $query->orWhere('offer_name', 'like', "%" . $search . "%");
                $query->orWhere('price', 'like', "%" . $search . "%");
            });
        }

        $orderByName = 'name';
        switch ($orderColumnIndex) {
            case '0':
                $orderByName = 'category_name';
                break;
            case '1':
                $orderByName = 'offer_name';
                break;
            case '2':
                $orderByName = 'price';
                break;
            default:
                $orderByName = 'id';
                break;
        }

        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $offers = $query->skip($skip)->take($pageLength)->get();

        return response()->json([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            'data' => $offers
        ], 200);
    }

    public function downloadPage(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.download-page');
    }

    public function importPage(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.import-page');
    }
}
