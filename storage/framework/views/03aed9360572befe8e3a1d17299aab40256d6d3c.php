
<?php $__env->startSection('mainContent'); ?>

     
        <div class="container-fluid my-2">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>

                    <li class="breadcrumb-item active " aria-current="page"><a href="<?php echo e(url('/all-products/')); ?>">All Products</a></li>

                    </ol>
                </nav>
        </div>

       
    
         <div class="container-fluid">
          

                                            <span id="post-data">
                                                  <?php echo $__env->make('website.all_product_by_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </span>

                 
            </div>

        </div>
    

    <script type="text/javascript" >

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function () {


                page++;
                loadMoreData(page);



        });


        function loadMoreData(page) {
            jQuery.ajax(
                    {    url: "<?php echo e(url('/all_ajax_products')); ?>?page=" + page,
                        type: "get",
                      }).done(function (data) {
                         if (data.html == " ") {
                            jQuery('.ajax-load').html("No more records found");
                            return;
                        }

                        jQuery('.ajax-load').hide();

                        jQuery("#post-data").append(data.html);

                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {

                        // alert('server not responding...');

                    });

        }

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/all_products.blade.php ENDPATH**/ ?>