<div class="row px-2">
<h3 class="section-title"> <a href="" class="category_title_section">Related products</a> </h3>
     <?php

     ?>

    <?php foreach ( $products->unique('product_name') as $product) {

    if ($product->discount_price) {
        $sell_price = $product->discount_price;
    } else {
        $sell_price = $product->product_price;
    }

    ?>

<div class="col-md-2 col-lg-2 col-sm-6 col-6 p-1">
    <div class="card ">
        <div class="box">
            <a  href="{{ url('/') }}/{{$product->product_name}}" >  <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
        </a></div>
        <div class="card-body">
            <p class="product-title"><a  href="{{ url('/') }}/{{$product->product_name}}" >{{$product->product_title}} </a></p>
            <div class="text-center price ">
                <?php
                if($product->discount_price){


                ?>
                <p> @money($product->product_price)</p>

                <?php


                }
                ?>
                <p> @money($sell_price)</p>
            </div>

        </div>
    </div>
</div>

<?php  }?>

</div>
<!-- /.home-owl-carousel -->
