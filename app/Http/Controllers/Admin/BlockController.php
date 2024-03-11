<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('page_index'), 403);
        $block=Block::all();
        return view('admin.block.index',compact('block'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
         abort_unless(Gate::allows('page_index'), 403);
        return view('admin.block.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'identifier'=>'required',
            'title'=>'required',
            'heading'=>'required',
            'description'=>'required',
            'ordering'=>'required',
            'status'=>'required'
        ]);

        $name = $request->identifier ? $request->identifier : $request->title;
        $identifier = generateUniqueidentifier($name);

        $block = block::create([
            'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'description' => $request->description,
            'identifier' => $identifier
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $block->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('block.index')->withSuccess('Slider Added Successfully ..');
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
        abort_unless(Gate::allows('page_index'), 403);

        $block=Block::findOrfail($id);
        return view('admin.block.edit',compact('block'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'identifier'=>'required',
            'title'=>'required',
            'heading'=>'required',
            'description'=>'required',
            'ordering'=>'required',
            'status'=>'required'
        ]);
        $name = $request->identifier ? $request->identifier : $request->title;
        $identifier = generateUniqueidentifier($name);

        $block=Block::findOrfail($id);

        $block->update([
            'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'description' => $request->description,
            'identifier' => $identifier
        ]);


        if($request->hasFile('image')){
            $block->clearMediaCollection('image');
            $block->addMedia($request->file('image'))->toMediaCollection('image');

        }
        return redirect()->route('block.index')->withSuccess('Block data updated successfully...');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Block::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Data Deleted Successfully');
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    public function deleteImage($id)
    {
        Media::where('id', $id)->delete();
        return response()->json(['success', 'image delete successfully'], 200);
    }
}
