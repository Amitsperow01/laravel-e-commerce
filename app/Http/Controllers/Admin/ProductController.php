<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Console\Input\Input;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

 class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        abort_unless(Gate::allows('product_index'), 403);
        $products = product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('product_create'), 403);
        
        // dd($attributes);
        $categories = Category::all();
        $products = Product::all();
        return view('admin.product.create', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
            'is_featured' => 'required',
            'sku' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'related_product' => 'nullable|array',

        ]);
        $data = $request->all();
        $data['related_product'] = implode(', ', $data['related_product'] ?? []);

        $name = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = productUrlKey($name);
   
        $product = Product::create($data);
        
        if($request->hasFile('banner_image') && $images = $request->file('banner_image')) {
            foreach($images as $image) {
                $product->addMedia($image)->toMediaCollection('banner_image');
            }
        }
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }

        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }
        $attribute = $request->input('attribute',[]);
        $value = $request->input('value',[]);
        foreach ($attribute as $key => $att_id) {
            foreach ($value[$att_id] as $key => $value_id) {
                $data = [
                    'product_id'         => $product->id,
                    'attribute_id'       => $att_id,
                    'attribute_value_id' => $value_id,
                ];
                ProductAttribute::create($data);
            }
        }
        if ($request->save) {
            return redirect()->route('product.index')->with('success', 'Product created successfully');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.product.show', compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('product_edit'), 403);
        $products = Product::findOrFail($id);
        $categories = Category::all();
        $relatedProducts = Product::all();
        $pro_Attribute_Values = ProductAttribute::where('product_id',$id)->pluck('attribute_value_id')->toArray();
        return view('admin.product.edit', compact('products', 'categories','relatedProducts','pro_Attribute_Values'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            // Define your validation rules here based on your requirements
            'related_product' => 'nullable|array',
        ]);
      
        $product = Product::findOrFail($id);
       $validatedData['related_product'] =implode(', ', $validatedData['related_product']);

        // Update product
        $product->update($validatedData);

        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $product->clearMediaCollection('thumbnail_image');
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }      
        if($request->hasFile('banner_image') && $images = $request->file('banner_image')) {
            foreach($images as $image) {
                $product->addMedia($image)->toMediaCollection('banner_image');
            }
        }
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }
        $attribute = $request->input('attribute',[]);
        $value = $request->input('value',[]);
        ProductAttribute::where('product_id',$product->id)->delete();
        foreach ($attribute as $key => $att_id) {
            foreach ($value[$att_id] as $key => $value_id) {
                $data = [
                    'product_id' => $product->id,
                    'attribute_id' => $att_id,
                    'attribute_value_id' => $value_id,
                ];
                ProductAttribute::create($data);
            }
        }
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete product
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
    public function deleteImage($id)
    {
       Media::where('id', $id)->delete();
       return response()->json(['success', 'image delete successfully'], 200);
    }
}
