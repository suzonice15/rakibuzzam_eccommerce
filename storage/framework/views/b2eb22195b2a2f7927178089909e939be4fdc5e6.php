<?php $__env->startSection('mainContent'); ?>


    <div class="container-fluid" id="cart">

        <div class="row order_tank_you_class my-4">


        <?php


            if ( !Cart::isEmpty()){ ?>

            <div class="col-md-12  col-lg-12 col-12 ">



                    <div class="card">
                        <div class="card-heading text-start fw-bold ms-3 fs-4"><b>Order Review</b>
                        </div>
                    <div class="card-body">


					<span class="checkout-fields">


							<div class="checkoutstep">
                                <div class="cart-info" >
<div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <tbody>
                                        <tr>
                                            <th width="1%" class="name">Sl</th>
                                            <th   width="30%"  class="name">Products</th>
                                            <th  width="10%" class="name">Product Code</th>
                                            <th  width="20%" class="name">Quantity</th>
                                            <th   width="15%" class="name">Price</th>
                                            <th   width="15%" class="name">Total</th>
                                            <th   width="5%" class="total text-right">Remove </th>
                                        </tr>

                                        <?php
                                        $quntity = 0;
                                        $count=0;
                                        $items = \Cart::getContent();

                                        foreach ($items as $row) {
                                    //    $subTotal = \Cart::getSubTotal();
                                        $total = \Cart::getTotal();
                                        $subTotal_price=$row->price*$row->quantity;
                                        $imagee=$row->attributes['picture'];
                                        $product_id=$row->id;

                                  $product=      single_product_information($product_id);
                                  $sku=$product->sku;
                                  $name=$product->product_name;


                                        ?>
                                            <tr id="<?=$row->id?>">
                                                <td>


                                                    <?php echo ++$count; ?>
                                                </td>
                                                <td>
                                                    <img src="<?=$imagee?>" width="30">

                                                    <a href="<?php echo e(url('/')); ?>/<?php echo e($name); ?>" target="_blank"><?=$row->name?></a>
                                                </td>
                                                <td>
                                                  <?=$sku?>
                                                </td>


                                                  <td>
                                <a class="btn btn-sm btn-info  plus_cart_item" id="<?=$row->id;?>" href="javascript:void(0);">
                                    <span class="text-white fa fa-plus"></span>
                                </a>
                                <span id="cart_quantity_<?php echo e($row->id); ?>"> <?=$row->quantity;?></span>
                                <a class="btn  btn-sm btn-danger minus_cart_item" id="<?=$row->id;?>" href="javascript:void(0);">
                                    <span class="fa fa-minus text-white"></span>
                                </a>
                            </td>

                                                <td>
													<span
                                                        id="per_poduct_price">  <?php echo 'Tk.' . $row->price;?></span>

                                                </td>
                                                <td>
												<span id="per_poduct_total_price_<?= $row->id?>">

												 <?php echo 'Tk.' . $subTotal_price;?>

													</span>



                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       onclick="CartDataRemove('<?= $row->id?>')"
                                                       style="color:red ;font-weight: bold;padding: 2px 5px;margin-left: 12px;">
                                                        <span class="fa fa-trash btn btn-danger"></span>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>

</div>

                                    <table class="table table-striped table-bordered review_cost">
                                        <tbody>

                                       <tr>
                                            <td>
                                                <span class="extra bold totalamout">Total</span>
                                            </td>
                                            <td class="text-right">
													<span class="bold totalamout"><span
                                                            id="total_cost">


                                                        												 <?php echo 'Tk.' . $total;?>

                                                        </span></span>


                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
									  <a style="margin-left: 1px;" href="<?php echo e(url('/')); ?>/checkout"  class="btn btn-info text-white">Checkout</a>


                    <a  href="<?php echo e(url('/')); ?>"    style="background-color:#FF6061;border: none" class="btn btn-info  text-white" >continue shopping</a>
                                </div>
                            </div>

                    </span>

                </div>


            </div>
            <?php } else { ?>
            <div class="col-md-12 h-100 text-center"><a href="<?php echo e(url('/')); ?>"><img style="margin-bottom: -68px"
                                                                                       src="<?php echo e(url('/')); ?>images/stop.png"/></a>
            </div>
            <div class="col-md-12 mt-5 h-100 text-center">
                <h1 class="text-danger text-center text-capitalize">You have no product in your cart.
                </h1>
                <a class="text-center text-capitalize btn btn-info" href="<?php echo e(url('/')); ?>"> back to home</a>
            </div>
            <?php } ?>

        </div>

    </div>

    </div>
    <script>
        $('.plus_cart_item').click(function () {
          let product_id= $(this).attr('id');
          let quantity=$('#cart_quantity_'+product_id).text();
            quantity=quantity.trim();

            jQuery.ajax(

                {

                    url:"<?php echo e(url('/plus_cart_item')); ?>?product_id="+product_id,
                    type: "get",


                })

                .done(function(data)

                {
                    $('body .count').text(data.result.count);
                    $('body .value').text(data.result.total);

                    jQuery("#cart").html(data.html);

                })

                .fail(function(jqXHR, ajaxOptions, thrownError)

                {

                    // alert('server not responding...');

                });


        })
    </script>

    <script>
        $('.minus_cart_item').click(function () {
            let product_id= $(this).attr('id');
            let quantity=$('#cart_quantity_'+product_id).text();
            quantity=quantity.trim();

            jQuery.ajax(

                {

                    url:"<?php echo e(url('/minus_cart_item')); ?>?product_id="+product_id,
                    type: "get",


                })

                .done(function(data)

                {
                    $('body .count').text(data.result.count);
                    $('body .value').text(data.result.total);

                    jQuery("#cart").html(data.html);

                })

                .fail(function(jqXHR, ajaxOptions, thrownError)

                {

                    // alert('server not responding...');

                });


        })
    </script>

    <script>
        function CartDataRemove(id){


            jQuery.ajax(

                {

                    url:"<?php echo e(url('/remove_cart_item')); ?>?product_id="+id,
                    type: "get",


                })

                .done(function(data)

                {

                    $('body .count').text(data.result.count);
                    $('body .value').text(data.result.total);

                    jQuery("#cart").html(data.html);

                })

                .fail(function(jqXHR, ajaxOptions, thrownError)

                {

                    // alert('server not responding...');

                });


        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/cart.blade.php ENDPATH**/ ?>