@extends('website.master')
@section('mainContent')

    <div class="container-fluid my-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                <li class="breadcrumb-item active " aria-current="page">All Shop</li>

            </ol>
        </nav>




    </div>



    <div class="container-fluid">




        <div class="row px-2">

            @if($shops)
                @foreach($shops as $shop)


                    <div class="col-md-2 col-lg-2 col-sm-6 col-6 p-1">
                        <div class="card ">
                            <div class="box">
                                <a  href="{{ url('/') }}/shop/{{$shop->vendor_link}}" >

                                    @if($shop->vendor_shop_image)
                                    <img src="{{ url('/public/uploads') }}/{{ $shop->folder }}/thumb/{{ $shop->vendor_shop_image }}" alt="{{$product->product_title}}">
                                    @else
                                        <img class="img-fluid" src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/c9764a164112-4.png">

                                    @endif

                                </a>

                            </div>
                            <div class="card-body">
                                <p class="product-title"><a  href="{{ url('/') }}/shop/{{$shop->vendor_link}}" >{{$shop->vendor_shop}} </a></p>

                            </div>
                        </div>
                    </div>



                @endforeach
            @endif

        </div>




    </div>



@endsection
