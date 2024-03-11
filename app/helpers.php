<?php

use App\Http\Middleware\Authenticate;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\QuoteItem;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Block;
use App\Models\Quote;
use Illuminate\Support\Facades\Session;


if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Page::where('url_key', $urlKey)->exists();
    }
}



if (!function_exists('generateUniqueidentifier')) {
    function generateUniqueidentifier($name)
    {
        $baseSlug = Str::slug($name);
        $identifier = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (identifierExists($identifier)) {
            $identifier = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $identifier;
    }
}

if (!function_exists('identifierExists')) {
    function identifierExists($identifier)
    {
        // Assuming Product is your model name
        return \App\Models\Block::where('identifier', $identifier)->exists();
    }
}


function getpages()
{
    $pages = Page::where('status', 1)->where('parent_id', 0)->orderBy('ordering')->get();

    return $pages;
}

function getSubPages($id)
{
    $subPages = Page::where('parent_id', $id)->get();
    return $subPages;
}

//product url_key

if (!function_exists('productUrlKey')) {
    function productUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Product::where('url_key', $urlKey)->exists();
    }
}

//Category  url 

if (!function_exists('categoryUrlKey')) {
    function categoryUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming category is your model name
        return \App\Models\Category::where('url_key', $urlKey)->exists();
    }
}

//for CRUD category
function getCategories()
{
    $categories = Category::where('category_parent_id', 0)->get();
    return $categories;
}

function SubCategories($id)
{
    $subcategories = Category::where('category_parent_id', $id)->get();
    return $subcategories;
}
function SubSubCategories($id)
{
    $subcategories = Category::where('category_parent_id', $id)->get();
    return $subcategories;
}


// Attribute Name key

if (!function_exists('generateNameKey')) {
    function generateNameKey($name)
    {
        $baseKey = Str::lower($name);
        $nameKey = Str::replace(' ', '_', $baseKey);
        $counter = 1;

        while (nameKeyExists($nameKey)) {
            $nameKey = $nameKey . '_' . $counter;
        }
        return $nameKey;
    }
}

if (!function_exists('nameKeyExists')) {
    function nameKeyExists($nameKey)
    {
        return \App\Models\Attribute::where('name_key', $nameKey)->exists();
    }
}


//for front end
function frontategories()
{
    $categories = Category::where('category_parent_id', 0)->where('status', 1)->get();
    return $categories;
}


//for front end
function frontproduct()
{
    $products = Product::where('is_featured', 1)->where('status', 1)->get();
    return $products;
}

function productAttribute($product_id)
{
    $productAtt = Product::where('id',$product_id)->with('attributes')->first();
    return $productAtt;
    
}

//category url_key
if (!function_exists('categoryUrlKey')) {
    function categoryUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming category is your model name
        return \App\Models\Category::where('url_key', $urlKey)->exists();
    }
}

function getAttributes()
{
    $attributes = Attribute::with('attributeValues')->get();
    return $attributes;
}


function getProductPrice($pId)
{

    $todayDate = Carbon\Carbon::now();

    $product = Product::find($pId);

    if (($todayDate >= $product->special_price_from) && ($todayDate <= $product->special_price_to) and ($product->special_price)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
    // echo $mytime->toDateTimeString();
}

function cartSummaryCount()
{
    $cartId = Session::get('cart_id');
    if ($cartId) {
        $quote = Quote::where('cart_id', $cartId)->first();
        return ($quote->quoteItems??0)?$quote->quoteItems->count():0;
    } else {
        return 0;
    }
}

// recalculateCart helper

function recalculateCart()
{
    $cartId = Session::get('cart_id');
    $quote = Quote::where('cart_id', $cartId)->first();
    $quotesItems = $quote->quoteItems;

    foreach ($quotesItems as $item) {
        $item->row_total = $item->qty * $item->price;
        $item->save();
        // echo $item;
    }


    $quote->subtotal = $quote->quoteItems->sum('row_total');
    if ($quote->subtotal > $quote->coupon_discount) {
        $quote->total = $quote->subtotal - $quote->coupon_discount;
    } else {
        $quote->total = $quote->subtotal;
        $quote->coupon=null;
        $quote->coupon_discount=0;
    }
    $quote->save();
}

// get product image for view cart page

function productImage($pId)
{
    $product = Product::find($pId);
    return $product->getFirstMediaUrl('thumbnail_image');
}

function getProductSpecialPrice($pId)
{
    $todayDate = Carbon\Carbon::now();
    $product = Product::find($pId);
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate)) {
?>
        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
            ₹<?= $product->special_price ?></h3>
        <h4 class="font-weight-semi-bold mb-4"><del>₹<?= $product->price ?></del></h4>
    <?php

    } else {
        // return $product->price;
    ?>
        <h4 class="font-weight-semi-bold mb-4">₹<?= $product->price ?></h4>
<?php
    }
    return;

}


function successOrder()
    {
        $order = Order::orderBy('id','desc')->first();
        return $order;
        
    }

    function getblock()
    {
        $blocks = Block::where('status','1')->first();
        return $blocks;
        
    }

    function reActiveCart($userId) {
        $cartId = Session::get('cart_id');
     
    
        if($cartId) {
            Quote::where('cart_id', $cartId)->update([
                'user_id' => $userId
            ]);
        }
      
        if($cartId) {
            $quoteOld = Quote::where('user_id', $userId)->where('cart_id', '!=', $cartId)->first();
            
            if($quoteOld) {
                $newQuote = Quote::where('cart_id', $cartId)->first();
                // dd($newQuote);
                $quoteId = $newQuote->id??0;
                QuoteItem::where('quote_id', $quoteOld->id)->update(['quote_id' => $quoteId]);
                $quoteOld->delete();
            } 
            
    
        } else {
            $quote = Quote::where('user_id', $userId)->first();
            // dd($quote);
            if ($quote) {
                $cartId = $quote->cart_id;
                Session::put('cart_id', $cartId);
            }
        }
    
    
    }

?>