<?php $__env->startSection('mainContent'); ?>

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
    <div class="container" style="background: white;padding: 39px 13px;">

        <div class="row">



            <div class="col-md-12 col-12 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">




                    <?php echo $__env->make('website.customer.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


            </div>


            <div class="col-md-12 col-12 col-sm-12 col-lg-9 col-xl-9 col-xxl-9">

                <?php echo $__env->yieldContent('profile_master'); ?>


            </div>


        </div>


    </div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/customer/dashboard.blade.php ENDPATH**/ ?>