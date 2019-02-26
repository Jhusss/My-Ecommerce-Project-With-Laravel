@extends('layouts.frontLayout.frontend')

@section('content')

<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            
            @foreach ($banners as $banner)
                   
            <li>
              <div class="seq-model">
                <img data-seq src="{{ asset('images/banners/'. $banner->image) }}" alt="Men slide img" />
              </div>
              <div class="seq-title">
               <span data-seq>Save Up to 75% Off</span>                
                <h2 data-seq>{{ $banner->title }}</h2>                
                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
              
            @endforeach
                        
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                  <li><a href="{{ route('front') }}">All Items</a></li>
                    @foreach ($categories as $category)
                    @if($category->status == 1)
                      <li><a href="{{ route('products.list', $category->url) }}">{{ $category->title }}</a></li>
                    @endif
                   @endforeach         
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    <div class="tab-pane fade in active">
                    
                      <ul class="aa-product-catg">
                        <!-- start single product item -->            
                        @foreach ($productsAll as $product)
                          @if($product->status == 1)                           
                            <li class="{{ $product->category->title ? 'active' : ''}}">
                              <figure>
                                <a class="aa-product-img" href="#"><img style="width: 250px !important; height:300px !important;" src="{{ asset('/images/products/large/' . $product->product_image) }}" alt="{{ $product->title }}"></a>
                                <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                  <figcaption>
                                  <h4 class="aa-product-title"><a href="#">{{ $product->title }}</a></h4>
                                  <span class="aa-product-price">PHP {{ number_format($product->price,2) }}</span>
                                </figcaption>
                              </figure>                        
                              <div class="aa-product-hvr-content">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                                <a href="#p-{{ $product->id }}" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal"><span class="fa fa-search"></span></a>                          
                              </div>
                              <!-- product badge -->
                              <span class="aa-badge aa-sale" href="#">SALE!</span>
                            </li>
                          @endif
                        @endforeach  
                               
                      </ul>
                    
                      <div class="text-center">
                          {{$productsAll->links()}}
                      </div>
                    
                    </div>
                    <!-- / men product category -->
 
                  </div>
                  
                  



                  
                  <!--=========== MODAL FOR PRODUCTS ===========-->
                  @foreach ($productsAll as $product)
                        
                  <!-- quick view modal -->   
                    <!-- MODAL -->
                    
                    
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
                                            <a class="simpleLens-lens-image" data-lens-image="{{ asset('/images/products/large/' . $product->product_image) }}">
                                                <img id="mainImage" src="{{ asset('/images/products/large/' . $product->product_image) }}" class="simpleLens-big-image">
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
                                <h3>{{ $product->title }}</h3>
                                  <div class="aa-price-block">
                                      <span class="aa-product-view-price" id="getPrice1">PHP {{ $product->price }}</span>
                                
                                        {{-- <p class="aa-product-avilability">Availability: <span id="availability1">@if($total_count->stock > 0) In Stock @else Out of Stock @endif</span></p> --}}
  
                                  
                                    </div>
                                  <p>{{ $product->description }}</p>
                                  
                                  <div class="aa-prod-view-size">
                                      <h4>Size</h4>
                                      <select name="size" id="selSize1" class="form-control">
                                          <option value="">Select Size</option>
                                          @foreach($product->attributes as $sizes)
                                            <option value="{{ $product->id }}-{{ $sizes->size}}">{{ $sizes->size}}</option>
                                          @endforeach
                                      </select><br>
                                  </div>
                                  <div class="aa-prod-quantity">
                                      {{-- <input type="number" name="quantity" min="1" class="form-control" required> --}}
                                    <p class="aa-prod-category">
                                      Category: <a href="{{ route('category.list', $product->category->url) }}">{{ $product->category->title }}</a>
                                    </p>
                                  </div>
                                  <div class="aa-prod-view-bottom">
                                    {{-- <a href="#" id="cartButton1" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a> --}}
                                    <a href="{{ route('products.details', $product->id) }}" class="aa-add-to-cart-btn">View Details</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>                        
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- / quick view modal -->   
                      
                   
                      
                  @endforeach 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
              {{-- <a href="#"><img width="100%" height="120px" src="{{ asset('images/frontend_images/fashionban.jpg') }}" alt="fashion banner img"></a> --}}
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  {{-- <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#popular" data-toggle="tab">Popular</a></li>
                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#latest" data-toggle="tab">Latest</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="popular">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset('images/frontend_images/man/polo-shirt-2.png') }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                          <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
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
                                                                                
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / popular product category -->
                
                <!-- start featured product category -->
                <div class="tab-pane fade" id="featured">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset('images/frontend_images/man/polo-shirt-2.png') }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                          <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
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
                                                                                
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="latest">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="{{ asset('images/frontend_images/man/polo-shirt-2.png') }}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                          <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
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
                                                                                        
                  </ul>
                   <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section> --}}
  <!-- / popular section -->
  <!-- Support section -->
  {{-- <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- / Support section -->


  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-java.png') }}" alt="java img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-jquery.png') }}" alt="jquery img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-html5.png') }}" alt="html5 img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-css3.png') }}" alt="css3 img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-wordpress.png') }}" alt="wordPress img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-joomla.png') }}" alt="joomla img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-java.png') }}" alt="java img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-jquery.png') }}" alt="jquery img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-html5.png') }}" alt="html5 img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-css3.png') }}" alt="css3 img"></a></li>
              <li><a href="#"><img src="{{ asset('images/frontend_images/client-brand-wordpress.png') }}" alt="wordPress img"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->

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

  <script src="{{ asset('js/frontendjs/sequence.js') }}"></script>
  <script src="{{ asset('js/frontendjs/sequence-theme.modern-slide-in.js') }}"></script>  
@endsection