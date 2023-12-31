<?php

namespace App\Http\Controllers\Admin;
use App\Exports\CategoriesOffersExport;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Post;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OffersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::whereAdminId(\Auth::guard('admin')->user()->id)->get();

        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new CategoriesOffersExport, 'invoices.xlsx');
    }


}
