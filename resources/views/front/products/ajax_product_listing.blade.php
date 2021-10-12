<?php use App\Product; ?>
@if(count($productandcategorydetail)>0)

<div class="tab-pane  active" id="blockView">
					<ul class="thumbnails">
                        @foreach ($productandcategorydetail as $product)
						<li class="span3">
							<div class="thumbnail">
 @if(@isset($product['product_main_image']))
						<?php $product_imgae_path='Images/product_image/small/'.$product['product_main_image'];?>
                        @else
                        <?php $product_imgae_path='';?>
                        @endif

                                                @if(!empty($product['product_main_image']) && file_exists($product_imgae_path))
												<a href="{{ url('product/'.$product['id']) }}"><img style="width:200px;height:200px"  src="{{ asset($product_imgae_path)}}" alt=""></a>
                                                @else
                          		<a href="{{ url('product/'.$product['id']) }}"><img style="width:200px;height:200px" src="{{ asset('Images/product_image/small/small_no_image.png')}}" alt=""></a>
                                                 @endif
								<div class="caption">
									<h5>{{ $product['product_name'] }}</h5>
									<p>
										{{ $product['brand']['name'] }}
									</p>
                                    <?php $discountprice=Product::ProductDiscount($product['id']); ?>
									<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
                                         @if($discountprice>0)

                                       <del> Rs.{{ $product['product_price'] }}</del>
                                        @else
                                        Rs.{{ $product['product_price'] }}

                                        @endif


                                    </a></h4>
                                      @if($discountprice>0)
                                          <h4 style="color: red"> Discounted Price Rs.{{ $discountprice }}</h4>
                                        @endif
								</div>
							</div>
						</li>
					@endforeach
					</ul>
					<hr class="soft"/>
				</div>

@else
<div class="well well-small">
<h5 style="color: rgb(173, 24, 24); text-align:center">Not any product found search by your cateria...  </h5>
</div>
@endif
