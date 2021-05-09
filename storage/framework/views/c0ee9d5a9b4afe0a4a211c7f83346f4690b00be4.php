
<?php $__env->startSection('profile_master'); ?>


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>

                        <th scope="col">order Id</th>
                        <th scope="col">Products</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Created date</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php if($orders): ?>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($order->order_id); ?></td>



                        <td>

                            <?php



                            $order_items = unserialize($order->products);

                            if(is_array($order_items['items'])) {
                            foreach ($order_items['items'] as $product_id => $item) {
                            $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                            $product = single_product_information($product_id);
                            $sku = $product->sku;
                            $name = $product->product_name;

                            ?>
                            <a  target="_blank" href="<?php echo e(url('/')); ?>/<?php echo e($name); ?>">


                                <span class="btn btn-info" style="height: 29px; width:150px;display: block;overflow: hidden" ><?=($item['name'])?></span>


                                <br/>
                                <img  src="<?=$featured_image?>" />
                                ✖
                                <?=($item['qty'])?>
                            </a>
                            <br>





                            <?php
                            }
                            }


                            ?>



                        </td>




                        <td><?php echo e($order->order_status); ?></td>
                        <td><?php echo e($order->order_date); ?></td>



                    </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>


        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.customer.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/customer/orders.blade.php ENDPATH**/ ?>