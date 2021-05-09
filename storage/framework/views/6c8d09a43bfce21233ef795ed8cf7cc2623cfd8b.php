
<?php $__env->startSection('profile_master'); ?>


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th scope="col">Order Id</th>
                        <th scope="col">points</th>
                        <th scope="col">Get Point date</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php if($points): ?>
                        <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($point->order_id); ?></td>








                        <td><?php echo e($point->point); ?></td>
                        <td><?php echo e($point->point_earning_date); ?></td>



                    </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>


        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.customer.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/customer/points.blade.php ENDPATH**/ ?>