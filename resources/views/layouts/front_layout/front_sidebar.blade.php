<?php
    use App\Section;
    $getalldata=Section::Get_All_Sections();
//echo "<pre>"; print_r($getallsection);die;


?>
<div id="sidebar" class="span3">
				<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('Images/front_images/ico-cart.png')}}" alt="cart">3 Items in your cart</a></div>
				<ul id="sideManu" class="nav nav-tabs nav-stacked">
                    @foreach($getalldata as $section)
                       @if(count($section['categories'])>0)

					<li class="subMenu"><a>{{ $section['name'] }}</a>


						<ul>
                            @foreach($section['categories'] as $category)
							<li><a href="{{ url('/'.$category['category_url'] ) }}"><i class="icon-chevron-right"></i><strong>{{ $category['category_name'] }}</strong></a></li>

                            @foreach($category['subcategories'] as $subcategory)
							<li><a href="{{ url('/'.$subcategory['category_url']) }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-chevron-right"></i>{{ $subcategory['category_name'] }}</a></li>
@endforeach
@endforeach
						</ul>

					</li>
                    @endif
@endforeach
				</ul>

				<br/>

                @if(isset($page_name)&& $page_name=="listing")
<div class="well well-small">
    <h5>Brands</h5>
@foreach($brand as $brand)
<input style="margin-top: -3px" class="brand" type="checkbox" name="brand[]" id={{ $brand['id'] }} value="{{ $brand['id'] }}">&nbsp;&nbsp; {{ $brand['name'] }}<br>
@endforeach
</div>
<div class="well well-small">
<h5>Fabric</h5>
@foreach($fabricArray as $fabric)
<input style="margin-top: -3px" class="fabric" type="checkbox" name="fabric[]" id={{ $fabric }} value="{{ $fabric }}">&nbsp;&nbsp; {{ $fabric }}<br>
@endforeach
</div>

<div class="well well-small">
<h5>Sleeve</h5>
@foreach($SleeveArray as $Sleeve)
<input style="margin-top: -3px" class="Sleeve" type="checkbox" name="Sleeve[]" id={{ $Sleeve }} value="{{ $Sleeve }}">&nbsp;&nbsp; {{ $Sleeve }}<br>
@endforeach
</div>


<div class="well well-small">
<h5>Patten</h5>
@foreach($PattenArray as $Patten)
<input style="margin-top: -3px" class="Patten" type="checkbox" name="Patten[]" id={{ $Patten }} value="{{ $Patten }}">&nbsp;&nbsp; {{ $Patten }}<br>
@endforeach
</div>


<div class="well well-small">
<h5>Fit</h5>
@foreach($fitArray as $fit)
<input style="margin-top: -3px" type="checkbox" class="Fit"  name="fit[]" id={{ $fit }} value="{{ $fit }}">&nbsp;&nbsp; {{ $fit }}<br>
@endforeach
</div>


<div class="well well-small">
<h5>Occassion</h5>
@foreach($occassionArray as $occassion)
<input style="margin-top: -3px" type="checkbox" class="Occission" name="Occission[]" id={{ $occassion }} value="{{ $occassion }}">&nbsp;&nbsp; {{ $occassion }}<br>
@endforeach
</div>
@endif
				<div class="thumbnail">
					<img src="{{asset('Images/front_images/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
					<div class="caption">
						<h5>Payment Methods</h5>
					</div>
				</div>
			</div>
