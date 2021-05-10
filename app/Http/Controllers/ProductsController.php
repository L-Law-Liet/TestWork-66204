<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name, '-');
        if($file = $request->file('image')) {
            $name = env('STORAGE_PATH').'products/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public') . '/products/', $name);
            $data['image'] = $name;
        }
        return Product::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();

        if($file = $request->file('image')) {

            $image = str_replace(env('STORAGE_PATH'), '', $product->image);
            if (\Storage::disk('public')->exists($image)){
                \Storage::disk('public')->delete($image);
            }
            $name = env('STORAGE_PATH').'products/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public') . '/products/', $name);
            $data['image'] = $name;
        }
        else {
            unset($data['image']);
        }
        $data['slug'] = Str::slug($request->name, '-');
        return $product->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->noContent();
    }
}
