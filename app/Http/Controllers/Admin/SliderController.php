<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('page_index'), 403);
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('page_index'), 403);
        return view('admin.slider.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'ordering' => 'required',
            'status' => 'required'
        ]);

        $sliderData = Slider::create($data);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $sliderData->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('slider.index')->withSuccess('Slider Added Successfully ..');
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
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'ordering' => 'required',
            'status' => 'required'
        ]);
        $slider = Slider::findOrFail($id);

        $slider->update($data);

        if ($request->hasFile('image')) {
            $slider->clearMediaCollection('image');
            $slider->addMedia($request->file('image'))->toMediaCollection('image');
        }
        return redirect()->route('slider.index')->withSuccess('slider data updated successfully...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Slider::where('id', $id)->delete();
        return redirect()->back()->withSuccess('slider Delected successfully..');
    }
    public function deleteImage($id)
    {
        Media::where('id', $id)->delete();
        return response()->json(['success', 'image delete successfully'], 200);
    }
}
