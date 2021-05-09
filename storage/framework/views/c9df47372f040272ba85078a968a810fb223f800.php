<!DOCTYPE html>
<html lang="en">
<head>


    <?php


    $customer_id = Session::get('customer_id');


    if (isset($page_title)) {
        $title = $page_title . '-' . get_option('site_title');
    } else {

        $title = get_option('site_title');
    }




    ?>
            <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title><?=$title?></title>
    <link rel="shortcut icon" href="<?=get_option('icon')?>">
    <!-- Bootstrap Core CSS -->
    <!-- Customizable CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/font_end/')); ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/font_end/')); ?>/css/stellarnav.css">


    <meta name="title" content="<?php if (isset($seo_title)) {
        echo $seo_title;
    }?>"/>
    <meta name="keywords" content="<?php if (isset($seo_keywords)) {
        echo $seo_keywords;
    }?>"/>
    <meta name="description" content="<?php if (isset($seo_description)) {
        echo $seo_description;
    }?>"/>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="_base_url" content="<?php echo e(url('/')); ?>">

    <meta name="robots" content="index,follow"/>


    <link rel="canonical" href="<?php echo e(url()->current()); ?>"/>
    <meta property="og:locale" content="EN"/>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>"/>
    <meta property="og:type" content="<?php if (isset($seo_description)) {
        echo $seo_description;
    }?>"/>
    <meta property="og:title" content="<?php if (isset($seo_title)) {
        echo $seo_title;
    }?>"/>
    <meta property="og:description" name="description" content="<?php if (isset($seo_description)) {
        echo $seo_description;
    }?>"/>
    <meta property="og:image" content="<?php if (isset($share_picture)) {
        echo $share_picture;
    } ?>"/>
    <meta property="og:site_name" content="<?php if (isset($seo_keywords)) {
        echo $seo_keywords;
    }?>"/>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


</head>
<body>


<header class="bg-white">
    <div class="container-fluid desktop-header d-none d-lg-block d-xl-block d-xxl-block">
        <div class="row px-5 pt-3 pb-3" style="border-bottom: 1px solid #9c9a9a;">
            <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 d-none d-lg-block d-xl-block d-xxl-block">
                <a href="<?php echo e(url('/')); ?>"> <img class="img-fluid logo-image"
                                             src="https://bdeshishop.com/_nuxt/img/Logo-gif.07de684.gif"></a>

            </div>
            <div class="col-8 col-lg-8 col-xl-8 col-xxl-8">
                <form action="<?php echo e(url('search')); ?>" method="get">
                    <div class="input-group">

                        <input type="text" name="search" required  class="form-control searchbox desktop-search-field"
                               placeholder="Search Product">
                        <div class="input-group-append">
                            <button class="btn btn-secondary search" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>

                    <ul class="desktop-search-menu">


                    </ul>
                </form>

            </div>
            <div class="col-lg-2 col-xl-2 col-xxl-2 d-none d-lg-block d-xl-block d-xxl-block">
                <div class="d-flex justify-content-center mt-2">
                    <a href="<?php echo e(url('/')); ?>/wishlist" class="me-3"> <i class="fs-5 fw-bold far fa-heart"></i>

                        <?php if(Session::get('total_wishlist_count')>0): ?>
                            <span id="cart_count"><?php echo e(Session::get('total_wishlist_count')); ?></span>
                        <?php endif; ?>
                    </a>
                    <a href="<?php echo e(url('/')); ?>/cart" class="me-3">
                        <i class="fs-5 fw-bold far fa-cart-plus"></i>
                        <?php if(Session::get('total_cart_count')>0): ?>
                            <span id="cart_count"><?php echo e(Session::get('total_cart_count')); ?></span>
                        <?php endif; ?>

                    </a>
                    <?php if(Session::get('customer_id')): ?>

                        <a href="<?php echo e(url('/')); ?>/customer/dasboard" class="me-3">

                            <?php
                            $picture=Session::get('picture');
                            if($picture){
                            ?>
                            <img   style="border-radius: 50%;width: 29px;position: absolute;top: 14px;height: 37px;"   class="img-fluid"  src="<?php echo e(url('/')); ?>/public/uploads/users/<?php echo e($picture); ?>">
                            <?php } else { ?>
                            <img  style="border-radius: 50%;width: 29px;position: absolute;top: 14px;height: 37px;"   class="img-fluid"  src="<?php echo e(url('/')); ?>/public/uploads/user.jpg">

                            <?php } ?>

                        </a>


                    <?php else: ?>

                    <a href="<?php echo e(url('/')); ?>/customer/login" class="me-3"> <i class="fs-5 fw-bold fal fa-user"></i></a>

                        <?php endif; ?>


                </div>

            </div>
        </div>


    </div>

    <div class="container-fluid mobile-header d-block d-md-block d-sm-block d-lg-none d-xl-none ">
        <div class="row p-2 " style="border-bottom: 1px solid #9c9a9a;">

            <div class="col-1">


            </div>
            <div class="col-11">
                <form action="<?php echo e(url('search')); ?>" method="get">

                <div class="input-group">
                    <input type="text" required class="form-control searchbox desktop-search-field" placeholder="Search Product">
                    <div class="input-group-append">
                        <button class="btn btn-secondary search" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <ul class="desktop-search-menu">


                </ul>
              </form>


            </div>

        </div>

        <div class="stellarnav mobile-menu-responsive">
            <ul>


                <li><a href="<?php echo e(url('/all-products')); ?>">All Products</a></li>

                <?php

                $categories = DB::table('category')
                        ->select('category_id', 'category_title', 'category_name')
                        ->where('parent_id', 0)
                        ->where('status', 1)->get();


                if($categories){



                foreach ($categories as $first){
                $firstCategory_id = $first->category_id;
                $secondCategories = DB::table('category')->select('category_id', 'category_title', 'category_name')->where('parent_id', $firstCategory_id)->orderBy('category_id', 'ASC')->get();

                if(count($secondCategories) > 0){



                ?>
                <li><a href="<?php echo e(url('/category')); ?>/<?php echo e($first->category_name); ?>"><?php echo e($first->category_title); ?></a>
                    <ul>
                        <?php foreach ($secondCategories as $second){

                        $secondCategory_id = $second->category_id;
                        $thirdCategories = DB::table('category')->select('category_title', 'category_name')->where('parent_id', $secondCategory_id)->orderBy('category_id', 'ASC')->get();
                        if(count($thirdCategories) > 0){
                        ?>

                        <li><a href="#"><?php echo e($second->category_title); ?></a>
                            <ul>
                                <?php foreach ($thirdCategories as $third) {?>
                                <li><a href="<?php echo e(url('/category')); ?>/<?php echo e($third->category_name); ?>"><?php echo e($third->category_title); ?></a>
                                </li>
                                <?php } ?>

                            </ul>
                        </li>
                        <?php } else { ?>
                        <li><a href="<?php echo e(url('/category')); ?>/<?php echo e($second->category_name); ?>"><?php echo e($second->category_title); ?></a></li>


                        <?php } }?>


                    </ul>
                </li>

                <?php } else { ?>

                <li><a href="<?php echo e(url('/category')); ?>/<?php echo e($first->category_name); ?>"><?php echo e($first->category_title); ?></a></li>

                <?php
                }

                }
                }
                ?>


            </ul>
        </div>

    </div>

    <div class="container-fluid d-none d-lg-block d-xl-block d-xxl-block" style="background-color: black;height: 55px;">
        <div class="row px-2 pt-3 pb-3 col-md-12">
            <div class="col-md-3 col-sm-2 col-lg-3  col-xl-3 col-xxl-3  col-3 ">
                <div class="d-block text-white desktopMenuCategoryClickShow"
                     style="cursor: pointer;
         height: 56px;
         background-color: #E91B2A;
         margin-top: -17px;
         width: 300px;
         padding: 16px 5px;">
                    <div class="d-inline p-2 ms-4">
                        <i class="fa fa-bars fs-6 fw-bold text-white"></i>
                    </div>
                    <div class="d-inline MenuCategory text-xl text-center ps-2 p-2 text-uppercase fs-6 fw-bold">
                        Categories
                    </div>
                    <div class="d-inline p-2 " style="float:right;margin-top:-8px;margin-right:21px">
                        <i class="fa fa-angle-down fs-6 fw-bold text-white"></i>
                    </div>
                </div>


                <?php $other_route = URL::current() != url('/');  if($other_route == 1) { ?>
                <div class="desktop-menu" style="margin-top: 0px;
left: 19px;
z-index: 19;
position: absolute;display: none">
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

                <?php } ?>

            </div>
            <div class="col-md-9 col-sm-10 col-xl-9 col-xxl-9 col-lg-9 ">
                <a href="<?php echo e(url('/')); ?>/all-products" class="ms-5 mt-5 all-shop"> All Product</a>
                <a href="<?php echo e(url('/')); ?>/shops" class="ms-5 mt-5 all-shop"> All Shops</a>
                 <a href="<?php echo e(url('/')); ?>/track-your-order" class="ms-5 mt-5 all-shop"> Track My Order</a>
                <a href="<?php echo e(url('/')); ?>/faq" class="ms-5 mt-5 all-shop"> FAQ</a>
                <a href="<?php echo e(url('/')); ?>/vendor/login" class="ms-5 mt-5 all-shop"> Vendor</a>
                <a href="https://affiliate.com" class="ms-5 mt-5 all-shop"> Affiliate </a>
                <a href="<?php echo e(url('/')); ?>/help" class="ms-5 mt-5 all-shop"> Help</a>
             </div>
        </div>
    </div>
</header>

<?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/includes/header.blade.php ENDPATH**/ ?>