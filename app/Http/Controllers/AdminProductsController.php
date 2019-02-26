<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\ProductsImage;
use Image;
use App\ProductsAttribute;
use DB;
use Session;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Product;
use App\User;
use App\Category;
use App\Size;
use App\Http\Requests\ProductsRequest;
use App\Banner; 

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* ============================== ADMIN PRODUCTS CRUD ============================== */ 


    public function index()
    {
        $products = Product::with('category','attributes','alternateimages')->latest()->paginate(12);
    

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::get();
        
        return view('admin.products.create', compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request, Product $product)
    {
        $input = $request->all();

        $product->title = $input['title'];
        $product->price = $input['price'];
        $product->category_id = $input['category_id'];
        $product->description = $input['description'];;
        
        if(empty($input['status'])){
            $status = 0;    
        } else {
            $status = 1;
        }

        $product->status = $status;


        if(empty($request->feature_item)){
            $product->feature_item = 0;    
        } else {
            $product->feature_item = 1;   
        }

        if($request->hasFile('photo'))
        {
           $image_tmp = Input::file('photo');
           if($image_tmp->isValid()){
               
                $filename = time(). $image_tmp->getClientOriginalName();
                $large_image_path = 'images/products/large/' . $filename;
                $medium_image_path = 'images/products/medium/' . $filename;
                $small_image_path = 'images/products/small/' . $filename;

                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(470,500)->save($medium_image_path);
                Image::make($image_tmp)->resize(270,300)->save($small_image_path);               

               $product->product_image = $filename;
           }


        }

        $product->save();       

       return redirect()->route('products.index')->with('success', 'New product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();

        return view("admin.products.edit", compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    { 
        $this->validate($request, [
        
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);


        if($request->hasFile('photo'))
        {
           $image_tmp = Input::file('photo');
           if($image_tmp->isValid()){
               $filename = time(). $image_tmp->getClientOriginalName();
               $large_image_path = 'images/products/large/' . $filename;
               $medium_image_path = 'images/products/medium/' . $filename;
               $small_image_path = 'images/products/small/' . $filename;

               Image::make($image_tmp)->save($large_image_path);
               Image::make($image_tmp)->resize(470 ,500)->save($medium_image_path);
               Image::make($image_tmp)->resize(270,300)->save($small_image_path);

               $oldfile = $product->product_image;

               $large_image_path_old =  'images/products/large/' . $oldfile;
               $medium_image_path_old = 'images/products/medium/' . $oldfile;
               $small_image_path_old = 'images/products/small/' . $oldfile;

                unlink($large_image_path_old);
                unlink($medium_image_path_old);
                unlink($small_image_path_old);
                
               $product->product_image = $filename;

           } else {

                $filename = $request->current_image;
           }


        }

        if(empty($request->status)){
            $status = 0;    
        } else {
            $status = 1;
        }

        if(empty($request->feature_item)){
            $product->feature_item = 0;    
        } else {
            $product->feature_item = 1;   
        }
        
        $product->status = $status;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $oldfile = $product->product_image;

        $large_image_path_old =  'images/products/large/' . $oldfile;
        $medium_image_path_old = 'images/products/medium/' . $oldfile;
        $small_image_path_old = 'images/products/small/' . $oldfile;

        unlink($large_image_path_old);
        unlink($medium_image_path_old);
        unlink($small_image_path_old);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

/* ============================== ATTRIBUTES AND ALTERNATE IMAGES ============================== */ 

    public function addAttributes(Request $request, Product $product)
    {
        if($request->isMethod('POST')){
           $data = $request->all();

           foreach($data['sku'] as $key => $val){
               if(!empty($val)){

                   $attrCountSKU = ProductsAttribute::where('sku', $val)->count();
                   if($attrCountSKU>0){
                       return back()->with('error', 'SKU already exists for this product! Please input another SKU.');
                   }

                   $attrCountSizes = ProductsAttribute::where(['product_id' => $product->id, 'size' => $data['size'][$key]])->count();
                   if($attrCountSizes>0){
                       return back()->with('error', 'Size already exists for this product! Please input another Size.');
                   }
                   $attribute = new ProductsAttribute;
                   $attribute->product_id = $product->id;
                   $attribute->sku = $val;              
                   $attribute->size = $data['size'][$key];
                   $attribute->price = $data['price'][$key];
                   $attribute->stock = $data['stock'][$key];
                   $attribute->save();

                 
               }
           }
           return back()->with('success', 'New Attributes added successfully.');
        }

        $sizes = Size::get();
        return view('admin.products.add_attributes',compact('product','sizes'));
    }
    
    public function editAttributes(Request $request, Product $product)
    {
        if($request->isMethod('post')){
            
            foreach ($request->idAttr as $key => $attr) {
                ProductsAttribute::where(['id' => $request->idAttr[$key]])->update(['price' => $request->price[$key],'stock'=>$request->stock[$key]]);
            }
        return back()->with('success', 'Product Attributes updated successfully.');
        
        }

    }
    public function addAlternateImages(Request $request, Product $product)
    {

        if($request->isMethod('post')){  
            if($request->hasFile('photo')){
                $files = $request->file('photo');  
                foreach ($files as $file) {
                     
                    //Upload images
                    
                    $image = new ProductsImage;
                    $filename = time(). $file->getClientOriginalName();
                    $large_image_path = 'images/products/large/'.$filename;
                    $medium_image_path = 'images/products/medium/'.$filename;
                    $small_image_path = 'images/products/small/'.$filename;

                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(470,500)->save($medium_image_path);
                    Image::make($file)->resize(270,300)->save($small_image_path);

                    $image->image = $filename;
                    $image->product_id = $request->product_id;
                    $image->save();
                }
                
                return back()->with('success','Successfully added alternate images!');
            }
           
        }
        
        $productsImages  = ProductsImage::where('product_id', $product->id)->get();

        return view('admin.products.add_alternate_img', compact('product','productsImages'));
    }

    public function destroyAttribute($id)
    {
        ProductsAttribute::where(['id' => $id])->delete();

        return back()->with('success', 'Attributes deleted successfully.');
    }

    public function destroyAlternateImages(ProductsImage $productimage)
    {

        $file = $productimage->image;

        $large_image_path_old =  'images/products/large/' . $file;
        $medium_image_path_old = 'images/products/medium/' . $file;
        $small_image_path_old = 'images/products/small/' . $file;

        unlink($large_image_path_old);
        unlink($medium_image_path_old);
        unlink($small_image_path_old);

        $productimage->delete();

        return back()->with('success', 'Product alternate image deleted successfully.');
    }


/* ============================== PRODUCTS FRONT PAGE ============================== */ 





/* ============================== SHOW ALL PRODUCTS (SUB PART) ============================== */ 

public function products($url)
    {
        $countCategory = Category::where(['url' => $url , 'status' => 1])->count();
        if($countCategory == 0){
            abort(404);
        }
        $banners = Banner::where('status', 1)->get();
        $categories = Category::all();
        $categoryLists = Category::where(['url' => $url])->first();
        
        $productsAll = Product::where(['category_id' => $categoryLists->id])->where('status',1)->paginate(8);
       

       
        
        return view('products.listing', compact('categoryLists', 'productsAll', 'categories','banners'));
    }

/* ============================== SHOW ALL PRODUCTS PER CATEGORY (MAIN PART) ============================== */ 

    public function category($url)
    {
        //url
        $categories = Category::all();
        $categoryLists = Category::where(['url' => $url, 'status' => 1])->first();
        
        $catproducts = Product::where(['category_id' => $categoryLists->id])->paginate(10);

        return view('products.category', compact('categoryLists', 'catproducts','categories'));
    }


    public function searchProducts(Request $request)
    {
        if($request->isMethod('post')){

            // echo "<pre>"; print_r($request->all()); die;
            $categories = Category::all();
            $search_product = $request->product;
            // $categoryLists = Category::where(['url' => $url, 'status' => 1])->first();
            $catproducts = Product::where('title','like','%'.$search_product.'%')->where('status', 1)->get();
            
            return view('products.category', compact('search_product', 'catproducts','categories'));
        }
    }

/* ============================== SHOW PRODUCT DETAILS ============================== */ 

    public function product($id)
    {   
        $productsCount = Product::where(['id' => $id, 'status' => 1])->count();
        if($productsCount == 0){
            abort(404);
        }

        $categories = Category::all();
        $productDetails = Product::with('attributes','category','alternateimages')->where(['id' => $id])->first();
        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->where('status', 1)->get();
        // foreach ($relatedProducts->chunk(3) as $chunk) {
        //     foreach($chunk as $item){
        //         echo $item; echo "<br>";
        //     }
        //     echo "<br><br><br>";
        // }
        // die;
        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        return view ('products.detail', compact('productDetails', 'categories', 'total_stock', 'relatedProducts'));
    }

    public function getProductPrice(Request $request)
    {
        $input = $request->all();
        // echo "<pre>"; print_r ($input); die;
        $proArr = explode("-", $input['idSize']);
        // echo $proArr[0]; echo $proArr[1]; die;
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1]])->first();

        echo $proAttr->price;
        echo "#";   
        echo $proAttr->stock;
    }   

    public function getProductPrice1(Request $request)
    {
        $input = $request->all();
        // echo "<pre>"; print_r ($input); die;
        $proArr = explode("-", $input['idSize']);
        // echo $proArr[0]; echo $proArr[1]; die;
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1]])->first();

        echo $proAttr->price;
        echo "#";   
        echo $proAttr->stock;
    }  




/* ============================== CART PAGE ============================== */ 

    //Add to cart

    public function addtocart(Request $request)
    {
        // $data = $request->all();
        
        // echo "<pre>"; print_r($data); die;

        if(empty(Auth::user()->email)){
            $request->user_email = '';
        } else {
            $request->user_email = Auth::user()->email;
        }

        //check product stock is available or not 
        $product_size = explode("-", $request->size);
        // echo "<pre>"; print_r($product_size); die;
        $getProductStock = ProductsAttribute::where(['product_id'=>$request->product_id, 'size' => $product_size[1]])->first();
        //  echo $getProductStock->stock; die;

        if($getProductStock->stock < $request->quantity){
            return back()->with('error', 'Required quantity is not available');
        }
        $session_id = Session::get('session_id');
        if(!isset($session_id)){
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }

        $sizeArr = explode("-", $request->size);

        if(empty(Auth::check())){
            $countProducts = DB::table('cart')->where(['product_id'=>$request->product_id, 'size' => $sizeArr[1], 'session_id' => $session_id])->count();
            if($countProducts > 0) {
                return back()->with('error', 'Product already exist in the cart!'); 
            } 
        }else{

             $countProducts = DB::table('cart')->where(['product_id'=>$request->product_id, 'size' => $sizeArr[1], 'user_email' => $request->user_email])->count();
            if($countProducts > 0) {
                return back()->with('error', 'Product already exist in the cart!'); 
            } 
        }
       
            $getSKU = ProductsAttribute::select('sku')->where(['product_id' => $request->product_id, 'size' => $sizeArr[1]])->first();
            DB::table('cart')->insert(['product_id'=>$request->product_id, 'product_name' => $getSKU->sku, 'price' => $request->price, 'size' => $sizeArr[1], 'quantity' => $request->quantity, 'user_email' => $request->user_email, 'session_id' => $session_id]);        
        
        return back()->with('success', 'Product has been added to cart successfully.');
    }

    public function cart()
    {   
        
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
        }else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
        }
        
        foreach ($userCart as $key => $product) {
            
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->product_image;
        }
        // echo "<pre>"; print_r($userCart); die;
        $categories = Category::all();
        return view('products.cart', compact('userCart', 'categories', 'productDetails'));
    }

    public function deleteCartProduct($id)
    {
        DB::table('cart')->where('id', $id)->delete();

        return back()->with('success', 'Product deleted from cart successfully.');
    }


    public function updateCartQuantity($id, $quantity) 
    {
        $getCartDetails = DB::table('cart')->where('id', $id)->first();
        $getAttributeStock = ProductsAttribute::where('sku', $getCartDetails->product_name)->first();
        $getAttributeStock->stock; echo "--";
        $updated_quantity = $getCartDetails->quantity+$quantity;
        
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id', $id)->increment('quantity',$quantity);
            return back()->with('success', 'Product quantity has been updated successfully.');
        }else {
            return back()->with('error', 'Maximum product quantity reached.'); 
        }
        

    }

/* ============================== CHECKOUT PAGE ============================== */ 

    public function checkout(Request $request)
    {   
        $userDetails = User::find(Auth::user()->id);

        

        //check if shipping address exists!
        $shippingCount = DeliveryAddress::where('user_id', Auth::user()->id)->count();
        $shippingDetails = array();
        if($shippingCount > 0){
            $shippingDetails = DeliveryAddress::where('user_id', Auth::user()->id)->first(); 
        }
        
        //update user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=> Auth::user()->email]);


        if($request->isMethod('post')){

            if(empty($request->billing_name) || empty($request->billing_address) || empty($request->billing_city) || empty($request->billing_country) || empty($request->billing_pincode) || empty($request->billing_mobile) || empty($request->shipping_name) || empty($request->shipping_address) || empty($request->shipping_city) || empty($request->shipping_country) || empty($request->shipping_pincode) || empty($request->shipping_mobile)){
                return back()->with('error', 'Please fill in all fields to checkout!');
            }
            
            //Update user details
           
            User::where('id', Auth::user()->id)->update(['name'=>$request->billing_name, 'address' => $request->billing_address, 'city' => $request->billing_city, 'country' => $request->billing_country, 'pincode' => $request->billing_pincode, 'mobile' => $request->billing_mobile]);

            if($shippingCount>0){
                //Update Shipping Address
                DeliveryAddress::where('user_id', Auth::user()->id)->update(['name'=>$request->shipping_name, 'address' => $request->shipping_address, 'city' => $request->shipping_city, 'country' => $request->shipping_country, 'pincode' => $request->shipping_pincode, 'mobile' => $request->shipping_mobile]);
            }else{
                //Add New Shipping Address
                if(empty($request->shipping_name) || empty($request->shipping_address) || empty($request->shipping_city) || empty($request->shipping_country) || empty($request->shipping_pincode) || empty($request->shipping_mobile)){
                    return back()->with('error', 'Please fill in all fields to checkout!');
                }
                $shipping = new DeliveryAddress;
                $shipping->user_id = Auth::user()->id;
                $shipping->user_email =  Auth::user()->email;
                $shipping->name = $request->shipping_name;
                $shipping->address = $request->shipping_address;
                $shipping->city = $request->shipping_city;
                $shipping->country = $request->shipping_country;
                $shipping->pincode = $request->shipping_pincode;
                $shipping->mobile = $request->shipping_mobile;

                $shipping->save();
            }
            return redirect()->action('AdminProductsController@orderReview');
        }

        $countries = Country::get();
        $categories = Category::get();
        return view('products.checkout', compact('categories', 'userDetails', 'countries','shippingDetails'));

    }

    public function orderReview() 
    {
        $userDetails = User::where('id', Auth::user()->id)->first();
        $shippingDetails = DeliveryAddress::where('user_id', Auth::user()->id)->first(); 
        // $shippingDetails = json_decode(json_encode($shippingDetails));
        // echo "<pre>"; print_r($shippingDetails); die;

        $userCart = DB::table('cart')->where(['user_email' => Auth::user()->email])->get();
        foreach ($userCart as $key => $product) {
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->product_image;
        }
        // echo "<pre>"; print_r($userCart); die;
        
        $categories  = Category::all();
        return view('products.order_review',compact('categories','shippingDetails', 'userDetails','userCart'));
    }

    public function placeOrder(Request $request)
    {
        if($request->isMethod('post')){
            // echo Auth::user()->id;
            // echo Auth::user()->email;

            //get Shipping Address of User

            $shippingDetails = DeliveryAddress::where(['user_email' => Auth::user()->email])->first();
            // $shippingDetails = json_decode(json_encode($shippingDetails));
            // echo "<pre>"; print_r($shippingDetails); die;
            // echo "<pre>"; print_r($request->all()); die;

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->user_email = Auth::user()->email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->country = $shippingDetails->country;
            $order->pincode = $shippingDetails->pincode;
            $order->mobile = $shippingDetails->mobile;
            $order->shipping_charges = $request->shipping_charge;
            $order->order_status = "New";
            $order->payment_method = $request->payment_method;
            $order->grand_total = $request->grand_total; 
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();
            $cartProducts = DB::table('cart')->where(['user_email' => Auth::user()->email])->get();

            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = Auth::user()->id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_quantity = $pro->quantity;
                $cartPro->save();
            }
            Session::put('order_id', $order_id);
            Session::put('grand_total', $request->grand_total);

            if($request->payment_method == "cod"){
                // Code for Order Email
                $productDetails = Order::with('orders')->where('id', $order_id)->first();
                // $productDetails = json_decode(json_encode($productDetails), true);
                // echo "<pre>"; print_r($productDetails); die;

                $userDetails = User::where('id', Auth::user()->id)->first();
                // $userDetails = json_decode(json_encode($userDetails), true);
                // echo "<pre>"; print_r($userDetails); die;
                
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ]; 
                Mail::send('emails.order', $messageData, function($message) use($email){
                    $message->to($email)->subject('Order Placed - Ailoveyu International');
                });

                //COD REDIRECT PAGE
                return redirect('/thanks');
            } else {

                return redirect('/paypal');
            }
            
            
        }
    }

    public function thanks(Request $request)
    {
        DB::table('cart')->where('user_email', Auth::user()->email)->delete();
        $categories = Category::all();
        return view('orders.thanks', compact('categories'));
    }

    public function paypal(Request $request)
    {
        DB::table('cart')->where('user_email', Auth::user()->email)->delete();
        $categories = Category::all();
        return view('orders.paypal', compact('categories'));
    }

    public function userOrders()
    {
        $orders = Order::with('orders')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        // $orders = json_decode(json_encode($orders));
        // echo "<pre>"; print_r($orders); die;
        $categories = Category::get();
        return view('products.users_orders',compact('categories','orders'));
    }

    public function userOrderDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where('user_id', Auth::user()->id)->first();
        // $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        $categories = Category::get();
        return view('orders.user_order_details', compact('categories', 'orderDetails'));
    }


    

/* ============================== ADMIN VIEW ORDERS PAGE ============================== */ 
    public function viewOrders()
    {
        $orders = Order::with('orders')->orderBy('id','DESC')->get();
        // $orders = json_decode(json_encode($orders));
        // echo "<pre>"; print_r($orders); die;
        return view('admin.orders.view_orders',compact('orders'));
    }

    public function viewOrderDetails($id)
    {
        $orderDetails  = Order::with('orders')->where('id', $id)->first();
        // $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;

        // $user_id = $orderDetails->user_id;
        $userDetails = User::where('id' , $orderDetails->user_id)->first();
        // $userDetails = json_decode(json_encode($userDetails));
        // echo "<pre>"; print_r($userDetails); die;

        return view('admin.orders.order_details',compact('orderDetails','userDetails'));
    }

    public function viewOrderInvoice($id)
    {
        $orderDetails  = Order::with('orders')->where('id', $id)->first();
        // $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;

        // $user_id = $orderDetails->user_id;
        $userDetails = User::where('id' , $orderDetails->user_id)->first();
        // $userDetails = json_decode(json_encode($userDetails));
        // echo "<pre>"; print_r($userDetails); die;

        return view('admin.orders.order_invoice',compact('orderDetails','userDetails'));
    }



    public function updateOrderStatus(Request $request)
    {
        // if($request->isMethod('post')){
        //     $data = $request->all();
        //     echo "<pre>"; print_r($data); die;
        // }

        Order::where('id', $request->order_id)->update(['order_status'=>$request->order_status]);

        return back()->with('success','Order status has been updated successfully.');
    }

    
   
}
