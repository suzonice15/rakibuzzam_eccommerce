

@extends('website.master')
@section('mainContent')

<div class="container">
<br/>
    <div class="row">
        <div class="col-md-12">



            <div class="breadcrumb">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <ul class="list-inline list-unstyled">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class='active'>{{$page->page_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">

            <article class="txt">

               <?php echo $page->page_content; ?>
            </article>
        </div>


    </div>

</div>

@endsection
