@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
				<div class="well well-small">
					<h4>Featured Products <small class="pull-right">{{ $feature_product_count }} featured products</small></h4>
					<div class="row-fluid">
						<div id="featured"  @if($feature_product_count > 4) class="carousel slide" @endif>
							<div class="carousel-inner">
                                @foreach ($feature_iten_chunk as $key=>$featureitem)
								<div class="item @if($key==1) active @endif">
									<ul class="thumbnails">
                                         @foreach ($featureitem as $item)
										<li class="span3">
											<div class="thumbnail">

												<i class="tag"></i>
                                                <?php $product_imgae_path='Images/product_image/small/'.$item['product_main_image'];?>
                                                @if(!empty($item['product_main_image']) && file_exists($product_imgae_path))
												<a href="{{  url('product/'.$item['id']) }}"><img src="{{ asset($product_imgae_path)}}" alt=""></a>
                                                @else
                          		<a href="{{  url('product/'.$item['id']) }}"><img src="{{ asset('Images/product_image/small/small_no_image.png')}}" alt=""></a>
                                                 @endif
												<div class="caption">
													<h5>{{ $item['product_name'] }}</h5>
													<h4><a class="btn" href="{{  url('product/'.$item['id']) }}" >VIEW</a> <span class="pull-right">Rs.{{ $item['product_price'] }}</span></h4>
												</div>

											</div>

										</li>
                                         @endforeach
									</ul>
								</div>
                              @endforeach

							</div>
							{{--  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
							<a class="right carousel-control" href="#featured" data-slide="next">›</a>  --}}
						</div>
					</div>
				</div>
				<h4>Latest Products </h4>
				<ul class="thumbnails">
                    @foreach ($latest_products as $key=>$latestitem)
					<li class="span3">
						<div class="thumbnail">
                                                <?php $product_imgae_path='Images/product_image/medium/'.$latestitem['product_main_image'];?>

							@if(!empty($latestitem['product_main_image']) && file_exists($product_imgae_path))
												<a href="{{  url('product/'.$latestitem['id']) }}"><img style="width:160px" src="{{ asset($product_imgae_path)}}" alt=""></a>
                                                @else
                          		<a href="{{  url('product/'.$latestitem['id']) }}"><img style="width:160px" src="{{ asset('Images/product_image/medium/medium_no_image.png')}}" alt=""></a>
                                                 @endif</a>
							<div class="caption">
								<h5>{{ $latestitem['product_name'] }}</h5>
								<p>
								{{ $latestitem['product_code'] }} ({{ ucwords($latestitem['product_color'])  }})
								</p>

								<h4 style="text-align:center"><a class="btn" href="{{  url('product/'.$latestitem['id']) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{ $latestitem['product_price']  }}</a></h4>
							</div>
						</div>
					</li>
					   @endforeach
				</ul>
			</div>
@endsection
