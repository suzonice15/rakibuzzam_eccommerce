@extends('website.master')
@section('mainContent')

        <div class="container-fluid my-2">

        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <?php if(isset($category_name_first)) { ?>
                    <li class="breadcrumb-item " aria-current="page"><a href="{{url('/category/')}}/{{$category_name_first}}">{{$category_title_first}}</a> </li>
                    <?php } ?>
                    <?php if(isset($category_name_middle)) { ?>
                    <li class="breadcrumb-item " aria-current="page"><a href="{{url('/category/')}}/{{$category_name_middle}}" >{{$category_title_middle}}</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active " aria-current="page"><a href="{{url('/category/')}}/{{$category_name_last}}" >{{$category_title_last}}</a></li>

                </ol>
                </nav>
            
             

           
        </div>
         


    <div class="container-fluid">


            <h4  class="mt-2 mb-2">{{$category_title_last}}</h4>





               <span id="post-data">

             @include('website.category_ajax')

           </span>





    </div>
    <input type="hidden"  id="category_name" name="category_name" value="{{$category_name}}">

    <script type="text/javascript" async>

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function() {

            if($(window).scrollTop() + $(window).height()>= $(document).height()) {
                page++;

                loadMoreData(page);
            }



        });


        function loadMoreData(page){
   var category_name=$('#category_name').val();
            jQuery.ajax(

                {

                    url:"{{url('/ajax_category')}}?page="+page+"&category_name="+category_name,

                    type: "get",


                })

                .done(function(data)

                {
                // console.log(data.html)
                    if(data.html == " "){

                        jQuery('.ajax-load').html("No more records found");

                        return;

                    }



                    jQuery("#post-data").append(data.html);

                })



        }

    </script>


@endsection
