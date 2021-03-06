<?php use App\Product; ?>
@extends('layouts.front_layout.front_layout')

@section('content')
<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
				<li><a href="{{ url('/'.$product_Detail['category']['category_url']) }}">{{  $product_Detail['category']['category_name']}}</a> <span class="divider">/</span></li>
				<li class="active">{{  $product_Detail['product_name']}}</li>
			</ul>
            <div id="app">@{{  testmsg}}</div>
			<div class="row">
				<div id="gallery" class="span3">

					<a href="{{url('images/product_image/medium/'.$product_Detail['product_main_image'])  }}" title="{{ $product_Detail['product_name'] }}">
						<img src="{{url('images/product_image/medium/'.$product_Detail['product_main_image'])}}" style="width:100%" alt="Blue Casual T-Shirt"/>
					</a>
					<div id="differentview" class="moreOptopm carousel slide">
						<div class="carousel-inner">
							<div class="item active">
                                @foreach($product_Detail['images'] as $image)
								<a href="{{url('images/product_image/small/'.$image['image'])  }}">
                                     <img style="width:29%" src="{{url('images/product_image/small/'.$image['image'])  }} " alt=""/></a>

                                @endforeach
								</div>

						</div>
						<!--
									<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
						-->
					</div>

					<div class="btn-toolbar">
						<div class="btn-group">
							<span class="btn"><i class="icon-envelope"></i></span>
							<span class="btn" ><i class="icon-print"></i></span>
							<span class="btn" ><i class="icon-zoom-in"></i></span>
							<span class="btn" ><i class="icon-star"></i></span>
							<span class="btn" ><i class=" icon-thumbs-up"></i></span>
							<span class="btn" ><i class="icon-thumbs-down"></i></span>
						</div>
					</div>
				</div>
				<div class="span6">
                    @if(Session::has('error_message'))
 <div class="alert alert-danger alert-dismissible ">
 {{ Session::get('error_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

              @if(Session::has('success'))
 <div class="alert alert-success alert-dismissible "  style="margin-top:10px;">
 {{ Session::get('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
					<h3>{{ $product_Detail['product_name'] }}  </h3>
					<small>- {{ $product_Detail['brand']['name']}}</small>
					<hr class="soft"/>
					<small>{{ $total_stock }} items in stock</small>
					<form action="{{ url('add-to-cart') }}" method="POST" class="form-horizontal qtyFrm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product_Detail['id'] }}">
						<div class="control-group">
                            <?php $discountprice=Product::ProductDiscount($product_Detail['id']); ?>
							<h4 class="GetProductAttr">
                                  @if($discountprice>0)

                                       <del> Rs.{{ $product_Detail['product_price'] }}</del> Rs.{{ $discountprice }}
                                        @else
                                        Rs.{{ $product_Detail['product_price'] }}

                                        @endif


                            </h4>
								<select class="span2 pull-left" name="size" id="GetPrice" product_id="{{ $product_Detail['id']}}" required="">
                                     <option value="" >Select Size</option>
									@foreach ($product_Detail['attributes'] as $size)
                                            <option value="{{ $size['products_attributes_size'] }}" required >{{ $size['products_attributes_size'] }}</option>
                                    @endforeach
								</select>
								<input name="product_quantity" type="number" class="span1" placeholder="Qty." required="">
								<button type="submit" class="btn btn-large btn-primary pull-right" > Add to cart <i class=" icon-shopping-cart" ></i></button>
							</div>
						</div>
					</form>

					<hr class="soft clr"/>
					<p class="span6">
{{ $product_Detail['product_description'] }}
					</p>
					<a class="btn btn-small pull-right" href="#detail">More Details</a>
					<br class="clr"/>
					<a href="#" name="detail"></a>
					<hr class="soft"/>
				</div>

				<div class="span9">
					<ul id="productDetail" class="nav nav-tabs">
						<li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
						<li><a href="#profile" data-toggle="tab">Related Products</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="home">
							<h4>Product Information</h4>
							<table class="table table-bordered">
								<tbody>
									<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
									<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{ $product_Detail['brand']['name']}}</td></tr>
									<tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{ $product_Detail['product_code']}}</td></tr>
									<tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{ $product_Detail['product_color']}}</td></tr>
									@if(!empty($product_Detail['product_fabric']))
									<tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{ $product_Detail['product_fabric']}}</td></tr>
                                    @endif

                                    @if(!empty($product_Detail['product_pattern']))
									<tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{ $product_Detail['product_pattern']}}</td></tr>
								      @endif

                                      @if(!empty($product_Detail['product_sleeve']))
                                    <tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{ $product_Detail['product_sleeve']}}</td></tr>
								    @endif
                                    @if(!empty($product_Detail['product_fit']))
                                    <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{ $product_Detail['product_fit']}}</td></tr>
									@endif

                                    @if(!empty($product_Detail['product_occassion']))
                                    <tr class="techSpecRow"><td class="techSpecTD1">Occasion:</td><td class="techSpecTD2">{{ $product_Detail['product_occassion']}}</td></tr>
                                       @endif
								</tbody>
							</table>

							<h5>Washcare</h5>
							<p>{{ $product_Detail['product_wash_care']}} </p>
							<h5>Disclaimer</h5>
							<p>
								There may be a slight color variation between the image shown and original product.
							</p>
						</div>
						<div class="tab-pane fade" id="profile">
							<div id="myTab" class="pull-right">
								<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
								<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
							</div>
							<br class="clr"/>
							<hr class="soft"/>
							<div class="tab-content">
								<div class="tab-pane" id="listView">
                                    @foreach($Related_products as $product)


									<div class="row">
										<div class="span2">
										@if(@isset($product['product_main_image']))
						<?php $product_imgae_path='images/product_image/small/'.$product['product_main_image'];?>
                        @else
                        <?php $product_imgae_path='';?>
                        @endif
                                                @if(!empty($product['product_main_image']) && file_exists($product_imgae_path))
												<a href="{{ url('product/'.$product['id']) }}"><img style="width:200px;"  src="{{ asset($product_imgae_path)}}" alt=""></a>
                                                @else
                          		<a href="product_details.html"><img style="width:200px;" src="{{ asset('images/product_image/small/small_no_image.png')}}" alt=""></a>
                                                 @endif
										</div>
										<div class="span4">
											<h3>{{ $product['product_name']}}</h3>
											<hr class="soft"/>
											<h5>	{{ $product['product_name']}}</h5>
											<p>
                                                	{{ $product['brand']['name']}}
											</p>
											<a class="btn btn-small pull-right" href="{{ url('product/'.$product['id']) }}">View Details</a>
											<br class="clr"/>
										</div>
										<div class="span3 alignR">
											<form class="form-horizontal qtyFrm">
												<h3> Rs.	{{ $product['product_price']}}</h3>
												<label class="checkbox">
													<input type="checkbox">  Adds product to compair
												</label><br/>
												<div class="btn-group">
													<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
													<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
												</div>
											</form>
										</div>
									</div>
									<hr class="soft"/>
@endforeach
								</div>
								<div class="tab-pane active" id="blockView">
									<ul class="thumbnails">
                                         @foreach($Related_products as $product)

										<li class="span3">
    											<div class="thumbnail">
												@if(@isset($product['product_main_image']))
						<?php $product_imgae_path='images/product_image/small/'.$product['product_main_image'];?>
                        @else
                        <?php $product_imgae_path='';?>
                        @endif
                                                @if(!empty($product['product_main_image']) && file_exists($product_imgae_path))
												<a href="{{ url('/product/'.$product['id']) }}"><img style="width:200px;"  src="{{ asset($product_imgae_path)}}" alt=""></a>
                                                @else
                          		<a href="product_details.html"><img style="width:200px;" src="{{ asset('images/product_image/small/small_no_image.png')}}" alt=""></a>
                                                 @endif
												<div class="caption">
													<h5>{{ $product['product_name'] }}</h5>
													<p>
														{{ $product['brand']['name']}}
													</p>
													<h4 style="text-align:center"><a class="btn" href="{{ url('/product/'.$product['id']) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{ $product['product_price'] }}</a></h4>
												</div>
											</div>

										</li>
 @endforeach
									</ul>
									<hr class="soft"/>
								</div>
							</div>
							<br class="clr">
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection
