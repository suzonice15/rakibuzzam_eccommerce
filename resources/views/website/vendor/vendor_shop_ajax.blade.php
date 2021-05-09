@if($products)
    @foreach($products as $product)

        <?php
        if ($product->discount_price) {
            $sell_price = $product->discount_price;
        } else {
            $sell_price = $product->product_price;
        }
        ?>

        <div class="col-xs-6 col-sm-6 col-md-2 wow ">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image">
                            <a href="{{ url('') }}/{{$product->product_name}}">
                                <img
                                    src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"
                                    alt="">
                            </a>
                        </div>


                    </div>
                    <div class="product-info text-left">
                        <div class="product-price">
                                <span class="price">


                                  @money($sell_price)
                                </span>
                            <?php
                            if($product->discount_price){


                            ?>
                            <span class="price-before-discount"
                                  style="color:red">  @money($product->product_price) </span>

                            <?php


                            }
                            ?>
                        </div>
                         <h3 style="margin-top: 2px;margin-bottom: -2px;"   class="name">
                            <a href="{{ url('') }}/{{$product->product_name}}">

                                {{ $product->product_title }}
                            </a>
                        </h3>


                    </div>
                    


                </div>
            </div>
        </div>

    @endforeach
@endif
