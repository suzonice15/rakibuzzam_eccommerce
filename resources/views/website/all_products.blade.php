@extends('website.master')
@section('mainContent')

     
        <div class="container-fluid my-2">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                    <li class="breadcrumb-item active " aria-current="page"><a href="{{url('/all-products/')}}">All Products</a></li>

                    </ol>
                </nav>
        </div>

       
    
         <div class="container-fluid">
          

                                            <span id="post-data">
                                                  @include('website.all_product_by_ajax')
                                            </span>

                 
            </div>

        </div>
    

    <script type="text/javascript" >

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function () {


                page++;
                loadMoreData(page);



        });


        function loadMoreData(page) {
            jQuery.ajax(
                    {    url: "{{url('/all_ajax_products')}}?page=" + page,
                        type: "get",
                      }).done(function (data) {
                         if (data.html == " ") {
                            jQuery('.ajax-load').html("No more records found");
                            return;
                        }

                        jQuery('.ajax-load').hide();

                        jQuery("#post-data").append(data.html);

                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {

                        // alert('server not responding...');

                    });

        }

    </script>


@endsection
