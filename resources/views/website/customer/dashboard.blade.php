@extends('website.master')
@section('mainContent')

    <style>
        .vertical-menu {
            width: 200px;
        }

        .vertical-menu a {
            background-color: #eee;
            color: black;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu a:hover {
            background-color: #ccc;
        }

        .vertical-menu a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
<br>
<br>
<br>
    <div class="container">

        <div class="row">



            <div class="col-md-3">


                <br>

                <?php
                if(isset($user->picture)){
                ?>
                <img  class="img-fluid"  src="{{url('/')}}/public/uploads/users/{{$user->picture}}">
<?php } else { ?>
                <img  class="img-fluid"  src="{{url('/')}}/public/uploads/user.jpg">

            <?php } ?>
                <div class="vertical-menu">
                    @include('website.customer.sidebar')
                </div>

            </div>


            <div class="col-md-9">

                @yield('profile_master')


            </div>


        </div>


    </div>



@endsection

