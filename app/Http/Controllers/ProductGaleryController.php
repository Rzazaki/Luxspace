<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGalery;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductGalerryRequest;

class ProductGaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {


        if (request()->ajax()) {
            $query = ProductGalery::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <form class="inline-block" action="' . route('dashboard.gallery.destroy', $item->id) . '" method="POST">
                        <button class="bg-red-500 rounded-md text-white px-2 py-1 m-2">Delete</button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>
                ';
                })
                ->editColumn('url', function ($item) {
                    return '<img style="max-width:150px" src="'. Storage::url($item->url) .'">';
                })
                ->editColumn('is_featured', function ($item) {
                    return $item->is_featured ? 'Yes' : 'No';
                })
                ->rawColumns(['action', 'url'])
                ->make();
        }
        return view('pages.dashboard.galery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('pages.dashboard.galery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalerryRequest $request, Product $product)
    {
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach($files as $file) 
            {
                $path = $file->store('public/gallery');

                ProductGalery::create([
                    'products_id' => $product->id,
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.product.gallery.index', $product->id);
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
    public function destroy(ProductGalery $gallery)
    {

        // return $gallery;
        $gallery->delete();

        
        return redirect()->route('dashboard.product.gallery.index', $gallery->products_id);
    }
}
