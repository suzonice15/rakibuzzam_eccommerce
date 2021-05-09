@if(isset($orders))
    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
    @foreach ($orders as $order)
        <tr>



            <td>{{ $order->order_id }}</td>
            <td>{{ $order->customer_name }}
                {{ $order->customer_phone }}
                {{ $order->order_area }}
                <br>
                Dhaka


            </td>


            <td><?php

                  $affilite=  DB::table('users_public')->select('name','phone')->where('id',$order->user_id)->first();
                    if($affilite){
                        $affite_user="$affilite->name"."<br>".$affilite->phone;
                    } else {

                        $affite_user="<p>Non Affilite</p>";
                    }

                $order_items = unserialize($order->products);
                $sku=0;
                $name=0;
                if(is_array($order_items['items'])) {
                    foreach ($order_items['items'] as $product_id => $item) {
                        $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                        $product = single_product_information($product_id);
                    if($product){
                        $sku = $product->sku;
                        $name = $product->product_name;
                    }

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


            <td><?php

                $order_items = unserialize($order->products);
                $vendor_id=0;
                if(is_array($order_items['items'])) {
                foreach ($order_items['items'] as $product_id => $item) {

                $product = single_product_information($product_id);
                    if($product){
                $vendor_id=$product->vendor_id;
                    }
                if($vendor_id==0){
                   $owner=" Sohojbuy Product";
                } else {
              $vendor_result= DB::table('vendor')->where('vendor_id',$vendor_id)->first();
              }

                ?>

                <?php
                if($vendor_id==0){

                    ?>

                   <?php echo $owner; ?>

              <?php  }  else {


                ?>
                <a  target="_blank" href="{{URL::to('/admin/vendor/view'.'/'.$vendor_id)}}">
                     <?php echo $vendor_result->vendor_shop; ?>
                </a>
                <br>
                <?php }
                }
                }
                ?>



            </td>




        <?php

        $stuff=  DB::table('admin')->select('name','admin_id')->where('admin_id',$order->staff_id)->first();
        if($stuff){
            if($stuff->admin_id >0){
            ?>
            <td>
                <span class="badge badge-info"><?=$order->created_by?></span>

                <button type="button" class="btn btn-info orderEditModal" data-order_id="<?=$order->order_id?>" data-toggle="modal" data-target="#orderEditModal">
                    <?=$stuff->name?>
                </button>
            </td>
            <?php

            }  else {

            ?>

            <td>

                <span class="badge badge-info"><?=$order->created_by?></span>

            </td>


<?php

        }
                } else { ?>



            <td>

                <span class="badge badge-info"><?=$order->created_by?></span>


            </td>
         <?php
                }
            ?>

            <td><?php echo $affite_user ?></td>
            <td> @money($order->order_total)
                </td>

            <td>
                <?php if($order->order_status=='pending_payment'){
                    ?>

                <span   style="background-color:yellow">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='new') { ?>
                    <span   class="btn btn-info">{{ $order->order_status }}</span>

                <?php  } elseif ($order->order_status=='processing') { ?>
                    <span   class="btn btn-info">{{ $order->order_status }}</span>

                <?php  } elseif ($order->order_status=='on_courier') { ?>

                    <span   class="btn btn-danger">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='delivered') { ?>
                    <span   class="btn btn-success">{{ $order->order_status }}</span>

                <?php  } elseif ($order->order_status=='refund') { ?>

                    <span   class="btn btn-danger">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='cancled') { ?>
                    <span   class="btn btn-danger">{{ $order->order_status }}</span>
                <?php } else {  ?>

                    <span   class="btn btn-success">{{ $order->order_status }}</span>
                <?php } ?>


            </td>
            <td>{{date('d-F-Y h:i:s a',strtotime($order->created_time))}}</td>

            <td>
                <a title="edit" href="{{ url('admin/order') }}/{{ $order->order_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>

                {{--<a title="edit" href="{{ url('admin/order/invoice-print') }}/{{ $order->order_id }}">--}}
                    {{--<span class="glyphicon glyphicon-print btn btn-info"></span>--}}
                {{--</a>--}}

                <button type="button"  class="btn btn-info orderPrint mt-2" data-order_id="{{$order->order_id }}" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-fw fa-print"></i>
                </button>
                {{--<a title="delete" href="{{ url('admin/product/delete') }}/{{ $order->product_id }}" onclick="return confirm('Are you want to delete this Product')">--}}
                    {{--<span class="glyphicon glyphicon-trash btn btn-danger"></span>--}}
                {{--</a>--}}


                <div class="input-group input-group-lg">


                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                            <span class="fa fa-caret-down"></span></button>

                        <ul class="dropdown-menu">
                            <li><a href="{{url('/')}}/admin/order/status/changed/cancled/{{$order->order_id}}">Cancel</a></li>
                            <li><a href="{{url('/')}}/admin/order/status/changed/phone_pending/{{$order->order_id}}">Phone Pending</a></li>
                            <li><a href="{{url('/')}}/admin/order/status/changed/pending_payment/{{$order->order_id}}">Pending Payment</a></li>
                            <li><a href="{{url('/')}}/admin/order/status/changed/processing/{{$order->order_id}}">processing</a></li>
                            <li><a href="{{url('/')}}/admin/order/status/changed/on_courier/{{$order->order_id}}">On Courier</a></li>
                            <li><a href="{{url('/')}}/admin/order/status/changed/delivered/{{$order->order_id}}">Delivered</a></li>
                            <li><a href="{{url('/')}}/admin/order/status/changed/refund/{{$order->order_id}}">Refund</a></li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $orders->links() !!}
        </td>
    </tr>
@endif

<!-- /.modal -->

<script>

        $(document).on('click','.orderPrint',function () {

            var order_id= $(this).data("order_id")

            $.ajax({
                url:"{{url('/admin/orderModalPrint')}}/"+order_id,
                method:"GET",
                success:function (data) {
                    $('#orderModalPrint').html(data);

                }

            })
        })
    </script>

    <script>

        $(document).on('click','.orderEditModal',function () {

            var order_id= $(this).data("order_id")

            $.ajax({
                url:"{{url('/admin/orderEditHistory')}}/"+order_id,
                method:"GET",
                success:function (data) {
                    console.log(data)
                     $('.ordereditshow').html(data);

                }

            })
        })
    </script>


