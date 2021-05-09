<?php $__env->startSection('mainContent'); ?>


    <?php


    $vendor_id = $product->vendor_id;
    $review_count = DB::table('review')->where('product_id', $product->product_id)->count();
    $reviews = DB::table('review')->where('product_id', $product->product_id)->get();

    if ($vendor_id > 0) {
        $vendor = DB::table('vendor')->select('vendor_link', 'vendor_shop')->where('vendor_id', $vendor_id)->first();
        $shop_link = $vendor->vendor_link;
        $shop_name = $vendor->vendor_shop;
    }

    /*# product stock availability #*/
    $product_availabie = $product->product_stock;
    $product_availability = '<span class="text-success"> In Stock</span>';
    if ($product_availabie == 0) {
        $product_availability = '<span class="text-danger">Out Of Stock</span>';

    }
    $product_id_related = $product->product_id;
    ?>



    <div class="container-fluid my-2 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <?php if(isset($category_name_first)) { ?>
                <li class="breadcrumb-item"><a
                            href="<?php echo e(url('/category/')); ?>/<?php echo e($category_name_first); ?>"><?php echo e($category_title_first); ?></a></li>
                <?php } ?>
                <?php if(isset($category_name_middle)) { ?>
                <li class="breadcrumb-item"><a
                            href="<?php echo e(url('/category/')); ?>/<?php echo e($category_name_middle); ?>"><?php echo e($category_title_middle); ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item"><a
                            href="<?php echo e(url('/category/')); ?>/<?php echo e($category_name_last); ?>"><?php echo e($category_title_last); ?></a></li>
                <li class="breadcrumb-item active"><?php echo e($product->product_title); ?></li>
            </ol>
        </nav>

    </div>

    <div class="container-fluid my-2">
        <div class='row px-2'>


            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">

                <div class="card">
                    <img src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->feasured_image); ?>"
                         class="card-img-top" id="main_picture" alt="<?php echo e($product->product_title); ?>">



                </div>

                <ul class="thumb-image">
                    <?php
                    if($product->galary_image_1){
                    ?>

                    <li>
                        <img class="img-responsive thum_image_hover " width="85"
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->feasured_image); ?>"/>

                    </li>
                    <?php } ?>
                    <?php
                    if($product->galary_image_1){
                    ?>

                    <li>
                        <img class="  thum_image_hover " width="85" alt=""
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_1); ?>"/>

                    </li>
                    <?php } ?>
                    <?php
                    if($product->galary_image_2){
                    ?>

                    <li>
                        <img class="img-responsive thum_image_hover " width="85" alt=""
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_2); ?>"/>

                    </li>
                    <?php } ?>
                    <?php
                    if($product->galary_image_3){
                    ?>

                    <li>
                        <img class="img-responsive thum_image_hover " width="85" alt=""
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_3); ?>"/>

                    </li>
                    <?php } ?>
                    <?php
                    if($product->galary_image_4){
                    ?>

                    <li>
                        <img class="img-responsive thum_image_hover " width="85" alt=""
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_4); ?>"/>

                    </li>
                    <?php } ?>
                    <?php
                    if($product->galary_image_5){
                    ?>

                    <li>
                        <img class="img-responsive thum_image_hover " width="85" alt=""
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_5); ?>"/>

                    </li>
                    <?php } ?>
                    <?php
                    if($product->galary_image_6){
                    ?>

                    <li>
                        <img class="img-responsive thum_image_hover " width="85" alt=""
                             src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_6); ?>"/>

                    </li>
                    <?php } ?>


                </ul>



            </div>


            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7"
                 style="background-color:white;border-radius: 2px;">


                <h1 class="single-product-title"><?php echo e($product->product_title); ?></h1>
                <p class="product-code">Product Code: <?php echo e($product->sku); ?> </p>

                <div class="stock-product">
                    <span style="font-size: 14px;font-weight: bold;" class="label">In Stock  :</span>
                    <span style="font-weight: bold"><?php echo e($product->product_stock); ?></span>
                    <?php
                    if(isset($shop_link)){
                    ?>
                    <p class="fw-bold fs-5">Shop : <a href="<?php echo e(URL::to('shop/'.$shop_link)); ?>"><?php echo e($shop_name); ?></a></p>
                    <?php }?>

                </div>

                <div class="available-product">
                    <span style="font-size: 14px;font-weight: bold;" class="label">Availability :</span>
                    <span style="font-weight: bold"><?=$product_availability?></span>

                </div>

                <?php if($product->product_specification): ?>
                    <div class="product-short-description">
                        <p style="margin-bottom: 2px;
color: black;
font-weight: normal;">Product Short Description</p>

                        <?php echo $product->product_specification ?>

                    </div>
                <?php endif; ?>

                <div class="single-price">
                    <?php
                    if ($product->discount_price) {
                        $sell_price = $product->discount_price;

                    } else {
                        $sell_price = $product->product_price;
                    }
                    ?>
                    <span class="current-price fs-1 fw-bold text-dark"> <?php echo 'Tk.' . $sell_price;?></span>
                    <?php if($product->discount_price): ?>
                        <span class="old-price   fw-bold text-danger fs-4"> <del><?php echo 'Tk.' . $product->product_price;?> </del></span>
                    <?php endif; ?>


                </div>

                <div class="row add-to-cart-section">

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-4">


                    <div style="float: left; border: solid 1px #24b193; width: 150px; height: 39px;margin-left:5px">
                        <div style="color:orangered;font-size: 25px;text-align: center; width: 50px; float: left; cursor: pointer;font-weight: bold;"
                             onclick="DecrementFunction()">
                            -
                        </div>
                        <span style="font-size: 25px;text-align: center;color: gray; width: 50px; float: left; cursor: pointer;border-right: 1px solid #24b193;border-left: 1px solid #24b193;font-weight: bold;"
                              id="quantity">1</span>

                        <div onclick="IncrementFunction()" style="font-weight: bold;color:orangered;font-size: 25px;text-align: center; width: 40px; float: left;
                                                             cursor: pointer;">
                            +
                        </div>
                    </div>
                   </div>

                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-8">
   <a data-product_id="<?php echo e($product->product_id); ?>"  data-picture="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                                             class="btn btn-primary add_to_cart text-white" href="javascript:void(0)"> ADD TO CART</a>
                                                    <a href="javascript:void(0)" data-product_id="<?php echo e($product->product_id); ?>"
                                                       data-picture="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                                        class="btn btn-success buy-now-cart text-white"> BUY NOW </a>
                                                    <button data-product_id="<?php echo e($product->product_id); ?>"  class="btn btn-success add-to-wishlist icon" data-toggle="dropdown" type="button" >
                                                        <i class="icon fa fa-heart"></i>
                                                    </button>
                                                




                    </div>

                    </div>


              

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    <h4 style="font-weight:bold;color:red;" class="mt-3">ফোনে অর্ডারের জন্য
                    ডায়াল করুন</h4>

                        <div class="col-sm-6 col-xs-12" style="padding:0">
                            <h4 style="font-size:22px;margin: 15px 0 15px 0;text-align:center;color:red;font-weight:900;text-align: left">


                                <?=get_option('phone_order')?>
                            </h4>
                        </div>

                        <div class="col-sm-12 col-md-12  col-xs-12 col-lg-12" style="display:flex;flex-direction:row;">
                            <img style="width: 60px;padding: 10px"
                                 class="img-responsive pull-left mobile-icon"
                                 src="http://www.egbazar.com//front_asset/d.png"
                                 alt="Call azibto" title="Call azibto">
                            <h3 class="font-size-title-mobile"
                                style="font-weight: bold;font-size: 18px;text-align:left;margin-top: 17px;">
                                ঢাকায় ডেলিভারি খরচ:
                                ৳ <?=$product->delivery_in_dhaka?></h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12" style="display:flex;flex-direction:row;">
                            <img style="width: 60px;padding: 10px"
                                 class="img-responsive pull-left  mobile-icon"
                                 src="http://www.egbazar.com//front_asset/od.png"
                                 alt="Call azibto" title="Call azibto">
                            <h3 class="font-size-title-mobile"
                            style="font-weight: bold;font-size: 18px;text-align:left;margin-top: 17px;">
                                ঢাকার বাইরের ডেলিভারি খরচ: ৳<?=$product->delivery_out_dhaka?>
                            </h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-xs-12" style="display:flex;flex-direction:row;">
                            <img style="width: 60px;padding: 10px"
                                 class="img-responsive pull-left  mobile-icon"
                                 src="http://www.egbazar.com//front_asset/bk.png"
                                 alt="Call azibto" title="Azibto  ">
                            <h3 class="font-size-title-mobile"
                            style="font-weight: bold;font-size: 18px;text-align:left;margin-top: 17px;" >
                                বিকাশ নাম্বার: <?=get_option('bkash')?>
                            </h3>
                        </div>
                    </div>

                </div>
                <!-- /.row -->


            </div>
        </div>

        </div>


    <div class="container-fluid my-2" style="background-color:white">
        <div class="row px-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">terms and condition</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Review</button>
                </li>
                <?php if($product->product_video){?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="video" aria-selected="false">Video</button>
                </li>

                <?php } ?>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <?php echo $product->product_description; ?>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <?php echo get_option('default_product_terms'); ?>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><p>Under construction</p></div>
                <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab"><p>  <iframe width="500" height="345"
                                                                                                               src="https://www.youtube.com/embed/<?php echo $product->product_video;?>">
                        </iframe></p></div>


            </div>

        </div>
    </div>

    <div class="container-fluid my-2" style="background-color:white">
        <span id="related_product"></span>

    </div>



    <input type="hidden" id="related_product_id" name="product_id" value="<?php echo $product_id_related; ?>">

    <script>
        jQuery(document).ready(function () {


            var product_id = jQuery('#related_product_id').val();


            $.ajax({

                url: "<?php echo e(url('related/product')); ?>?product_id=" + product_id,
                method: "get",
                success: function (data) {

                    jQuery("#related_product").html(data.html);


                }
            });
        });

    </script>
<script>


    function IncrementFunction(){
        var quantity=parseInt($("#quantity").text());

        if(quantity){
            quantity= quantity+1;
        }
        $("#quantity").text(quantity);
    }
    function DecrementFunction(){
        var quantity=parseInt($("#quantity").text());

        if(quantity >1){
            quantity= quantity-1;
        }
        $("#quantity").text(quantity);
    }
    $(document).on('click','.thum_image_hover',function () {

        const thumb_image=$(this).attr('src');

        $("#main_picture").attr('src',thumb_image)



    })


</script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/product.blade.php ENDPATH**/ ?>