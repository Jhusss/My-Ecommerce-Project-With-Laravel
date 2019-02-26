<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; 
use App\Category;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Banner;

class IndexController extends Controller
{
    public function index(){
        $products = Product::with('category', 'attributes', 'alternateimages')->where('status', 1)->orderby('id','DESC')->paginate(12);
        $productsFeatured = Product::with('category', 'attributes', 'alternateimages')->where('status', 1)->where('feature_item',1)->orderby('id','DESC')->get();
       
        // $total_stock = ProductsAttribute::where('product_id', $products->id)->sum('stock');

        $total_stock = ProductsAttribute::sum('stock');
                  
        
        $categories = Category::all();

        $banners = Banner::where('status',1)->get();

        return view('index', compact('products', 'categories', 'total_stock','banners', 'productsFeatured'));
    }
}
