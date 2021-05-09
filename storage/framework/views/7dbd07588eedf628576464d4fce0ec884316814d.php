<?php $__env->startSection('mainContent'); ?>

        <div class="container-fluid my-2">

        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <?php if(isset($category_name_first)) { ?>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo e(url('/category/')); ?>/<?php echo e($category_name_first); ?>"><?php echo e($category_title_first); ?></a> </li>
                    <?php } ?>
                    <?php if(isset($category_name_middle)) { ?>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo e(url('/category/')); ?>/<?php echo e($category_name_middle); ?>" ><?php echo e($category_title_middle); ?></a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active " aria-current="page"><a href="<?php echo e(url('/category/')); ?>/<?php echo e($category_name_last); ?>" ><?php echo e($category_title_last); ?></a></li>

                </ol>
                </nav>
            
             

           
        </div>
         


    <div class="container-fluid">


            <h4  class="mt-2 mb-2"><?php echo e($category_title_last); ?></h4>





               <span id="post-data">

             <?php echo $__env->make('website.category_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

           </span>





    </div>
    <input type="hidden"  id="category_name" name="category_name" value="<?php echo e($category_name); ?>">

    <script type="text/javascript" async>

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function() {

            if($(window).scrollTop() + $(window).height()>= $(document).height()) {
                page++;

                loadMoreData(page);
            }



        });


        function loadMoreData(page){
   var category_name=$('#category_name').val();
            jQuery.ajax(

                {

                    url:"<?php echo e(url('/ajax_category')); ?>?page="+page+"&category_name="+category_name,

                    type: "get",


                })

                .done(function(data)

                {
                // console.log(data.html)
                    if(data.html == " "){

                        jQuery('.ajax-load').html("No more records found");

                        return;

                    }



                    jQuery("#post-data").append(data.html);

                })



        }

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/category.blade.php ENDPATH**/ ?>