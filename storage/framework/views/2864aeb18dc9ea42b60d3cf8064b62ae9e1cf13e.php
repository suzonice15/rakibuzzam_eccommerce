<?php $__env->startSection('mainContent'); ?>
    <div class="container-fluid my-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>


                <li class="breadcrumb-item " aria-current="page"><a href="<?php echo e(url('/shops')); ?>" >Shops</a></li>

                <li class="breadcrumb-item active " aria-current="page"><?php echo e($vendor_link); ?></li>

            </ol>
        </nav>




    </div>



    <div class="container-fluid">







               <span id="post-data">

                                                  <?php echo $__env->make('website.vendor.vendor_shop_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

           </span>





    </div>



    <input type="hidden"  id="vendor_link" name="vendor_link" value="<?php echo e($vendor_link); ?>">

    <script type="text/javascript">

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function() {


            page++;

            loadMoreData(page);



        });


        function loadMoreData(page){
            var vendor_link=$('#vendor_link').val();
            jQuery.ajax(

                {

                    url:"<?php echo e(url('/vendor-shop-ajax-product')); ?>?page="+page+"&vendor_link="+vendor_link,

                    type: "get",

                    beforeSend: function()

                    {

                        //jQuery('.ajax-load').show();

                    }

                })

                .done(function(data)

                {
                    // console.log(data.html)
                    if(data.html == " "){

                        jQuery('.ajax-load').html("No more records found");

                        return;

                    }

                    jQuery('.ajax-load').hide();

                    jQuery("#post-data").append(data.html);

                })

                .fail(function(jqXHR, ajaxOptions, thrownError)

                {

                    // alert('server not responding...');

                });

        }

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/vendor/vendor_shop.blade.php ENDPATH**/ ?>