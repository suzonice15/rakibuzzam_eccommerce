<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use AdminHelper;
use URL;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set('Asia/Dhaka');

    }

    public function index()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }

        $data['main'] = 'Orders';
        $data['active'] = 'All Orders';
        $data['title'] = '  ';
        $data['order_status'] = 'new';
        $orders = DB::table('order_data')->where('order_status', 'new')->orderBy('order_id', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'), $data);
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $orders = DB::table('order_data')->where('order_status', $status)->orderBy('order_id', 'desc')
                ->paginate(10);
            return view('admin.order.pagination', compact('orders'));
        }

    }

    public function pagination_by_search(Request $request)
    {

        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $orders = DB::table('order_data')->orWhere('order_id', 'LIKE', '%' . $query . '%')
                ->orWhere('customer_phone', 'LIKE', '%' . $query . '%')->orderBy('order_id', 'desc')
                ->paginate(10);
            return view('admin.order.pagination', compact('orders'));
        }

    }


    public function pagination_by_status(Request $request)
    {
        if ($request->ajax()) {


            $status = $request->get('status');
            $orders = DB::table('order_data')->where('order_status', $status)->orderBy('order_id', 'desc')
                ->paginate(10);
            return view('admin.order.pagination', compact('orders'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $status = Session::get('status');
        if ($status == 'super-admin' || $status == 'office-staff' || $status == 'editor') {

            $user_id = AdminHelper::Admin_user_autherntication();
            $url = URL::current();

            if ($user_id < 1) {
                //  return redirect('admin');
                Redirect::to('admin')->with('redirect', $url)->send();

            }

            $data['main'] = 'Orders';
            $data['active'] = 'All orders';
            $data['title'] = '  ';
            $data['order'] = DB::table('order_data')->where('order_id', 268)->first();


            $data['couriers'] = DB::table('courier')->get();
            $data['products'] = DB::table('product')->select('product_id', 'product_title', 'sku')->orderby('product_id', 'desc')->get();


            return view('admin.order.create', $data);
        } else {
            return redirect()->back();
        }


    }

    public function store(Request $request)
    {
        $data['order_status'] = $request->order_status;
        $order_status = $request->order_status;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['created_time'] = date("Y-m-d H:i:s");
        $data['created_by'] = Session::get('name');
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data['order_date'] = date("Y-m-d");
        $data['order_total'] = $request->order_total;
        $data['products'] = serialize($request->products);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['courier_service'] = $request->courier_service;
        $data['staff_id'] = Session::get('id');
        //$data['delevery_address'] = $request->delevery;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['discount_price'] = $request->discount_price;
        $data['advabced_price'] = $request->advabced_price;
        $data['order_note'] = $request->order_note;
        //   $data['payment_type'] = $request->payment_type;
        // $data['city'] = $request->city');
        //$row_data['order_remark'] = $request->order_remark');


        if ($order_status == 'delivered') {

        }


        // $customer_name = $data['customer_name'];
        // $customer_email = $data['customer_email'];
        // $site_title = get_option('site_title');
        // $site_email = get_option('email');


        if ($request->shipment_time) {

            $data['shipment_time'] = date('Y-m-d H:i:s', strtotime($request->shipment_time));
        }


        $order_data = DB::table('order_data')->insertGetId($data);

        /// order edit track
        $order_track['status'] = $order_status;
        $order_track['user_id'] = Session::get('id');
        $order_track['order_id'] = $order_data;
        $order_track['updated_date'] = date('Y-m-d H:i:s');
        $order_track['user_name'] = Session::get('name');
        $order_track['order_note'] = $request->order_note;
        DB::table('order_edit_track')->insert($order_track);


        if ($order_data) {


            return redirect('admin/orders')->with('success', 'Created successfully.');
        } else {

            return redirect('admin/orders/')->with('error', 'Error to Create this order');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }


        $data['main'] = 'Orders';
        $data['active'] = 'Update Orders';
        $data['title'] = 'Update Orders Data';
        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();


        $data['couriers'] = DB::table('courier')->get();
        $data['products'] = DB::table('product')->select('product_id', 'product_title', 'sku')->orderby('product_id', 'desc')->get();


        return view('admin.order.edit', $data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {


        $order_number = $id;
        $statusInfoCheck = $request->order_status;
        //vendor amount add..


        if ($statusInfoCheck == 'completed') {
            $cashBackInfo = DB::table('order_data')
                ->where('order_id', $order_number)
                ->first();
            $info = DB::table('users_public')
                ->where('id', $cashBackInfo->order_from_affilite_id)
                ->first();
            if ($info) {
                $preCash = $info->cash_back;
                $presentCash = ($preCash + $cashBackInfo->cash_back);
                $data_customer['cash_back'] = $presentCash;
                $updateInfo = DB::table('users_public')
                    ->where('id', $cashBackInfo->order_from_affilite_id)
                    ->update($data_customer);
                }




        }
        $data['order_status'] = $request->order_status;

        $order_status = $request->order_status;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['discount_price'] = $request->discount_price;
        $data['advabced_price'] = $request->advabced_price;
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data['order_total'] = $request->order_total;
        $data['products'] = serialize($request->products);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['courier_service'] = $request->courier_service;

        $data['order_note'] = $request->order_note;
        //   $data['payment_type'] = $request->payment_type;
        // $data['city'] = $request->city');
        //$row_data['order_remark'] = $request->order_remark');


        $data['staff_id'] = Session::get('id');


        /// order edit track
        $order_track['status'] = $order_status;
        $order_track['user_id'] = Session::get('id');
        $order_track['order_id'] = $order_number;
        $order_track['updated_date'] = date('Y-m-d H:i:s');
        $order_track['user_name'] = Session::get('name');
        $order_track['order_note'] = $request->order_note;
        DB::table('order_edit_track')->insert($order_track);


        // $customer_name = $data['customer_name'];
        // $customer_email = $data['customer_email'];
        // $site_title = get_option('site_title');
        // $site_email = get_option('email');


        if ($request->shipment_time) {

            $data['shipment_time'] = date('Y-m-d H:i:s', strtotime($request->shipment_time));
        }


        $order_data = DB::table('order_data')->where('order_id', $order_number)->update($data);


        /// Commision calcution
        if ($order_status == 'completed') {


            // top product sell

            $BackBonasInfo = DB::table('order_data')
                ->where('order_id', $order_number)
                ->first();
            $info = DB::table('users_public')
                ->where('id', $BackBonasInfo->user_id)
                ->first();
            if ($info) {

                $mainWithdrawh = $info->withdraw_balance;
                $finalWithdraw = ($mainWithdrawh + $BackBonasInfo->bonus_balance);
                $bonashdata_customer['withdraw_balance'] = $finalWithdraw;
                $updateInfo = DB::table('users_public')
                    ->where('id', $BackBonasInfo->user_id)
                    ->update($bonashdata_customer);

            }



           $order_details = DB::table('order_data')->select('products')->where('order_id', $order_number)->first();
                $order_items = unserialize($order_details->products);
                if (is_array($order_items['items'])) {
                    foreach ($order_items['items'] as $product_id => $item) {

                            $top_product_sell['quantity'] =$item['qty'];
                            $top_product_sell['product_id'] =$product_id;
                            $top_product_sell['order_id'] =$order_number;
                            $top_product_sell['order_id'] =$order_number;
                            $top_product_sell['sell_price'] =$item['price'];
                              DB::table('top_product_sell')->insert($top_product_sell);


                    }
                }

            $this->commisionDistribution($order_number, $request->totalCommision);
            $this->pointDistribution($order_number);

            $affiliate_id=DB::table('order_data')
                ->select('user_id','order_from_affilite_id')
                ->where('order_id',$order_number)->first();
            if($affiliate_id->user_id >0){

                 $loopCount =count($request->commion_product_id);
                for($i=0;$i<$loopCount;$i++){
                    $commision_data['order_id']=$order_number;
                    $commision_data['product_id']=$request->commion_product_id[$i];
                    $commision_data['comission']=$request->commision[$i];
                    $commision_data['affilate_id']=$affiliate_id->user_id;
                    $commision_data['date']=date('Y-m-d');
                    DB::table('product_permission_report')->insert($commision_data);

                }
            }



        }

        if ($order_status == 'cancled') {
            $BackBonasInfo = DB::table('order_data')
                ->where('order_id', $order_number)
                ->first();
            $info = DB::table('users_public')
                ->where('id', $BackBonasInfo->user_id)
                ->first();
            if ($info) {
                DB::table('withdraw_history')
                     ->where('order_id', $order_number)
                     ->delete();
                $preCash = $info->bonus_balance;
                $presentCash = ($preCash + $BackBonasInfo->bonus_balance);
                $bonashdata_customer['bonus_balance'] = $presentCash;
                $updateInfo = DB::table('users_public')
                    ->where('id', $BackBonasInfo->user_id)
                    ->update($bonashdata_customer);
                $data_orderback_bonas['bonus_balance']=0;
                $BackBonasInfo = DB::table('order_data')
                    ->where('order_id', $order_number)
                    ->update($data_orderback_bonas);
                }
        }


        if ($order_data) {
/// stock add
            if ($order_status == 'cancled') {
                $order_details = DB::table('order_data')->where('order_id', $order_number)->first();
                $order_items = unserialize($order_details->products);
                if (is_array($order_items['items'])) {
                    foreach ($order_items['items'] as $product_id => $item) {


                        $product_stock = DB::table('product')->select('product_stock')->where('product_id', $product_id)->first();
                        if ($product_stock) {
                            $stock['product_stock'] = $product_stock->product_stock + $item['qty'];
                            $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);

                        }
                    }
                }
            }


            return redirect('admin/orders')
                ->with('success', 'Updated successfully.');
        } else {

            return redirect('admin/order/' . $order_number)
                ->with('success', 'Error to update this order');
        }


    }

    // point distribution to normal user

    function pointDistribution($order_id)
    {

        $order_details = DB::table('order_data')->where('order_id', $order_id)->first();
        if ($order_details->customer_id > 0) {


            if (!empty($order_details)) {

                $order_id = $order_details->order_id;
                $baseID = $order_details->customer_id; // order korse je tar userid
                $order_items = unserialize($order_details->products);
                if (is_array($order_items['items'])) {
                    $single_product_point = 0;
                    foreach ($order_items['items'] as $product_id => $item) {
                        $single_product = DB::table('product')->select('product_point')
                            ->where('product_id', $product_id)->first();
                        $single_product_point += $single_product->product_point * $item['qty'];
                    }

                    $user = DB::table('users')->where('id', $baseID)->first();
                    if ($user) {
                        $points = $user->points;
                        $data['points'] = $single_product_point + $points;
                    }
                    if (!empty($baseID)) {
                        DB::table('users')->where('id', $baseID)->update($data);
                    }

                    //all insert query start from here.
                    if (!empty($baseID)) {
                        $row_data['order_id'] = $order_id;
                        $row_data['user_id'] = $baseID;
                        $row_data['point'] = $data['points'];
                        DB::table('user_point_history')->insert($row_data);

                    }


                }


            }


        }
    }


    function commisionDistribution($order_id, $commision_price)
    {

        $order_details = DB::table('order_data')->where('order_id', $order_id)->first();

            if (!empty($order_details)) {
                $single_product_point=0;
                $order_id = $order_details->order_id;
                $order_items = unserialize($order_details->products);
                if (is_array($order_items['items'])) {

                    foreach ($order_items['items'] as $product_id => $item) {

                        $single_product = DB::table('product')
                            ->select('product_profite', 'product_point', 'vendor_id', 'vendor_price', 'discount_price')
                            ->where('product_id', $product_id)->first();
                        $single_product_point += $single_product->product_point * $item['qty'];
                        if ($single_product->vendor_id != 0) {
                            $vendorInfo = DB::table('vendor')
                                ->where('vendor.vendor_id', $single_product->vendor_id)
                                ->select('vendor.life_time_earning', 'vendor.amount')
                                ->first();
                            $vendor_life_amount = $vendorInfo->life_time_earning + $single_product->vendor_price*$item['qty'];
                            $adminPrice = ($single_product->discount_price - $single_product->vendor_price);
                            $adminPriceData = array();
                            $adminPriceData['vendor_id'] = $single_product->vendor_id;
                            $adminPriceData['amount'] = $adminPrice*$item['qty'];
                            $adminPriceData['date'] = date("Y-m-d");;
                            $adminPriceData['product_id'] = $product_id;
                            $adminPriceData['order_id'] = $order_id;
                            $adminPriceData['vendor_amount'] = $single_product->vendor_price*$item['qty'];
                            DB::table('vendor_price_commution')
                                ->insert($adminPriceData);
                            $vendor_amount = $vendorInfo->amount + $single_product->vendor_price*$item['qty'];
                            $dataUpdateVendor = array();
                            $dataUpdateVendor['life_time_earning'] = $vendor_life_amount;
                            $dataUpdateVendor['amount'] = $vendor_amount;
                            DB::table('vendor')
                                ->where('vendor.vendor_id', $single_product->vendor_id)
                                ->update($dataUpdateVendor);
                        }
                    }
                }
            }




        /// affiliate order from  website
        if ($order_details->user_id > 0) {
            /// affiliate order from  website
            $user_id = $order_details->user_id;
            //  order count
            $order_id = $order_details->order_id;
            $order_items = unserialize($order_details->products);
            if (is_array($order_items['items'])) {
                $single_product_profit = 0;
                $single_product_point = 0;
                $mrp_total_price = 0;
                $top_deal = 0;
                foreach ($order_items['items'] as $product_id => $item) {
                    $single_product = DB::table('product')->select('product_profite', 'top_deal', 'product_point', 'product_price', 'vendor_id', 'vendor_price', 'discount_price')->where('product_id', $product_id)->first();

                }
            }
                $son_data = DB::table('users_public')->where('id', $user_id)->first();
                /// son income
                if ($son_data) {
                    $base_name = $son_data->name;
                    $father_id = $son_data->parent_id; // got parent id of son

                    $son_commistion = $commision_price;
                    $son_array['earning_balance'] = $son_data->earning_balance + $son_commistion ;
                    $son_array['life_time_earning'] = $son_data->life_time_earning + $son_commistion ;

                    /* Royalty fund */
                   $fund= DB::table('royalty_fund')->where('royalty_fund_id','=',1)->first();
                    $fund_commision=($commision_price*1)/100;
                    $previous_fund=$fund->amount;
                    $after_fund['amount']=$previous_fund+$fund_commision;
                    $fund_result=DB::table('royalty_fund')->where('royalty_fund_id','=',1)->update($after_fund);

                    /* Royalty fund history */
                    if($fund_result){
                        $fund_history['user_id']=$user_id;
                        $fund_history['amount']=$fund_commision;
                        $fund_history['order_id']=$order_id;
                        $fund_history['created_at']=date("Y-m-d");
                        DB::table('royalty_fund_history')->insert($fund_history);
                    }

                    /// father income
                    if ($father_id) {
                        $father_commition = ($son_commistion * 10) / 100;
                        $father = DB::table('users_public')->where('id', $father_id)->first();
                        // $earning_history_2['earner_name'] = $father->name;
                        $father_array['earning_balance'] = $father->earning_balance + $father_commition;
                        $father_array['life_time_earning'] = $father->life_time_earning + $father_commition ;

                    }



                }


                if (!empty($son_data)) {

                    DB::table('users_public')->where('id', $user_id)->update($son_array);

                }
                if (!empty($father_id)) {

                    DB::table('users_public')->where('id', $father_id)->update($father_array);

                }


                //all insert query start from here.
                if (!empty($user_id)) {
                    $earning_history_3['order_id'] = $order_id;
                    $earning_history_3['earner_name'] = $base_name;
                    $earning_history_3['earner_id'] = $user_id;
                    $earning_history_3['commision'] = $son_commistion;
                    $earning_history_3['earning_for_id'] = $user_id;
                    $earning_history_3['permission'] = 1;
                    DB::table('earning_history')->insert($earning_history_3);

                }
                if (!empty($father_id)) {
                    $earning_history_2['order_id'] = $order_id;
                    $earning_history_2['earner_name'] = $base_name;
                    $earning_history_2['earner_id'] = $user_id;
                    $earning_history_2['commision'] = $father_commition;
                    $earning_history_2['earning_for_id'] = $father_id;
                    $earning_history_3['permission'] = 2;
                    DB::table('earning_history')->insert($earning_history_2);

                }

        }

    }


    public function courierViewReport()
    {
        $data['main'] = ' Courier';
        $data['active'] = 'All Courier';
        $data['title'] = '  ';
        $data['order_status'] = 'new';
        $data['couriers'] = DB::table('courier')->get();
        $data['orders_total'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->count();
        $data['orders_total_refund'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'refund')
            ->count();
        $data['orders_total_oncurrier'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'on_courier')
            ->count();
        $data['orders_total_completed'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'completed')
            ->count();
        $data['orders_total_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->sum('order_total');
        $data['orders_total_refund_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'refund')
            ->sum('order_total');
        $data['orders_total_on_courier_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'on_courier')
            ->sum('order_total');
        $data['orders_total_completed_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'completed')
            ->sum('order_total');

        return view('admin.order.courierViewReport', $data);
    }

    public function courierViewReportPagination(Request $request)
    {
        if ($request->ajax()) {


            $courier_id = $request->get('courier_id');
            $data['orders_total'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->count();
            $data['orders_total_refund'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'refund')
                ->count();
            $data['orders_total_oncurrier'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'on_courier')
                ->count();
            $data['orders_total_completed'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'completed')
                ->count();
            $data['orders_total_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->sum('order_total');
            $data['orders_total_refund_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'refund')
                ->sum('order_total');
            $data['orders_total_on_courier_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'on_courier')
                ->sum('order_total');
            $data['orders_total_completed_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'completed')
                ->sum('order_total');
            $orders = DB::table('order_data')
                ->where('courier_service', $courier_id)
                ->orderBy('order_id', 'desc')
                ->paginate(10);
            return view('admin.order.courierViewReportPagination', compact('orders'), $data);
        }
    }

    public function invoicePrint($id)
    {

        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $data['orderData'] = DB::table('order_data as od')
            ->join('courier as c', 'c.courier_id', '=', 'od.courier_service')
            ->where('order_id', $id)
            ->select('c.*')
            ->first();

        return view('admin.order.invoice_view', $data);
    }

    public function orderModalPrint($id)
    {

        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $data['orderData'] = DB::table('order_data as od')
            ->join('courier as c', 'c.courier_id', '=', 'od.courier_service')
            ->where('order_id', $id)
            ->select('c.*')
            ->first();

        return view('admin.order.modal_invoice', $data);
    }

    public function orderEditHistory($id)
    {

        $data['orders'] = DB::table('order_edit_track')
            ->where('order_id', $id)
            ->orderBy('order_edit_track_id', 'desc')
            ->get();
        return view('admin.order.orderEditHistory', $data);

    }

    public function orderReport()
    {

          
           $data['years']=date('Y');
           $data['month']=date('m');
         $today=date("Y-m-d");
           $data['new_count']=$this->orderCount('new',$today);
           $data['phone_pending_count']=$this->orderCount('phone_pending',$today);
           $data['pending_payment_count']=$this->orderCount('pending_payment',$today);
           $data['processing_count']=$this->orderCount('processing',$today);
           $data['on_courier_count']=$this->orderCount('on_courier',$today);
           $data['delivered_count']=$this->orderCount('delivered',$today);
           $data['refund_count']=$this->orderCount('refund',$today);
           $data['completed_count']=$this->orderCount('completed',$today);
           $data['cancled_count']=$this->orderCount('cancled',$today);

           $data['new_sum']=$this->orderSum('new',$today);
           $data['phone_pending_sum']=$this->orderSum('phone_pending',$today);
           $data['pending_payment_sum']=$this->orderSum('pending_payment',$today);
           $data['processing_sum']=$this->orderSum('processing',$today);
           $data['on_courier_sum']=$this->orderSum('on_courier',$today);
           $data['delivered_sum']=$this->orderSum('delivered',$today);
           $data['refund_sum']=$this->orderSum('refund',$today);
           $data['completed_sum']=$this->orderSum('completed',$today);
           $data['cancled_sum']=$this->orderSum('cancled',$today);

         return view('admin.order.orderReport', $data);

    }
    public function orderReportGeneration(Request $request)
{


    if($request->day && $request->month){

        $data['years']=date("Y",strtotime($request->month));
        $data['month']=date("m",strtotime($request->month));
        $today=date("Y-m-d",strtotime($request->day));
        $data['new_count']=$this->orderCount('new',$today);
        $data['phone_pending_count']=$this->orderCount('phone_pending',$today);
        $data['pending_payment_count']=$this->orderCount('pending_payment',$today);
        $data['processing_count']=$this->orderCount('processing',$today);
        $data['on_courier_count']=$this->orderCount('on_courier',$today);
        $data['delivered_count']=$this->orderCount('delivered',$today);
        $data['refund_count']=$this->orderCount('refund',$today);
        $data['completed_count']=$this->orderCount('completed',$today);
        $data['cancled_count']=$this->orderCount('cancled',$today);

        $data['new_sum']=$this->orderSum('new',$today);
        $data['phone_pending_sum']=$this->orderSum('phone_pending',$today);
        $data['pending_payment_sum']=$this->orderSum('pending_payment',$today);
        $data['processing_sum']=$this->orderSum('processing',$today);
        $data['on_courier_sum']=$this->orderSum('on_courier',$today);
        $data['delivered_sum']=$this->orderSum('delivered',$today);
        $data['refund_sum']=$this->orderSum('refund',$today);
        $data['completed_sum']=$this->orderSum('completed',$today);
        $data['cancled_sum']=$this->orderSum('cancled',$today);
        return view('admin.order.orderReportView', $data);
    }
    if($request->month){
        $data['years']=date("Y",strtotime($request->month));
        $data['month']=date("m",strtotime($request->month));
        return view('admin.order.orderReportView', $data);
    }
    if($request->day){
        $today=date("Y-m-d",strtotime($request->day));
        $data['new_count']=$this->orderCount('new',$today);
        $data['phone_pending_count']=$this->orderCount('phone_pending',$today);
        $data['pending_payment_count']=$this->orderCount('pending_payment',$today);
        $data['processing_count']=$this->orderCount('processing',$today);
        $data['on_courier_count']=$this->orderCount('on_courier',$today);
        $data['delivered_count']=$this->orderCount('delivered',$today);
        $data['refund_count']=$this->orderCount('refund',$today);
        $data['completed_count']=$this->orderCount('completed',$today);
        $data['cancled_count']=$this->orderCount('cancled',$today);

        $data['new_sum']=$this->orderSum('new',$today);
        $data['phone_pending_sum']=$this->orderSum('phone_pending',$today);
        $data['pending_payment_sum']=$this->orderSum('pending_payment',$today);
        $data['processing_sum']=$this->orderSum('processing',$today);
        $data['on_courier_sum']=$this->orderSum('on_courier',$today);
        $data['delivered_sum']=$this->orderSum('delivered',$today);
        $data['refund_sum']=$this->orderSum('refund',$today);
        $data['completed_sum']=$this->orderSum('completed',$today);
        $data['cancled_sum']=$this->orderSum('cancled',$today);
        return view('admin.order.orderReportView', $data);


    }
}
    public function orderCount($staus,$today)
    {
         $count=DB::table('order_data')->where('order_status','=',$staus)->where('order_date','=',$today)->count();
        return $count;
    }
    public function orderSum($staus,$today)
    {


        $sum=DB::table('order_data')->where('order_status','=',$staus)->where('order_date','=',$today)->sum("order_data.order_total");
        return $sum;
    }

    public function statusChanged($staus,$order_id)
    {
        $data['order_status']=$staus;
        $result=DB::table('order_data')
            ->where('order_id','=',$order_id)
            ->update($data);
        if($result){
            return redirect('admin/orders')
                ->with('success', 'Updated successfully.');
        }



    }

    
    



}
