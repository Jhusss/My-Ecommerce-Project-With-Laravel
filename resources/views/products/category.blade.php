@extends('layouts.frontLayout.frontend')

@section('content')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="{{ asset('images/frontend_images/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         @if(!empty($search_product))
         <h2>{{ $search_product }}</h2>
         @else
           <h2>{{ $categoryLists->title }}</h2>
         @endif
         <ol class="breadcrumb">
           <li><a href="{{ route('front') }}">Home</a></li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->
  <!-- Start Promo section -->
 
  <!-- product category -->
  <section id="aa-product-category">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
            <div class="aa-product-catg-content">
              <div class="aa-product-catg-head">
                <div class="aa-product-catg-head-left">
                  <form action="" class="aa-sort-form">
                    <label for="">Sort by</label>
                    <select name="">
                      <option value="1" selected="Default">Default</option>
                      <option value="2">Name</option>
                      <option value="3">Price</option>
                      <option value="4">Date</option>
                    </select>
                  </form>
                  <form action="" class="aa-show-form">
                    <label for="">Show</label>
                    <select name="">
                      <option value="1" selected="12">12</option>
                      <option value="2">24</option>
                      <option value="3">36</option>
                    </select>
                  </form>
                </div>
                <div class="aa-product-catg-head-right">
                  <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                  <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                </div>
              </div>
              <div class="aa-product-catg-body">
                <ul class="aa-product-catg">
                  <!-- start single product item -->
                  @foreach ($catproducts as $product)
                      
                  <li>
                    <figure>
                      <a class="aa-product-img" href="{{ route('products.details', $product->id) }}"><img style="width: 250px !important; height:300px !important;" src="{{ asset('/images/products/large/' . $product->product_image) }}" alt="$product->title"></a>
                      <a class="aa-add-card-btn" href="{{ route('products.details', $product->id) }}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                        <h4 class="aa-product-title"><a href="{{ route('products.details', $product->id) }}">{{ $product->title }}</a></h4>
                        <span class="aa-product-price">PHP{{ number_format($product->price,2) }}</span><span class="aa-product-price"></span>
                        <p class="aa-product-descrip">{{ $product->description }}</p>
                      </figcaption>
                    </figure>                         
                    <div class="aa-product-hvr-content">
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                      <a data-toggle2="tooltip" data-placement="top" title="Quick View" href="#p-{{ $product->id }}" data-toggle="modal"><span class="fa fa-search"></span></a>                            
                    </div>
                    <!-- product badge -->
                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                  </li>

                  @endforeach
                  
                  
            
                                          
                </ul>

                @foreach ($catproducts as $product)
                <!-- quick view modal -->                  
                <div class="modal fade" id="p-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">                      
                      <div class="modal-body">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div class="row">
                          <!-- Modal view slider -->
                          <div class="col-md-6 col-sm-6 col-xs-12">                              
                            <div class="aa-product-view-slider">                                
                              <div class="simpleLens-gallery-container" id="demo-1">
                                <div class="simpleLens-container">
                                    <div class="simpleLens-big-image-container">
                                        <a class="simpleLens-lens-image" data-lens-image="{{ asset('images/products/large/' . $product->product_image) }} ">
                                            <img src="{{ asset('images/products/large/' . $product->product_image) }}" class="simpleLens-big-image">
                                        </a>
                                    </div>
                                </div>

                                @if($product->alternateimages->count() > 0)
                                <div class="simpleLens-thumbnails-container">
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                        data-lens-image="{{ asset('/images/products/large/' . $product->product_image) }}"
                                        data-big-image="{{ asset('/images/products/large/' . $product->product_image) }}">
                                        <img width='90px' height='90px' src="{{ asset('/images/products/large/' . $product->product_image) }}">
                                    </a>   
                                
                                  @foreach ($product->alternateimages as $altimage)
                                      
                                  
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                        data-lens-image="{{ asset('/images/products/large/' . $altimage->image) }}"
                                        data-big-image="{{ asset('/images/products/large/' .  $altimage->image) }}">
                                      <img width='90px' height='90px' class="changeImage" src="{{ asset('/images/products/large/' . $altimage->image) }}">
                                    </a>

                                  @endforeach
                                  
                              
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <!-- Modal view content -->
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="aa-product-view-content">
                              <h3>T-Shirt</h3>
                              <div class="aa-price-block">
                                <span class="aa-product-view-price">$34.99</span>
                                <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                              </div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                              <h4>Size</h4>
                              <div class="aa-prod-view-size">
                                <a href="#">S</a>
                                <a href="#">M</a>
                                <a href="#">L</a>
                                <a href="#">XL</a>
                              </div>
                              <div class="aa-prod-quantity">
                                <form action="">
                                  <select name="" id="">
                                    <option value="0" selected="1">1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                    <option value="4">5</option>
                                    <option value="5">6</option>
                                  </select>
                                </form>
                                <p class="aa-prod-category">
                                  Category: <a href="#">Polo T-Shirt</a>
                                </p>
                              </div>
                              <div class="aa-prod-view-bottom">
                                <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <a href="#" class="aa-add-to-cart-btn">View Details</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>                        
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- / quick view modal -->   

                @endforeach
              </div>
              <div class="text-center">
                  
                    {{ $catproducts->links() }}
              
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
            <aside class="aa-sidebar">
              <!-- single sidebar -->
              <div class="aa-sidebar-widget">
                <h3>Category</h3>
                <ul class="aa-catg-nav">
                 @foreach ($categories as $category)
                  <li><a href="{{ route('category.list', $category->url) }}">{{ $category->title }}</a></li>
                 @endforeach
                </ul>
              </div>
             
            </aside>
          </div>
         
        </div>
      </div>
    </section>
    <!-- / product category -->
  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="email" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->
@endsection