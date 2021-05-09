
<div class="row px-2">

<?php if($products): ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php
        if ($product->discount_price) {
            $sell_price = $product->discount_price;
        } else {
            $sell_price = $product->product_price;
        }
        ?>
                <div class="col-md-2 col-lg-2 col-sm-6 col-6 p-1">
                    <div class="card ">
                        <div class="box">
                            <a  href="<?php echo e(url('/')); ?>/<?php echo e($product->product_name); ?>" > <img src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/thumb/<?php echo e($product->feasured_image); ?>" alt="<?php echo e($product->product_title); ?>">
                       </a> </div>
                        <div class="card-body">
                            <p class="product-title"><a  href="<?php echo e(url('/')); ?>/<?php echo e($product->product_name); ?>" ><?php echo e($product->product_title); ?> </a></p>
                            <div class="text-center price ">
                                <?php
                                if($product->discount_price){


                                    ?>
                                <p> <?php echo 'Tk.' . $product->product_price;?></p>

                                    <?php


                                    }
                                    ?>
                                <p> <?php echo 'Tk.' . $sell_price;?></p>
                            </div>

                        </div>
                    </div>
                </div>



    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</div>
<?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/category_ajax.blade.php ENDPATH**/ ?>