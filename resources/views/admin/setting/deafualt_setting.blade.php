@extends('layouts.master')
@section('pageTitle')
    Update Default Website Information
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/default/setting')  }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Default Website  Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 28px;">
                        <div class="form-group ">
                            <label for="site_title">Site Title</label>
                            <input type="text" class="form-control" name="site_title" id="site_title"
                                   value="<?= get_option('site_title') ?>">
                        </div>

                        <div class="form-group >">
                            <label for="logo">Logo(size 280 * 80)</label>
                            <input type="text" class="form-control" name="logo" id="logo" value="<?= get_option('logo') ?>">
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon(size 64 * 64 )</label>
                            <input type="text" class="form-control" name="icon" id="icon" value="<?= get_option('icon') ?>">
                        </div>


                        <div class="form-group ">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   value="<?= get_option('phone') ?>">
                        </div>



                        <div  class="form-group ">
                            <label for="footer">Phone to Order</label>
                            <textarea class="form-control" rows="5"
                                      name="phone_order"><?= get_option('phone_order') ?></textarea>
                        </div>

                        <div  class="form-group ">
                            <label for="footer">Adress</label>
                            <textarea class="form-control" rows="9"
                                      name="address"><?= get_option('address') ?></textarea>
                        </div>


                        <div  class="form-group ">
                            <label for="admin_email">Admin Email</label>
                            <input type="text" class="form-control" name="admin_email" id="admin_email"
                                   value="<?= get_option('admin_email') ?>">
                        </div>

                        <div class="form-group  ">
                            <label for="shipping_charge_in_dhaka">Shipping Charge In Dhaka</label>
                            <input type="text" class="form-control" name="shipping_charge_in_dhaka"
                                   id="shipping_charge_in_dhaka" value="<?= get_option('shipping_charge_in_dhaka') ?>">
                        </div>

                        <div class="form-group ">
                            <label for="shipping_charge_out_of_dhaka">Shipping Charge Out Of Dhaka</label>
                            <input type="text" class="form-control" name="shipping_charge_out_of_dhaka"
                                   id="shipping_charge_out_of_dhaka"
                                   value="<?= get_option('shipping_charge_out_of_dhaka') ?>">
                        </div>

                        <div class="form-group ">
                            <label for="shipping_charge_out_of_dhaka">Bkash Number</label>
                            <input type="text" class="form-control" name="bkash"
                                   id="bkash"
                                   value="<?= get_option('bkash') ?>">
                        </div>



                        <div class="form-group ">
                            <label for="default_product_terms">Default Product Terms</label>
                            <textarea class="form-control ckeditor" rows="10"
                                      name="default_product_terms"><?= get_option('default_product_terms') ?></textarea>
                        </div>
                        <div class="form-group ">
                            <label for="default_product_terms">Google Map</label>
                            <textarea class="form-control" rows="2"
                                      name="map"><?=get_option('map')?></textarea>
                        </div>

                          <div class="form-group ">
                            <label for="bad_word">Bad Word of Message</label>
                            <textarea class="form-control" rows="4"
                                      name="bad_word"><?=get_option('bad_word')?></textarea>
                        </div>
                    </div>
                </div>




                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update">

                </div>
            </form>


            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("#category_title").on('input click', function () {
                var text = $("#category_title").val();
                var _token = $("input[name='_token']").val();

                var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $("#category_name").val(word);
                $.ajax({
                    data: {url: word, _token: _token},
                    type: "POST",
                    url: "{{url('category-urlcheck')}}",
                    success: function (result) {

                        // $('#categoryError').html(result);
                        var str2 = "es";
                        var word = $("#category_name").val(word);
                        if (result) {
                            var text = $("#category_title").val();
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            var word = word.concat(str2);
                            $("#category_name").val(word);

                        } else {
                            var text = $("#category_title").val();
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            $("#category_name").val(word);
                        }
                    }
                });
            });


        });
    </script>




@endsection


