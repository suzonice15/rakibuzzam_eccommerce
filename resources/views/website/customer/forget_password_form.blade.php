@extends('website.master')
@section('mainContent')

<div class="container mt-5">
    <div id="loginbox" style="margin-top:50px;" class="mainbox d-flex justify-content-center col-12 mt-5">

        <div class="card panel-info mt-5" style="margin:100px 0px" >

            <div class="panel-heading">
                <div class="card-title" style="background: #ddd;text-align: center;padding: 7px;">Forgot Password</div>
            </div>

            <div style="padding-top:30px" class="card-body" >

                <div class="form-group mb-3">
                    @if(Session::has('success'))
                        <div class="alert alert-success">

                            {{ Session::get('success') }}
                            @php
                            Session::forget('success');
                            @endphp
                        </div>
                    @endif
                </div>

                <div class="form-group mb-3">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">

                            {{ Session::get('error') }}
                            @php
                            Session::forget('error');
                            @endphp
                        </div>
                    @endif
                </div>

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form  action="{{url('/')}}/customer/forgot-password" method="post"  >

                    <h5 id="fadeout" style="color:red;text-aling:center"><?php


                    if(isset($error)) { echo  $error;} ?></h5>

                    @csrf
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="Enter Your Email">
                    </div>

                    <div style="margin-top:10px" class="form-group">


                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn  btn-success" value="Submit">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>

@endsection

