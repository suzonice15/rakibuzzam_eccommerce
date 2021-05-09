<?php $__env->startSection('mainContent'); ?>

<div class="container">
    <div id="loginbox" style="margin-top:50px;background: white;
padding: 58px 5px;" class="mainbox d-flex justify-content-center col-md-12 col-lg-12 col-xl-12 col-xxl-12  col-sm-12 ">
        <div class="form-group mb-3">
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo e(Session::get('success')); ?>

                    <?php
                        Session::forget('success');
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-3">
            <?php if(Session::has('error')): ?>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    <?php echo e(Session::get('error')); ?>

                    <?php
                        Session::forget('error');
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="card panel-info" >

            <div class="card-heading">
                <div class="panel-title" style="text-align: center;padding: 9px;background: #ddd;color: black;" >Vendor Login</div>

            </div>

            <div style="padding-top:30px" class="card-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form  action="<?php echo e(url('/')); ?>/vendor/login" method="post"  >

                    <h5 id="fadeout" style="color:red;text-aling:center"><?php


                    if(isset($error)) { echo  $error;} ?></h5>

                    <?php echo e(csrf_field()); ?>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="vendor_email" value="" placeholder="Email">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="vendor_password" placeholder="password">
                    </div>

                    <div style="margin-top:10px" class="form-group">


                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn  btn-success" value="Login">

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style=" padding-top:15px; font-size:95%" >
                                 <a href="<?php echo e(url('/')); ?>/vendor/forgot-password" class="btn btn-danger text-white">
                                    Forget Password
                                </a>
                                <a href="<?php echo e(url('/')); ?>/vendor/form" class="btn btn-info text-white" >
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
   </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/vendor/login_form.blade.php ENDPATH**/ ?>