<?php $__env->startSection('mainContent'); ?>

    <div class="container-fluid ">

        <div id="loginbox" style="margin-top:50px;background: white;
padding: 58px 5px;" class="mainbox d-flex justify-content-center col-md-12 col-lg-12 col-xl-12 col-xxl-12  col-sm-12 ">


        <form class="well form-horizontal" action="<?php echo e(url('/')); ?>/vendor/save" method="post"  id="contact_form">



                <?php echo e(csrf_field()); ?>

           <div  style="border: 1px solid #ddd;">




                <!-- Form Name -->
                <p style="background: #9f9898;font-size: 22px;text-align: center;display: flex;justify-content: center;color: white;/*! width: 100%; */">Registration Form</p>

                <!-- Text input-->


 <div style="padding: 13px;">
                <div class="form-group">
                    <div class="col-12 ">
                    <?php if(Session::has('success')): ?>

                        <div class="alert alert-success">

                            <?php echo e(Session::get('success')); ?>


                            <?php

                                Session::forget('success');

                            ?>

                        </div>

                    <?php endif; ?>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-12 ">
                        <?php if(Session::has('error')): ?>

                            <div class="alert alert-danger">

                                <?php echo e(Session::get('error')); ?>


                                <?php

                                    Session::forget('error');

                                ?>

                            </div>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-12 control-label">First Name</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="vendor_f_name" placeholder="First Name" class="form-control"  type="text">





                        </div>

                    </div>
                    <?php if($errors->has('vendor_f_name')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_f_name')); ?></span>

                    <?php endif; ?>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-12 control-label" >Last Name</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="vendor_l_name" placeholder="Last Name" class="form-control"  type="text">
                        </div>
                    </div>
                    <?php if($errors->has('vendor_l_name')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_l_name')); ?></span>

                    <?php endif; ?>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-12 control-label">E-Mail</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input  name="vendor_email" placeholder="E-Mail Address" class="form-control"  type="email">
                        </div>
                    </div>
                    <?php if($errors->has('vendor_email')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_email')); ?></span>

                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="col-12  control-label">Contact No.</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="vendor_phone" placeholder="017380000000" class="form-control" type="text">
                        </div>
                    </div>
                    <?php if($errors->has('vendor_phone')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_phone')); ?></span>

                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="col-12 control-label">Shop Name</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="vendor_shop" id="vendor_shop" placeholder="Molla store" class="form-control" type="text">
                        </div>
                    </div>
                    <?php if($errors->has('vendor_shop')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_shop')); ?></span>

                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="col-12 control-label">Shop Link</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="vendor_link" id="vendor_link" placeholder="https://www.sohojbuy.com/shop/dd" class="form-control" type="text">
                        </div>
                    </div>
                    <?php if($errors->has('vendor_link')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_link')); ?></span>


                    <?php endif; ?>
                    <span id="vendor_link_error" style="font-weight:bold;font-size:25px;color:red"></span>
                </div>


                <div class="form-group">
                    <label class="col-12 control-label" >Password</label>
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="vendor_password" placeholder="Password" class="form-control"  type="password">
                        </div>
                    </div>

                    <?php if($errors->has('vendor_password')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_password')); ?></span>

                    <?php endif; ?>
                </div>

                <!-- Text input-->

                <div hidden class="form-group">
                    <label class="col-12 control-label" >Confirm Password</label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password">
                        </div>
                    </div>

                    <?php if($errors->has('confirm_password')): ?>

                        <span class="text-danger"><?php echo e($errors->first('confirm_password')); ?></span>

                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="col-12 control-label" >Address </label>
                    <div class="col-12 ">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <textarea name="vendor_address"  placeholder="addrees" class="form-control" rows="2"></textarea>

                        </div>
                    </div>
                    <?php if($errors->has('vendor_address')): ?>

                        <span class="text-danger"><?php echo e($errors->first('vendor_address')); ?></span>

                    <?php endif; ?>
                </div>

                <!-- Select Basic -->

                <!-- Success message -->

                <!-- Button -->
                <div class="form-group">
                    <label class="col-12 control-label"></label>
                    <div class="col-12"><br>
                        <button type="submit" class="btn btn-info" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Registration <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                        <a href="<?php echo e(url('/vendor/login')); ?>" class="btn btn-success">Already have  Account</a>
                    </div>
                </div>






 </div>    <!-- Text input-->

           </div>


        </form>
    </div>

    </div>



    <script>
        $(document).ready(function () {
            $("#vendor_shop").on('input click', function () {
                var text = $("#vendor_shop").val();
                var _token = $("input[name='_token']").val();
                var base_url="<?php echo e(url('/')); ?>/shop/";

                var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                word=  base_url.concat( word );
                $("#vendor_link").val(word);
                $.ajax({
                    data: {url: word, _token: _token},
                    type: "POST",
                    url: "<?php echo e(route('vendor.Shopurlcheck')); ?>",
                    success: function (result) {

                        // $('#categoryError').html(result);
                        var str2 = "1";
                        var word = $("#vendor_link").val(word);
                        if (result) {
                            var text = $("#vendor_shop").val();
                            var base_url="<?php echo e(url('/')); ?>/shop/";
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            word=  base_url.concat( word );
                            var word = word.concat(str2);
                            $("#vendor_link").val(word);
                            $("#vendor_link_error").text("This link allready taken");
                            $('input[type="submit"]').attr('disabled','disabled');

                        } else {
                            var text = $("#vendor_shop").val();
                            var base_url="<?php echo e(url('/')); ?>/shop/";

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


<?php $__env->stopSection(); ?>


<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/vendor/sign_up_form.blade.php ENDPATH**/ ?>