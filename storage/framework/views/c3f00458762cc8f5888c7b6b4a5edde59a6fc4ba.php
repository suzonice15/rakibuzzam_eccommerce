


<br>

<?php
        $picture=Session::get('picture');
if($picture){
?>
<img   style="border-radius: 50%;"  class="img-fluid"  src="<?php echo e(url('/')); ?>/public/uploads/users/<?php echo e($picture); ?>">
<?php } else { ?>
<img  style="border-radius: 50%;"  class="img-fluid"  src="<?php echo e(url('/')); ?>/public/uploads/user.jpg">

<?php } ?>

<div class="vertical-menu">

 <a href="<?php echo e(url('/')); ?>/customer/dasboard">My Profile</a>
 <a href="<?php echo e(url('/')); ?>/customer/orders">My Orders</a>
 <a href="<?php echo e(url('/')); ?>/customer/points">My Point </a>
 <a href="<?php echo e(url('/')); ?>/customer/changed_password">Changed Password</a>
 <a href="<?php echo e(url('/')); ?>/customer/logout">Logout </a>

 </div><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/customer/sidebar.blade.php ENDPATH**/ ?>