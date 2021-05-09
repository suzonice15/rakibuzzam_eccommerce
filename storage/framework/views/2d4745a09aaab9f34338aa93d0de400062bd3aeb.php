

<?php
if ($products) {
$i = 0;
    $html='';
foreach ($products as $product) {
$product_link = 'product/' . $product->product_name;
// product price
$product_price = $product->product_price;
$product_title = $product->product_title;
$product_discount = $product->discount_price;
$sku = $product->sku;
if ($product_discount >0) {
$sell_price = $product_discount;
} else {
$sell_price = $product_price;
}
//$image = get_product_thumb($product->product_id);

if ($i <= 7) {
    ?>



    <li>
        <a
                href="<?php echo e(url('/')); ?>/<?php echo e($product->product_name); ?>">
        <img style="padding-top: 13px;" src="<?php echo e(url('/public/uploads')); ?>/<?php echo e($product->folder); ?>/thumb/<?php echo e($product->feasured_image); ?>"
             width="50"/> <span><?php echo e($product->product_title); ?></span>

        <p class="search-price"><span> <?php echo 'Tk.' . $sell_price;?></span>
           <?php if($product_discount >0): ?>
            <span> <del><?php echo 'Tk.' . $product->product_price;?></del> </span>
               <?php endif; ?>

        </p>
        </a>
    </li>


<?php
}

$i++;
}
if($i >= 7){
$total_product = DB::table('product')->where('status','=',1)->where(function ($query) use ($search_query){
        return $query->where('sku','LIKE','%'.$search_query.'%')
        ->orWhere('product_title','LIKE','%'.$search_query.'%');
    })->count();
$more_product=$total_product-$i;
 ?>

<li ><a style="background: #679767;text-align: center;padding: 16px 9px;color:white !important;"
        href="<?php echo e(url('search')); ?>?search=<?php echo e($search_query); ?>"><?php echo e($more_product); ?> more
        results</a></li>
<?php } ?>

<?php
}

?>
<?php /**PATH C:\SXampp\htdocs\RakibZaman\resources\views/website/search_engine.blade.php ENDPATH**/ ?>