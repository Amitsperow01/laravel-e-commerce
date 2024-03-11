<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Gate;
use App\Models\AttributeValue;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('category_index'), 403);
        $attributes = Attribute::all();
        return view('admin.attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('category_index'), 403);

        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_variant' => 'required'
        ],
        [
            'name' => 'The Name field is required.',
            'status' => 'The Status field is required.',
            'is_variant' => 'The Is Variant field is required.'
        ]
    );

        $data = $request->all();

        // echo $data['name_key'];

        $nameKey = $data['name_key'] ? $data['name_key'] : $data['name'];

        $data['name_key'] =  generateNameKey($nameKey);

        // echo $data['name_key'];
        // die();


        $attributeData = Attribute::create($data);
        $attribute_id = $attributeData->id;

        $attribute_value_name = $request->input('attribute_value_name');

        foreach($attribute_value_name as $key => $attributeValueName) {
            AttributeValue::create([
                'attribute_id' => $attribute_id,
                'name' => $attributeValueName,
                'status' => $request->attribute_value_status[$key]
            ]);
        }

        if($request->get('action')=='save'){
            return redirect()->route('attribute.index')->with('success', 'Attribute added successfully.');
        } else {
            return redirect()->back()->with('success', 'Attribute added successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attributeData = Attribute::find($id);
        return view('admin.attribute.show', compact('attributeData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('category_index'), 403);
        $attribute = Attribute::where('id', $id)->first();
        return view('admin.attribute.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token', '_method');

        Attribute::where('id', $id)->update([
            'name' => $data['name'],
            'status' => $data['status'],
            'is_variant' => $data['is_variant']
        ]);

        $attributeId = $request->attributeId;

        if(empty($attributeId)) {
            AttributeValue::where('attribute_id', $id)->delete();
        } else {
            AttributeValue::whereNotIn('id', $attributeId)->where('attribute_id', $id)->delete();
        }

        $attribute_value_name = $request->input('attribute_value_name');

        if(!empty($request->attribute_value_name)) {
        foreach($attribute_value_name as $key => $attributeValueName) {
            // echo $attributeValueName;
            $attrId = $request->attributeId[$key]??0;
            if($attrId) {
            AttributeValue::where('id', $attrId)->update([
                'name' => $attributeValueName,
                'status' => $request->attribute_value_status[$key]
            ]);
        } else {
            AttributeValue::create([
                'name' => $attributeValueName,
                'status' => $request->attribute_value_status[$key],
                'attribute_id' => $id
            ]); 
        }

        } // foreach end

    } // if statement end

    return redirect()->route('attribute.index')->with('success','Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AttributeValue::where('attribute_id', $id)->delete();
        Attribute::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Attribute deleted successfully.');
    }
}
