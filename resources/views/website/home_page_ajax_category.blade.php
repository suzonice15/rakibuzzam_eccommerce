<?php
 $home_cat_section = explode(",", get_option('home_cat_section'));
Arr::forget($home_cat_section,'0');


if($home_cat_section){
foreach ($home_cat_section as  $category) {
  //  $category_id=$category->category_id;
$category_info = get_category_info($category);


$products= DB::table('product')->select('product_title','product_name','discount_price','product_price','folder','feasured_image')
        ->join('product_category_relation','product.product_id','=','product_category_relation.product_id')
       ->where('product_category_relation.category_id',$category)
        ->where('status','=',1)->orderBy('modified_time','desc')
        ->paginate(12);
?>

<div class="row px-2">

    <img class="img-fluid" style="height:254px;max-width: 100%"
         src="https://reactadmin.jncomputerbd.com/offers/5.png.webp">




    <div class="col-md-12 mt-3 mb-2" style="margin-bottom: 30px">
        <h4 style="display: inline;"><a  class="text-decoration-none" href="{{url('/')}}/category/{{$category_info->category_name}}">{{$category_info->category_title}}</a></h4>
        <button style="float: right; font-weight: 600; color: #fff" type="button" class="btn btn-warning"><a  class="text-decoration-none" href="{{url('/')}}/category/{{$category_info->category_name}}">View All</a>
        </button>
    </div>

   @if($products)
       @foreach($products as $product)

        <?php     if ($product->discount_price) {
            $sell_price = $product->discount_price;
            } else {
            $sell_price = $product->product_price;
            } ?>
    <div class="col-md-2 col-lg-2 col-sm-6 col-6 p-1 ">
        <div class="card">
            <div class="box">
                <a  class="text-decoration-none" href="{{url('/')}}/{{$product->product_name}}">  <img class="img-fluid"
                     src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="  {{ $product->product_title }}">
            </a>
            </div>
            <div class="card-body">
                <p class="product-title">  <a  class="text-decoration-none" href="{{url('/')}}/{{$product->product_name}}"> {{ $product->product_title }}</a></p>
                <div class="price ">
                    <?php
                    if($product->discount_price){
                    ?>
                    <p> @money($product->product_price) </p>
                        <?php } ?>

                    <p>@money($sell_price)</p>
                </div>
                {{--<a href="#" class="btn btn-warning" style="font-weight: 600; margin-left: 21%; color: #fff;">Buy--}}
                    {{--Now</a>--}}
                {{--<a href="#" class="btn btn-danger"--}}
                   {{--style="font-weight: 600; margin-left: 15%; color: #fff; margin-top: 5px">Add to Cart</a>--}}
            </div>
        </div>
    </div>

       @endforeach
       @endif



</div>

<?php

}
}
?>
