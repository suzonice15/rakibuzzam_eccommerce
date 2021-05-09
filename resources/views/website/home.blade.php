@extends('website.master')
@section('mainContent')


    <div class="container-fluid ">
        <div class="row px-2 ">
            <div class="col-md-3 desktop-menu d-none  d-lg-block d-xl-bloc d-xxl-block">


                <ul class="">

                    <?php

                    $categories = DB::table('category')
                            ->select('category_id', 'category_title', 'category_name')
                            ->where('parent_id', 0)->where('status', 1)
                            ->paginate(13);
                    if($categories){
                    foreach ($categories as $first){
                    $firstCategory_id = $first->category_id;
                    $secondCategories = DB::table('category')
                            ->select('category_id', 'category_title', 'category_name')
                            ->where('parent_id', $firstCategory_id)
                            ->orderBy('category_id', 'ASC')->get();
                    if(count($secondCategories) > 0){

                    ?>
                    <li class="">
                        <a href="{{url('/category')}}/{{$first->category_name}}">{{$first->category_title}} </a>
                        <span class="right-main-menu-icon"><i class="fa fa-angle-right"></i></span>


                        <ul class="sub-menu-ul">

                            <?php foreach ($secondCategories as $second){

                            $secondCategory_id = $second->category_id;
                            $thirdCategories = DB::table('category')->select('category_title', 'category_name')->where('parent_id', $secondCategory_id)->orderBy('category_id', 'ASC')->get();


                            if($thirdCategories){
                            ?>

                            <li class="">

                                <a href="{{url('/category')}}/{{$second->category_name}}">{{$second->category_title}} </a>
                                <span class="right-main-menu-icon"><i class="fa fa-angle-right"></i></span>


                                <ul class="sub-sub-menu-ul">


                                    @foreach($thirdCategories as $thirdCategory)
                                        <li class="">

                                            <a href="{{url('/category')}}/{{$thirdCategory->category_name}}">{{$thirdCategory->category_title}}</a>

                                        </li>

                                    @endforeach


                                </ul>


                            </li> <?php }  else { ?>
                            <li class="">
                                <a href="{{url('/category')}}/{{$second->category_name}}"> {{$second->category_title}}</a>
                            </li>

                            <?php } } ?>


                        </ul>


                    </li>
                    <?php } else { ?>


                    <li class=""><a
                                href="{{url('/category')}}/{{$first->category_name}}">{{$first->category_title}}</a>
                    </li>
                    <?php

                    }
                    }
                    }
                    ?>

                </ul>


            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">


                        <div class="slider mt-3">
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">

                                    <?php $count =-1;?>
                                    @if($sliders)
                                        @foreach($sliders as $key=>$slider)

                                            <?php $count++;?>

                                            <button type="button" data-bs-target="#carouselExampleDark"
                                                    data-bs-slide-to="{{$count}}" <?php if($count==1) { echo 'class=active';} ?>
                                                    aria-current="true" aria-label="Slide 1"></button>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="carousel-inner">

                                    @if($sliders)
                                        @foreach($sliders as $slider)

                                            <div class="carousel-item active" data-bs-interval="10000">
                                                <img src="{{ url('public/uploads/sliders')}}/{{$slider->homeslider_picture}}"
                                                     class="d-block w-100 img" alt="...">

                                            </div>

                                        @endforeach
                                    @endif


                                </div>
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleDark"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleDark"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>


                    </div>


                    <div class="col-12  col-lg-12 col-xl-12 py-3">
                        <div class="row">


                            <div class="col-lg-3 col-xl-3 col-sm-6 col-md-2 col-6">
                                <div class="card">
                                    <img src="https://4.imimg.com/data4/VB/BR/MY-26518534/mens-plain-shirt-500x500.jpg"
                                         class="card-img-top" alt="..."/>
                                    <div class="card-body">
                                        <p class="text-center">Original Race Mini Air</p>
                                        <p class="text-center">৳1250
                                            <del>৳1950</del>
                                        </p>
                                    </div>


                                </div>

                            </div>

                            <div class="col-lg-3 col-xl-3 col-sm-6 col-md-2 col-6">
                                <div class="card">
                                    <img src="https://4.imimg.com/data4/VB/BR/MY-26518534/mens-plain-shirt-500x500.jpg"
                                         class="card-img-top" alt="..."/>
                                    <div class="card-body">
                                        <p class="text-center">Original Race Mini Air</p>
                                        <p class="text-center">৳1250
                                            <del>৳1950</del>
                                        </p>
                                    </div>


                                </div>

                            </div>

                            <div class="col-lg-3 col-xl-3 col-sm-6 col-md-2 col-6">
                                <div class="card">
                                    <img src="https://4.imimg.com/data4/VB/BR/MY-26518534/mens-plain-shirt-500x500.jpg"
                                         class="card-img-top" alt="..."/>
                                    <div class="card-body">
                                        <p class="text-center">Original Race Mini Air</p>
                                        <p class="text-center">৳1250
                                            <del>৳1950</del>
                                        </p>
                                    </div>


                                </div>

                            </div>

                            <div class="col-lg-3 col-xl-3 col-sm-6 col-md-2 col-6">
                                <div class="card">
                                    <img src="https://4.imimg.com/data4/VB/BR/MY-26518534/mens-plain-shirt-500x500.jpg"
                                         class="card-img-top" alt="..."/>
                                    <div class="card-body">
                                        <p class="text-center">Original Race Mini Air</p>
                                        <p class="text-center">৳1250
                                            <del>৳1950</del>
                                        </p>
                                    </div>


                                </div>

                            </div>


                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>



    <div class="container-fluid ">


        <span class="home_page_category"></span>


    </div>
    </div>


    <script>

        jQuery.ajax(
                {

                    url: "{{url('/home_page_category_ajax')}}",

                    type: "get",


                })

                .done(function (data) {
                    // console.log(data.html)
                    if (data.html == " ") {


                    }


                    jQuery(".home_page_category").html(data.html);

                    jQuery('.home-owl-carousel').each(function () {

                        var owl = $(this);
                        var itemPerLine = owl.data('item');

                        if (!itemPerLine) {
                            itemPerLine = 7;

                        }
                        owl.owlCarousel({
                            items: itemPerLine,
                            itemsTablet: [768, 2],
                            itemsDesktopSmall: [979, 2],
                            itemsDesktop: [1199, 2],
                            itemsMobile: [1199, 2],
                            navigation: true,
                            pagination: false,
                            autoPlay: true,

                            navigationText: ["", ""]
                        });
                    });

                })

                .fail(function (jqXHR, ajaxOptions, thrownError) {


                });
    </script>


@endsection
