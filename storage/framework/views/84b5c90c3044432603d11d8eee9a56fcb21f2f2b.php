<?php $__env->startSection('mainContent'); ?>


    <div class="container-fluid ">
        <div class="row px-2 ">
            <div class="col-md-3 desktop-menu d-none  d-lg-block d-xl-bloc d-xxl-block">


                <ul class="">

                    <?php

                    $categories = DB::table('category')
                            ->select('category_id', 'category_title', 'category_name')
                            ->where('parent_id', 0)->where('status', 1)
                            ->paginate(13);
                    if($categories){
                    foreach ($categories as $first){
                    $firstCategory_id = $first->category_id;
                    $secondCategories = DB::table('category')
                            ->select('category_id', 'category_title', 'category_name')
                            ->where('parent_id', $firstCategory_id)
                            ->orderBy('category_id', 'ASC')->get();
                    if(count($secondCategories) > 0){

                    ?>
                    <li class="">
                        <a href="<?php echo e(url('/category')); ?>/<?php echo e($first->category_name); ?>"><?php echo e($first->category_title); ?> </a>
                        <span class="right-main-menu-icon"><i class="fa fa-angle-right"></i></span>


                        <ul class="sub-menu-ul">

                            <?php foreach ($secondCategories as $second){

                            $secondCategory_id = $second->category_id;
                            $thirdCategories = DB::table('category')->select('category_title', 'category_name')->where('parent_id', $secondCategory_id)->orderBy('category_id', 'ASC')->get();


                            if($thirdCategories){
                            ?>

                            <li class="">

                                <a href="<?php echo e(url('/category')); ?>/<?php echo e($second->category_name); ?>"><?php echo e($second->category_title); ?> </a>
                                <span class="right-main-menu-icon"><i class="fa fa-angle-right"></i></span>


                                <ul class="sub-sub-menu-ul">


                                    <?php $__currentLoopData = $thirdCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thirdCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="">

                                            <a href="<?php echo e(url('/category')); ?>/<?php echo e($thirdCategory->category_name); ?>"><?php echo e($thirdCategory->category_title); ?></a>

                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </ul>


                            </li> <?php }  else { ?>
                            <li class="">
                                <a href="<?php echo e(url('/category')); ?>/<?php echo e($second->category_name); ?>"> <?php echo e($second->category_title); ?></a>
                            </li>

                            <?php } } ?>


                        </ul>


                    </li>
                    <?php } else { ?>


                    <li class=""><a
                                href="<?php echo e(url('/category')); ?>/<?php echo e($first->category_name); ?>"><?php echo e($first->category_title); ?></a>
                    </li>
                    <?php

                    }
                    }
                    }
                    ?>

                </ul>


            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">


                        <div class="slider mt-3">
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">

                                    <?php $count =-1;?>
                                    <?php if($sliders): ?>
                                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php $count++;?>

                                            <button type="button" data-bs-target="#carouselExampleDark"
                                                    data-bs-slide-to="<?php echo e($count); ?>" <?php if($count==1) { echo 'class=active';} ?>
                                                    aria-current="true" aria-label="Slide 1"></button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="carousel-inner">

                                    <?php if($sliders): ?>
                                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <div class="carousel-item active" data-bs-interval="10000">
                                                <img src="<?php echo e(url('public/uploads/sliders')); ?>/<?php echo e($slider->homeslider_picture); ?>"
                                                     class="d-block w-100 img" alt="...">

                                            </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </div>
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleDark"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleDark"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>


                    </div>


                    <div class="col-12  col-lg-12 col-xl-12 py-3">
                        <div class="row">

                   <?php if($recentProducts): ?>
                       <?php $__currentLoopData = $recentProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php

                                    if ($product->discount_price) {
                                        $sell_price = $product->discount_price;
                                    } else {
                                        $sell_price = $product->product_price;
                                    }

                                    ?>
                                        <div class="col-md-6 col-lg-3 col-sm-6 col-6 col-xl-3 p-1">
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
                    </div>


                </div>
            </div>

        </div>
    </div>



    <div class="container-fluid ">


        <span class="home_page_category"></span>


    </div>
    </div>


    <script>

        jQuery.ajax(
                {

                    url: "<?php echo e(url('/home_page_category_ajax')); ?>",

                    type: "get",


                })

                .done(function (data) {
                    // console.log(data.html)
                    if (data.html == " ") {


                    }


                    jQuery(".home_page_category").html(data.html);

                    jQuery('.home-owl-carousel').each(function () {

                        var owl = $(this);
                        var itemPerLine = owl.data('item');

                        if (!itemPerLine) {
                            itemPerLine = 7;

                        }
                        owl.owlCarousel({
                            items: itemPerLine,
                            itemsTablet: [768, 2],
                            itemsDesktopSmall: [979, 2],
                            itemsDesktop: [1199, 2],
                            itemsMobile: [1199, 2],
                            navigation: true,
                            pagination: false,
                            autoPlay: true,

                            navigationText: ["", ""]
                        });
                    });

                })

                .fail(function (jqXHR, ajaxOptions, thrownError) {


                });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/home.blade.php ENDPATH**/ ?>