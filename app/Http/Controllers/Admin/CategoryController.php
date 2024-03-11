<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('category_index'), 403);
    
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('category_create'), 403);
        $product=Product::all();
        return view('admin.category.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'show_in_menu' => 'required',
            'meta_tag' => 'required',
            'meta_title' => 'nullable',
       
        ]);
        
        $data = $request->all();
        // $ctyPart = $data['category_parent_id'];
        $data['category_parent_id'] = $data['category_parent_id'] ? $data['category_parent_id'] : 0;

        $name = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = categoryUrlKey($name); 
        
        $category=Category::create($data);
        // dd( $category );
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }
        if($request->hasFile('banner_image') && $images = $request->file('banner_image')) {
            foreach($images as $image) {
                $category->addMedia($image)->toMediaCollection('banner_image');
            }
        }

        if($request->has('product')){
            $category->product()->sync($request->input('product'));
        }

        if($request->save){
        return redirect()->route('category.index')->with('success', 'Category created successfully');
          }else{
            return redirect()->back();
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('category_edit'), 403);
        $category = Category::findOrFail($id);
        $product=Product::all();
        return view('admin.category.edit', compact('category','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $validatedData = $request->validate([
        //     // Define your validation rules here based on your requirements
        // ]);
        
        
        $category = Category::findOrFail($id);
        
        $category['category_parent_id'] = $category['category_parent_id'] ? $category['category_parent_id'] : 0;

        // Update category
        $category->update($request->all());

        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $category->clearMediaCollection('thumbnail_image');
            $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }      
        if($request->hasFile('banner_image') && $images = $request->file('banner_image')) {
            foreach($images as $image) {
                $category->addMedia($image)->toMediaCollection('banner_image');
            }
        }

        if($request->has('product')){
            $category->product()->sync($request->input('product'));
        }

        return redirect()->route('category.index')->with('success', 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete category
        $category->delete();

        return redirect()->route('category.index')->with('success', 'category deleted successfully');
    }
    public function deleteImage($id)
    {
        Media::where('id', $id)->delete();
        return response()->json(['success', 'image delete successfully'], 200);
    }
}
