
@extends('website.master')
@section('mainContent')

    <div class="container">
        @if (count($errors) > 0)
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    @foreach ($errors->all() as $error)

                        <li style="list-style: none">{{ $error }}</li>

                    @endforeach

                </ul>
            </div>
        @endif


            <form class="well form-horizontal" action="{{url('/')}}/customer/form" method="post"  id="contact_form">



                @csrf
            <div>

                <!-- Form Name -->
                <legend><center><h2><b>Customer Registration Form</b></h2></center></legend><br>

                <!-- Text input-->



                <div class="form-group">
                    <div class="col-md-4 inputGroupContainer">
                    @if(Session::has('success'))

                        <div class="alert alert-success">

                            {{ Session::get('success') }}

                            @php

                                Session::forget('success');

                            @endphp

                        </div>

                    @endif
                </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 inputGroupContainer">
                        @if(Session::has('error'))

                            <div class="alert alert-danger">

                                {{ Session::get('error') }}

                                @php

                                    Session::forget('error');

                                @endphp

                            </div>

                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Full Name</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="name" placeholder="Enter Name" class="form-control"  type="text">
   </div>

                    </div>
                    @if ($errors->has('name'))

                        <span class="text-danger">{{ $errors->first('name') }}</span>

                    @endif
                </div>

                <!-- Text input-->



                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input  name="email" placeholder="E-Mail Address" class="form-control"  type="email">
                        </div>
                    </div>
                    @if ($errors->has('email'))

                        <span class="text-danger">{{ $errors->first('email') }}</span>

                    @endif
                </div>
            </div>


                <!-- Text input-->


                <div class="form-group">
                    <label class="col-md-4 control-label">Contact No.</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="phone" placeholder="017380000000" class="form-control" type="text">
                        </div>
                    </div>
                    @if ($errors->has('phone'))

                        <span class="text-danger">{{ $errors->first('phone') }}</span>

                    @endif
                </div>




                <div class="form-group">
                    <label class="col-md-4 control-label" >Password</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="password" placeholder="Password" class="form-control"  type="password">
                        </div>
                    </div>

                    @if ($errors->has('password'))

                        <span class="text-danger">{{ $errors->first('password') }}</span>

                    @endif
                </div>

                <!-- Text input-->


                <div class="form-group">
                    <label class="col-md-4 control-label" >Address </label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <textarea name="address"  placeholder="addrees" class="form-control" rows="2"></textarea>

                                   </div>
                    </div>
                    @if ($errors->has('address'))

                        <span class="text-danger">{{ $errors->first('address') }}</span>

                    @endif
                </div>

                <!-- Select Basic -->

                <!-- Success message -->

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4"><br>
                        <button type="submit" class="btn btn-info" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSave <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                        <a href="{{url('/customer/login')}}" class="btn btn-success">Already Account</a>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
    </div><!-- /.container -->


    <script>
        $(document).ready(function () {
            $("#vendor_shop").on('input click', function () {
                var text = $("#vendor_shop").val();
                var _token = $("input[name='_token']").val();
                var base_url="{{url('/')}}/shop/";

                var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                word=  base_url.concat( word );
                $("#vendor_link").val(word);
                $.ajax({
                    data: {url: word, _token: _token},
                    type: "POST",
                    url: "{{route('vendor.Shopurlcheck')}}",
                    success: function (result) {

                        // $('#categoryError').html(result);
                        var str2 = "1";
                        var word = $("#vendor_link").val(word);
                        if (result) {
                            var text = $("#vendor_shop").val();
                            var base_url="{{url('/')}}/shop/";
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            word=  base_url.concat( word );
                            var word = word.concat(str2);
                            $("#vendor_link").val(word);
                            $("#vendor_link_error").text("This link allready taken");
                            $('input[type="submit"]').attr('disabled','disabled');

                        } else {
                            var text = $("#vendor_shop").val();
                            var base_url="{{url('/')}}/shop/";

                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            word=  base_url.concat( word );
                            $("#vendor_link").val(word);
                            $("#vendor_link_error").text("");
                            $(':input[type="submit"]').prop('disabled', false);

                        }
                    }
                });
            });


        });
    </script>


@endsection

