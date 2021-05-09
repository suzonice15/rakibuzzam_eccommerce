@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>

                        <th scope="col">order Id</th>
                        <th scope="col">Products</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Created date</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if($orders)
                        @foreach($orders as $order)
                    <tr>

                        <td>{{$order->order_id}}</td>



                        <td>

                            <?php



                            $order_items = unserialize($order->products);

                            if(is_array($order_items['items'])) {
                            foreach ($order_items['items'] as $product_id => $item) {
                            $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                            $product = single_product_information($product_id);
                            $sku = $product->sku;
                            $name = $product->product_name;

                            ?>
                            <a  target="_blank" href="{{url('/')}}/{{ $name }}">


                                <span class="btn btn-info" style="height: 29px; width:150px;display: block;overflow: hidden" ><?=($item['name'])?></span>


                                <br/>
                                <img  src="<?=$featured_image?>" />
                                ✖
                                <?=($item['qty'])?>
                            </a>
                            <br>





                            <?php
                            }
                            }


                            ?>



                        </td>




                        <td>{{$order->order_status}}</td>
                        <td>{{$order->order_date}}</td>



                    </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>


        </div>

    </div>

@endsection