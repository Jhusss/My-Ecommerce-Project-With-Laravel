@extends('layouts.frontLayout.frontend')

@section('content')


    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
      {{-- <img src="{{ asset('images/frontend_images/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img"> --}}
      <img src="{{ asset('images/frontend_images/dress.jpg')}}" width="100%" height="320px" alt="fashion img">
      <div class="aa-catg-head-banner-area">
        <div class="container">
         <div class="aa-catg-head-banner-content">
          <h2>{{ $productDetails->category->title }}</h2>
           <ol class="breadcrumb">
             <li><a href="{{ route('front') }}">Home</a></li>     
             <li class="active">{{ $productDetails->title }}</li>    
           </ol>
         </div>
        </div>
      </div>
     </section>
     <!-- / catg header banner section -->

     <!-- product category -->
     
     <section id="aa-product-details">
       <div class="container">
         
         <div class="row">
           
           <div class="col-md-12">
             <div class="aa-product-details-area">
                @include('layouts.message')
               <div class="aa-product-details-content">
                 <div class="row">
                   <!-- Modal view slider -->
                   <div class="col-md-5 col-sm-5 col-xs-12">                              
                     <div class="aa-product-view-slider">                                
                       <div id="demo-1" class="simpleLens-gallery-container">
                         <div class="simpleLens-container">
                            <div class="simpleLens-big-image-container">
                                <a data-lens-image="{{ asset('images/products/large/'.$productDetails->product_image) }}" class="simpleLens-lens-image">
                                  <img src="{{ asset('images/products/large/'.$productDetails->product_image) }}" id="mainImage" class="simpleLens-big-image">
                                </a>
                            </div>
                         </div>
                         @if($productDetails->alternateimages)
                         <div class="simpleLens-thumbnails-container">
                            <a data-big-image="{{ asset('images/products/medium/'.$productDetails->product_image) }}" data-lens-image="{{ asset('images/products/large/'.$productDetails->product_image) }}" class="simpleLens-thumbnail-wrapper" href="#">
                              <img class="changeImage" width="90px" height="90px" src="{{ asset('images/products/large/'.$productDetails->product_image) }}">
                            </a>
                            @foreach ($productDetails->alternateimages as $altimage)    
                              <a data-big-image="{{ asset('images/products/large/'.$altimage->image) }}" data-lens-image="{{ asset('images/products/large/'.$altimage->image) }}" class="simpleLens-thumbnail-wrapper" href="#">
                                <img class="changeImage" width="90px" height="90px" src="{{ asset('images/products/large/'.$altimage->image) }}">
                              </a>
                            @endforeach
                         </div>
                         @endif
                       </div>
                     </div>
                   </div>

                   <!-- Modal view content -->
                   
                   <div class="col-md-7 col-sm-7 col-xs-12">
                      
                      <form id="addtocartForm" action="{{ route('add-cart') }}" method="POST">
                        @csrf
                          <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                          <input type="hidden" name="product_name" value="{{ $productDetails->title }}">
                          <input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
                         
                          <div class="aa-product-view-content">
                            <h3>{{ $productDetails->title }}</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price" id="getPrice">PHP {{ $productDetails->price }}</span>
                              <p class="aa-product-avilability">Availability: <span id="availability">@if($total_stock > 0) In Stock @else Out of Stock @endif </span></p>
                            </div>
                            <p>{{ $productDetails->description }}</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">                       
                                <select name="size" id="selSize" class="form-control" required>
                                  <option value="">Select Size</option>
                                  @foreach($productDetails->attributes as $sizes)
                                    <option value="{{ $productDetails->id }}-{{ $sizes->size}}">{{ $sizes->size}}</option>
                                  @endforeach
                                </select>
                                                          
                            </div>
                            <div class="aa-prod-quantity">
                                <input type="number" name="quantity" min="1" class="form-control" required>

                              <p class="aa-prod-category">
                                Brand: <a href="#">{{ $productDetails->category->title }}</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              @if( $total_stock > 0)
                               <button type="submit" id="cartButton" class="btn btn-warning btn-lg"><span class="fa fa-shopping-cart"> Add to Cart</span></button>
                              @endif
                              <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                              <a class="aa-add-to-cart-btn" href="#">Compare</a>
                            </div>
                          </div>
                      </form>
                   </div>
                 </div>
               </div>
               <div class="aa-product-details-bottom">
                 <ul class="nav nav-tabs" id="myTab2">
                   <li><a href="#description" data-toggle="tab">Description</a></li> 
                   <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>         
                 </ul>
   
                 <!-- Tab panes -->
                 <div class="tab-content">
                   <div class="tab-pane fade in active" id="description">
                    <div class="col-sm-12">
                      <p class="text-center"> {{ $productDetails->description }}</p>  
                    </div>
                    
                   </div>

                   <div class="tab-pane fade active" id="delivery">
                      <div class="col-sm-12">
                        <p>All orders are subject to product availability. If an item is not in stock at the time you place your order, we will notify you and refund you the total amount of your order, using the original method of payment. </p>
                        <p>Any shipments outside of Japan are not available at this time.</p>
                        <p>Unless there are exceptional circumstances, we make every effort to fulfill your order within [15] business days of the date of your order. Business day mean Monday to Friday, except holidays.</p>
                        <p>Sales tax is charged according to the province or territory to which the item is shipped.</p>
                        <p>Free delivery on orders above ¥10,000.</p>
                      </div>
                    </div>
        
                 </div>
               </div>
               <!-- Related product -->

           
                
            
            <div class="aa-product-related-item">
                @if (count($relatedProducts) != 0)
                <h3>Related Products</h3>
                <ul class="aa-product-catg aa-related-item-slider">
                  <!-- start single product item -->
                  {{-- @php
                      $count=1;
                  @endphp --}}
                  @foreach($relatedProducts->chunk(4) as $chunk)
                    @foreach ($chunk as $item)
                    <li>
                      <figure>
                      <a class="aa-product-img" href="{{ route('products.details', $item->id) }}"><img height="300px" width="250px" src="{{ asset('images/products/small/' . $item->product_image) }}" alt="$item->title"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                          <h4 class="aa-product-title"><a href="#">{{ $item->title }}</a></h4>
                          <span class="aa-product-price">PHP {{ $item->price }}</span><span class="aa-product-price"></span>
                        </figcaption>
                      </figure>                     
                      <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                      </div>
                      <!-- product badge -->
                      <span class="aa-badge aa-sale" href="#">SALE!</span>
                    </li>
                    {{-- @php
                        $count++;
                    @endphp --}}

                    @endforeach
                   @endforeach
              
                                                                                                 
                </ul>
                <!-- quick view modal -->                  
                {{-- <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
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
                                        <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                            <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="simpleLens-thumbnails-container">
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                    </a>                                    
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                    </a>
  
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                       data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                        <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                    </a>
                                </div>
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
                </div> --}}
                <!-- / quick view modal -->  
                @endif 
              </div> 
              
              
             </div>
           </div>
         </div>
       </div>
     </section>
     <!-- / product category -->
@endsection