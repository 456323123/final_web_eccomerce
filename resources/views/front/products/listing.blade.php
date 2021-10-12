@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
				<li class="active"><?php echo $categoryDetail['breadcrubs'];?></li>
			</ul>
			<h3> {{ $categoryDetail['categoryDetail']['category_name'] }} <small class="pull-right">{{count($productandcategorydetail)}}
        products are available </small></h3>
			<hr class="soft"/>
			<p>
				{{ $categoryDetail['categoryDetail']['category_description']}}
			</p>
			<hr class="soft"/>
			<form class="form-horizontal span6" id="sortsroducts" name="sortsroducts">
				<div class="control-group">
					<label class="control-label alignL">Sort By </label>
                    <input name="url"  type="hidden" value="{{ $url }}" id="url">
					<select id="sort" name="sort">
                         <option  value="">Select</option>
					    <option value="latest_products" @if(isset($_GET['sort']) && $_GET['sort']=="latest_products") selected="" @endif>Latest Products</option>
						<option value="latest_products_a_to_z" @if(isset($_GET['sort']) && $_GET['sort']=="latest_products_a_to_z") selected="" @endif>Priduct name A - Z</option>
						<option value="latest_products_z_to_a" @if(isset($_GET['sort']) && $_GET['sort']=="latest_products_z_to_a") selected="" @endif>Priduct name Z - A</option>
						<option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest") selected="" @endif>Price Lowest first</option>
                        <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected="" @endif>Price Highest first</option>

					</select>
				</div>
			</form>

			{{--  left right button for products <div id="myTab" class="pull-right">
				<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
				<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
			</div>  --}}
			<br class="clr"/>
			<div class="tab-content filter_products">

                @include('front.products.ajax_product_listing')


				{{--  list view <div class="tab-pane" id="listView">

                        @foreach ($productandcategorydetail as $product)
					<div class="row">
						<div class="span2">
                            @if(@isset($product['product_main_image']))
						<?php $product_imgae_path='images/product_image/small/'.$product['product_main_image'];?>
                        @else
                        <?php $product_imgae_path='';?>
                        @endif
                                                @if(!empty($product['product_main_image']) && file_exists($product_imgae_path))
												<a href="product_details.html"><img style="width:200px;"  src="{{ asset($product_imgae_path)}}" alt=""></a>
                                                @else
                          		<a href="product_details.html"><img style="width:200px;" src="{{ asset('images/product_image/small/small_no_image.png')}}" alt=""></a>
                                                 @endif
						</div>
						<div class="span4">
							<h3>{{ $product['brand']['name'] }}</h3>
							<hr class="soft"/>
							<h5>{{ $product['product_name'] }} </h5>
							<p>
							{{ $product['product_description'] }}
							</p>
							<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
							<br class="clr"/>
						</div>
						<div class="span3 alignR">
							<form class="form-horizontal qtyFrm">
								<h3> Rs.{{ $product['product_price'] }}</h3>
								<label class="checkbox">
									<input type="checkbox">  Adds product to compair
								</label><br/>

								<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
								<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

							</form>
						</div>
					</div>
					<hr class="soft"/>
                    @endforeach
				</div>  --}}

			</div>
			<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
			<div class="pagination">
                @if(isset($_GET['sort']) && !empty($_GET['sort']))
                 {{ $productandcategorydetail->appends(['sort'=> $_GET['sort']])->links() }}
                  @else
               {{ $productandcategorydetail->links() }}
                @endif
			</div>
			<br class="clr"/>
              <br><br><br>  <br><br><br>  <br><br><br>  <br><br><br><br><br><br>
		</div>

@endsection
