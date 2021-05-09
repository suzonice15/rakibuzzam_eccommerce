<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use  Cart;
use Jenssegers\Agent\Agent;

use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function __construct()
    {
        date_default_timezone_set("Asia/Dhaka");     //Country which we are selecting.
    }

    public function index()
    {


        $data['share_picture']=get_option('home_share_image');
        $data['seo_title']=get_option('home_seo_title');
        $data['seo_keywords']=get_option('home_seo_keywords');
        $data['seo_description']=get_option('home_seo_content');
        $data['categories']=DB::table('category')
            ->select('medium_banner','category_title','category_name')
            ->where('parent_id',0)->paginate(12);
     //   $data['products']=DB::table('product')->get();
        $data['sliders']=DB::table('homeslider')
            ->select('homeslider_title','target_url','homeslider_picture','homeslider_text')
            ->where('status',1)->get();
        $data['recentProducts'] = DB::table('product')
            ->select('product_id','product_title', 'product_name', 'discount_price', 'product_price', 'folder', 'feasured_image')
            ->where('status','=',1)
            ->whereNotIn('product_stock',[0])
            ->orderBy('product.modified_time','DESC')
            ->paginate(10);
            //dd($data['recentProducts']);
       return view('website.home',$data);
    }

    public function product_click(Request $request){



        $agent = new Agent();

      $device=  $agent->isDesktop();
        if($agent->isDesktop()==1){
            $data['device']="desktop";
        }elseif ($agent->isTablet()==1){
            $data['device']="tablet";
        } else {
            $data['device']="mobile";
        }
        $data['ip']=$request->ip();
        $ip =$request->ip();
        $data['view_from']=$_SERVER['HTTP_REFERER'];

        $data['product_id']=$request->product_id;



        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        if($details) {
            $data['city'] = $details->city;
            $data['phone'] = $details->phone;
            $data['region'] = $details->region;
            $data['country'] = $details->country;
        }
        DB::table('product_click')->insert($data);


    }

    public function ip(){
        $ip='103.120.39.9';
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        echo '<pre>';
        print_r($details);
        echo $details->city;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($category_name)
    {



      //  $data['categories']=DB::table('category')->select('category_id','category_title','category_name')->where('parent_id',0)->get();
       // SELECT DISTINCT* FROM `product` join category on category.category_id=product_category_relation.category_id WHERE category.category_name='electronics-items' SELECT DISTINCT* FROM `product` join product_category_relation on product_category_relation.product_id=product.product_id join category on category.category_id=product_category_relation.category_id WHERE category.category_name='electronics-items'
       $data['products'] =DB::table('product')
           ->select('discount_price','product_price','product_name','folder','feasured_image','product_title')
           ->join('product_category_relation','product_category_relation.product_id','=','product.product_id')
           ->join('category','category.category_id','=','product_category_relation.category_id')
           ->where('product.status','=',1)->where('category_name',$category_name)
           ->orderBy('modified_time','DESC')
           ->paginate(48);


       $category_row= DB::table('category')
           ->select('share_image','parent_id','category_name','category_title','seo_title','seo_keywords','seo_content')
           ->where('category_name',$category_name)
           ->first();





        $category_id = $category_row->parent_id;
        $category_row_second = DB::table('category')
            ->select('category.parent_id','category_title','category_name')
            ->where('category_id', $category_id)->first();

        if($category_row_second){
            $category_id = $category_row_second->parent_id;

            $data['category_name_middle'] = $category_row_second->category_name;
            $data['category_title_middle'] = $category_row_second->category_title;
            $category_row_first= DB::table('category')
                ->select('category.parent_id','category_title','category_name')
                ->where('category_id', $category_id)
                ->first();
            if($category_row_first){
                $data['category_name_first'] = $category_row_first->category_name;
                $data['category_title_first'] = $category_row_first->category_title;
            }


        }

            $data['category_name_last'] = $category_row->category_name;
            $data['category_name'] = $category_name;
            $data['category_title_last'] = $category_row->category_title;




        $data['share_picture']=url('/').'/'.$category_row->share_image;

        $data['seo_title']=$category_row->seo_title;
        $data['seo_keywords']=$category_row->seo_keywords;
        $data['seo_description']=$category_row->seo_content;

        return view('website.category',$data);
     }
    
    
    public  function allProducts(){


        $data['products'] =DB::table('product')
            ->select('discount_price','product_price','product_name','folder','feasured_image','product_title')
            ->where('product.status','=',1)
            ->orderBy('modified_time','desc')
            ->paginate(36);
        return view('website.all_products',$data);
    }

    public  function ajaxAllProducts(Request $request){

        if($request->ajax())
        {

            
            $products =DB::table('product')
                ->select('discount_price','product_price','product_name','folder','feasured_image','product_title')
                ->where('product.status','=',1)
                ->orderBy('modified_time','DESC')->paginate(36);
            //  return view('website.category_ajax', compact('products'));
            $view = view('website.all_product_by_ajax',compact('products'))->render();
            return response()->json(['html'=>$view]);
        }
    }
    public  function  ajax_category(Request $request){
        if($request->ajax())
        {

            $category_name = $request->get('category_name');
           // $query = str_replace(" ", "%", $query);
            $products =DB::table('product')
                ->select('discount_price','product_price','product_name','folder','feasured_image','product_title')
                ->join('product_category_relation','product_category_relation.product_id','=','product.product_id')
                ->join('category','category.category_id','=','product_category_relation.category_id')
                ->where('product.status','=',1)
                ->where('category_name',$category_name)
                ->orderBy('modified_time','DESC')
                ->paginate(48);

            //  return view('website.category_ajax', compact('products'));
            $view = view('website.category_ajax',compact('products'))->render();

            return response()->json(['html'=>$view]);
        }

    }
    public   function hot_home_product(){
        $data['products']=DB::table('product')->where('status','=',1)->orderBy('modified_time','desc')->get();
        $view = view('website.hot_home_ajax_product',$data)->render();
        return response()->json(['html'=>$view]);
    }
    public function home_page_category_ajax(){
       // $data['products']=DB::table('product')->get();
        $view = view('website.home_page_ajax_category')->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function product($product_name)
    {


       $data['product']=DB::table('product')->select('*')->where('product_name',$product_name)->first();
        if( $data['product']) {

            $category_row = DB::table('product')->select('category.parent_id','category_title','category_name')->join('product_category_relation', 'product_category_relation.product_id', '=', 'product.product_id')->join('category', 'category.category_id', '=', 'product_category_relation.category_id')->where('product_name', $product_name)->orderBy('category.category_id', 'DESC')->first();
            $data['page_title'] =  $data['product']->product_title;
            $data['seo_title'] =  $data['product']->seo_title;
            $data['seo_keywords'] =  $data['product']->seo_keywords;
            $data['seo_description'] =  $data['product']->seo_content;


            $data['share_picture']=url('/public/uploads/').'/'.$data['product']->folder.'/'. $data['product']->feasured_image;



            $category_id = $category_row->parent_id;
            $category_row_second = DB::table('category')->select('category.parent_id','category_title','category_name')->where('category_id', $category_id)->first();

            if($category_row_second){
                $category_id = $category_row_second->parent_id;

                $data['category_name_middle'] = $category_row_second->category_name;
                $data['category_title_middle'] = $category_row_second->category_title;
                $category_row_first= DB::table('category')->select('category.parent_id','category_title','category_name')->where('category_id', $category_id)->first();
                if($category_row_first){
                    $data['category_name_first'] = $category_row_first->category_name;
                    $data['category_title_first'] = $category_row_first->category_title;
                }


            }
            $data['category_name_last'] = $category_row->category_name;
            $data['category_title_last'] = $category_row->category_title;


            return view('website.product', $data);
        } else {

            $data['seo_title']=get_option('home_seo_title');
            $data['seo_keywords']=get_option('home_seo_keywords');
            $data['seo_description']=get_option('home_seo_content');
            $data['share_picture']=get_option('home_share_image');


            $data['page']=DB::table('page')->select('*')->where('page_link',$product_name)->first();
            if($data['page']) {
                return view('website.page', $data);
            } else {

                // affiliate test section

                $link_row = DB::table('product_link_info')->where('user_id', $product_name)->first();


                if ($link_row) {
                    $unique_number = (mt_rand(10000, 999999));
                    $unique_number = $unique_number . $link_row->id;

                  //  echo $unique_number;exit();

                    Cookie::queue('unique_code', $unique_number, 10);
                    Cookie::queue('link_id', $link_row->id, 10);


                    //$product_row = DB::table('product')->select('product_id')->where('product_name', $product_key)->first();
                    $data = array(
                        'user_id' => $product_name,
                        'product_id' => 0,
                        'unique_number' => $unique_number,
                        'hit_date' => date('Y-m-d')
                    );

                    DB::table('product_hit_count')->insert($data);



                    return redirect('/');
                } else {


                    return redirect('/');
                }
            }
            
        }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search_engine(Request $request)
    {
        $search_query = $request->search_query;
        $search_query = str_replace(" ", "%", $search_query);
        $data['products'] = DB::table('product')
            ->select('product_title','folder','feasured_image','product_price','sku','discount_price', 'product_name')
            ->where('status','=',1)
            ->where(function ($query) use ($search_query) {
                return $query->where('sku','LIKE','%'.$search_query.'%')
                    ->orWhere('product_title','LIKE','%'.$search_query.'%');
            })->orderBy('modified_time','desc')->paginate(7);
        $data['search_query']=$search_query;

        $view = view('website.search_engine',$data)->render();
        return response()->json(['html'=>$view]);



    }

    public  function search(Request $request){
        $search_query = $request->search;
        $data['share_picture']=get_option('home_share_image');
        $search_query = str_replace(" ", "%", $search_query);
        $products= DB::table('product')
            ->select('product_id','product_title','folder','feasured_image','product_price','sku','discount_price', 'product_name')
            ->where('product.status','!=',0)
            ->where('sku','LIKE','%'.$search_query.'%')
            ->orWhere('product_title','LIKE','%'.$search_query.'%')->orderBy('modified_time','desc')->get();
        if(count($products)==1){
            $product_url=url('/').'/'.$products[0]->product_name;
          //  redirect($product_url;
            return redirect("$product_url");

        }


            return view('website.search', compact('products','search_query'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function track_order(Request $request)
    {
        if($request->mobile){
            $data['mobile']=$request->mobile;
           $data['order']= DB::table('order_data')->where('customer_phone',$request->mobile)->orderBy('order_id','desc')->first();

$data['mobile']=$request->mobile;

            return view('website.track_order_page',$data);
        } else {
            return view('website.track_order_page');
        }
    }
    public function affiliate_check_controller($product_key = null, $user_id = null)
    {
        // $base=base_url


        $link = url('/') . '/' . $product_key . "/" . $user_id;
        $link_row = DB::table('product_link_info')->where('product_link', $link)->first();


        if ($link_row) {
            $unique_number = (mt_rand(10000, 999999));
            $unique_number = $unique_number . $link_row->id;

            Cookie::queue('unique_code', $unique_number, 10);
            Cookie::queue('link_id', $link_row->id, 10);


            $product_row = DB::table('product')->select('product_id')->where('product_name', $product_key)->first();
            $data = array(
                'user_id' => $user_id,
                'product_id' => $product_row->product_id,
                'unique_number' => $unique_number,
                'hit_date' => date('Y-m-d')
            );

            DB::table('product_hit_count')->insert($data);

            $get_link = url('/') . "/product/" . $product_key;

            return redirect($get_link);
        } else {

            return redirect('/');
        }
    }
    public function affilates_products(){
        
        return view('website.affilates_products');
    
}
    public function askQuestionsFromWebsite(Request $request){
        $data['comment_from_customer'] = $request->question;
        $data['question_email'] = $request->question_email;

        

        $data['product_id'] = $request->product_id;
       $vendor= DB::table('product')->select('vendor_id')->where('product_id', $request->product_id)->first();
        if($vendor){
            $data['vendor_id'] = $vendor->vendor_id;
        }
      
        $data['staus'] = 1;
       $resutl= DB::table('product_comment')->insert($data);
        if($resutl){
            return response()->json(['result'=>'done']);
        } else {
            return response()->json(['result'=>'failed']);
        }

    }
    public function allQuestions($product_id){

        $data['comments']= DB::table('product_comment')
            ->where('product_id',$product_id)
            ->orderBy('comment_id','desc')
            ->get();
       
            return view('website.single_product_comment',$data);
           

    }


}
