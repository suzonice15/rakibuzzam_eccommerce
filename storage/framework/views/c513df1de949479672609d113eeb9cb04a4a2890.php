
<?php $__env->startSection('mainContent'); ?>

    <div class="container-fluid my-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>

                <li class="breadcrumb-item active " aria-current="page">All Shop</li>

            </ol>
        </nav>




    </div>



    <div class="container-fluid">




        <div class="row px-2">

            <?php if($shops): ?>
                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                    <div class="col-md-2 col-lg-2 col-sm-6 col-6 p-1">
                        <div class="card ">
                            <div class="box">
                                <a  href="<?php echo e(url('/')); ?>/shop/<?php echo e($shop->vendor_link); ?>" >

                                    <?php if($shop->vendor_shop_image): ?>
                                    <img src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($shop->folder); ?>/thumb/<?php echo e($shop->vendor_shop_image); ?>" alt="<?php echo e($product->product_title); ?>">
                                    <?php else: ?>
                                        <img class="img-fluid" src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/c9764a164112-4.png">

                                    <?php endif; ?>

                                </a>

                            </div>
                            <div class="card-body">
                                <p class="product-title"><a  href="<?php echo e(url('/')); ?>/shop/<?php echo e($shop->vendor_link); ?>" ><?php echo e($shop->vendor_shop); ?> </a></p>

                            </div>
                        </div>
                    </div>



                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>




    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/allShop.blade.php ENDPATH**/ ?>