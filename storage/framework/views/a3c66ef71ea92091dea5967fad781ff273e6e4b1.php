
<?php $__env->startSection('profile_master'); ?>


    <div class="row">


        <div class="col-md-6">

            <form method="post" action="<?php echo e(url('/customer/profile/update')); ?>" enctype="multipart/form-data">

<?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="user_name">Name</label> <input type="text"
                                                               name="name"
                                                               id="user_name"
                                                               class="form-control"
                                                               value="<?php echo e($user->name); ?>">
                </div>
                <div class="form-group"><label for="user_phone">Phone</label> <input type="text"
                                                                                     name="phone"
                                                                                     id="user_phone"
                                                                                     class="form-control"
                                                                                     value="<?php echo e($user->phone); ?>">
                </div>
                <div class="form-group"> <label for="user_email">Email</label>
                    <input type="text"    name="email"
                                                                                     id="user_email"
                                                                                     class="form-control"
                                                                                     value="<?php echo e($user->email); ?>" />


                                </div>

                <div class="form-group">
                    <label for="user_address">Address</label>


                    <textarea name="address" id="user_address" class="form-control"><?php echo e($user->address); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="user_address">Picture</label>


                    <input name="user_picture" type="file" class="form-control">
                </div>






                <button type="submit" class="btn btn-primary">Update Profile</button>

            </form>

        </div>

        <div class="col-md-6">



        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.customer.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/customer/profile.blade.php ENDPATH**/ ?>