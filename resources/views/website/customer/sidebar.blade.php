


<br>

<?php
        $picture=Session::get('picture');
if($picture){
?>
<img   style="border-radius: 50%;"  class="img-fluid"  src="{{url('/')}}/public/uploads/users/{{$picture}}">
<?php } else { ?>
<img  style="border-radius: 50%;"  class="img-fluid"  src="{{url('/')}}/public/uploads/user.jpg">

<?php } ?>

<div class="vertical-menu">

 <a href="{{url('/')}}/customer/dasboard">My Profile</a>
 <a href="{{url('/')}}/customer/orders">My Orders</a>
 <a href="{{url('/')}}/customer/points">My Point </a>
 <a href="{{url('/')}}/customer/changed_password">Changed Password</a>
 <a href="{{url('/')}}/customer/logout">Logout </a>

 </div>