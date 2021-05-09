@extends('website.master')
@section('mainContent')




    <div class="container-fluid my-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                <li class="breadcrumb-item active " aria-current="page"><a  >{{$search_query}}</a></li>

            </ol>
        </nav>




    </div>


    <div class='container-fluid'>
                                    <div class="row">

                                        @if($products)
                                            @foreach($products as $product)

                                                <?php
                                                if ($product->discount_price) {
                                                    $sell_price = $product->discount_price;
                                                } else {
                                                    $sell_price = $product->product_price;
                                                }
                                                ?>

                                                    <div class="col-md-2 col-lg-2 col-sm-6 col-6 p-1">
                                                        <div class="card ">
                                                            <div class="box">
                                                                <a  href="{{ url('/') }}/{{$product->product_name}}" > <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
                                                           </a> </div>
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


                                            @endforeach
                                        @endif



            </div>

        </div>


@endsection
