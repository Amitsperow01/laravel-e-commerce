<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Block;
use App\Models\Category;
use App\Models\Product;


class HomeController extends Controller
{
    public function index() {
        $sliders=Slider::where('status',1)->get();
        $blocks=Block::where('status',1)->get();
        $featured = Product::where('is_featured', 1)->limit(8)->orderBy('id', 'ASC')->get();
        return view('website.home',compact('sliders','blocks','featured'));
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function page($url_key)
    {
        $page=Page::where('url_key',$url_key)->first();
        // return view('website.page',compact('page'));
        if ($page) {
            return view('website.page', compact('page'));
        } else {
            abort(403);
        }
    }

    public function categories($url_key)
    {
        // echo $url_key;
        $categories=Category::where('url_key',$url_key)->where('status',1)->first();
        return view('website.category',compact('categories'));
    }
    
    // getting product data by this method
    public function product($url_key)
    {
        $products = Product::where('url_key', $url_key)->where('status',1)->first();
        $productAttributes = ProductAttribute::where('product_id', $products->id)->get();
        $attributes = [];
            foreach ($productAttributes as $productAttribute) {
                $attributeId = $productAttribute->attribute_id;
                $attributeValueId = $productAttribute->attribute_value_id;
                $attribute = Attribute::find($attributeId);
                $attributeValue = AttributeValue::find($attributeValueId);
                
                if ($attribute && $attributeValue) {
                    if (!isset($attributes[$attribute->name])) {
                        $attributes[$attribute->name] = [];
                    }
                    $attributes[$attribute->name][] = $attributeValue;
                }
            }
        return view('website.product', compact('products', 'attributes'));
    }
}
