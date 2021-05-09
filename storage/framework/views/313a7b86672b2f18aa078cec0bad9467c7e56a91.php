<?php $__env->startSection('mainContent'); ?>

    <div class="container d-flex justify-content-center" style="background: white;padding: 50px 50px">
        <?php if(count($errors) > 0): ?>
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li style="list-style: none"><?php echo e($error); ?></li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </div>
        <?php endif; ?>


            <form class="well form-horizontal" action="<?php echo e(url('/')); ?>/customer/form" method="post"  id="contact_form">



                <?php echo csrf_field(); ?>
            <div style="border: 1px solid #ddd;">

                <!-- Form Name -->
                 <h2 style="font-size: 26px;background: #ddd;text-align: center;width: 360px;padding: 5px 11px;" >Customer Registration Form</h2>

                <!-- Text input-->


<div style="padding: 10px;" >

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
        <label class="col-12 control-label">Full Name</label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input  name="name" placeholder="Enter Name" class="form-control"  type="text">
            </div>

        </div>
        <?php if($errors->has('name')): ?>

            <span class="text-danger"><?php echo e($errors->first('name')); ?></span>

        <?php endif; ?>
    </div>

    <!-- Text input-->



    <!-- Text input-->
    <div class="form-group">
        <label class="col-12 control-label">E-Mail</label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input  name="email" placeholder="E-Mail Address" class="form-control"  type="email">
            </div>
        </div>
        <?php if($errors->has('email')): ?>

            <span class="text-danger"><?php echo e($errors->first('email')); ?></span>

        <?php endif; ?>
    </div>
    <!-- Text input-->


    <div class="form-group">
        <label class="col-12 control-label">Contact No.</label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                <input name="phone" placeholder="017380000000" class="form-control" type="text">
            </div>
        </div>
        <?php if($errors->has('phone')): ?>

            <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>

        <?php endif; ?>
    </div>




    <div class="form-group">
        <label class="col-12 control-label" >Password</label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="password" placeholder="Password" class="form-control"  type="password">
            </div>
        </div>

        <?php if($errors->has('password')): ?>

            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>

        <?php endif; ?>
    </div>

    <!-- Text input-->


    <div class="form-group">
        <label class="col-12 control-label" >Address </label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <textarea name="address"  placeholder="addrees" class="form-control" rows="2"></textarea>

            </div>
        </div>
        <?php if($errors->has('address')): ?>

            <span class="text-danger"><?php echo e($errors->first('address')); ?></span>

        <?php endif; ?>
    </div>

    <!-- Select Basic -->

    <!-- Success message -->

    <!-- Button -->
    <div class="form-group">
        <label class="col-12 control-label"></label>
        <div class="col-12"><br>
            <button type="submit" class="btn btn-info" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSave <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
            <a href="<?php echo e(url('/customer/login')); ?>" class="btn btn-success">Already Account</a>
        </div>
    </div>



</div>


            </div>



        </form>
    </div>
    </div><!-- /.container -->


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


<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/customer/sign_up_form.blade.php ENDPATH**/ ?>