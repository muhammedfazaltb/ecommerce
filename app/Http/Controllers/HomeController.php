<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Cartdetails;
use App\Models\ProductCheckout;
use App\Models\Checkout;
use App\Models\BillingAddress;
use App\Models\ShippingAddress;
use App\Models\Country;
use App\Models\State;
use App\Models\Coupons;
use App\Models\Couponapplied;
use Auth;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['cart']=Cart::where('user_id',Auth::user()->id)
                          ->where('status',1)
                          ->count();
        $data['products']=Product::where('status',1)
                                  ->join('users','users.id','products.shop_id')
                                  ->leftjoin('shop_details','shop_details.shop_id','products.shop_id')
                                  ->select('products.*','users.name','shop_details.shop_id')
                                  ->get();
        $data['categories']=Category::get();    
        return view('home')->with($data);
    }
    public function adminHome()
    {
        return view('admin.adminHome');
    }
    public function shopHome()
    {
        return view('shop.shopHome');
    }
    public function productDetails(Request $request)
    {
      $id=$request->segment(3);
      $result['product']=Product::where('id',$id)->first();
      $result['cart']=Cart::where('user_id',Auth::user()->id)
                           ->where('status',1) 
                           ->count();
      return view('productdetails')->with($result);
    }
    public function productCart()
    {   $result['cart']=Cart::where('user_id',Auth::user()->id)
                            ->where('status',1)
                            ->count();
        $result['items']=Cart::where('user_id',Auth::user()->id)
                               ->where('carts.status',1) 
                               ->join('products','products.id','carts.product_id')
                               ->select('carts.*','products.product_name','products.primary_image')
                               ->get();
        $result['sum']=Cart::where('user_id',Auth::user()->id)
                            ->where('status',1)
                             ->sum('total');                     
        return view('cart')->with($result);
    }
    public function categoryProduct(Request $request)
    { 
        $id= $request->segment(3);
        $data['cart']=Cart::where('user_id',Auth::user()->id)
                          ->where('status',1)
                          ->count();
        $data['products']=Product::where('category_id',$id)
                                  ->where('status',1) 
                                  ->get();
        return view('categoryProduct')->with($data);
    }
    public function userOrders()
    {
        $data['cart']=Cart::where('user_id',Auth::user()->id)
                          ->where('status',1)
                          ->count();
        $data['orders']=ProductCheckout::where('product_checkouts.user_id',Auth::user()->id)
                                         ->join('checkouts','checkouts.id','product_checkouts.checkout_id')
                                        ->join('products','products.id','product_checkouts.product_id')
                                        ->select('product_checkouts.*','products.product_name')
                                        ->get();
        return view('orders')->with($data);
    }
    public function productCartsubmit(Request $request)
    {
      $cartdetails=Cartdetails::where('user_id',Auth::user()->id)->first();
      if($cartdetails)
      {
        if($request->get('final_sum')){
        $total=$cartdetails->total;
        $cartdetails->total=$total+$request->get('final_sum');
        $cartdetails->save();
        }
        else{
            $total=$cartdetails->total;
            $cartdetails->total=$total+$request->get('cart_sum');
            $cartdetails->save();   
        }  
      }
      else
      {
      if($request->get('final_sum')){
        $result=Cartdetails::create([
          'user_id'=>Auth::user()->id,
          'total'=>$request->get('final_sum'),
          'status'=>1,
        ]);
      }
      else
      {
       $result=Cartdetails::create([
          'user_id'=>Auth::user()->id,
          'total'=>$request->get('cart_sum'),
          'status'=>1,
        ]); 
      }
      }
     $data['user']=Auth::user()->id;
     $data['cart']=Cart::where('user_id',Auth::user()->id)
                       ->where('status',1)
                       ->count();
     $data['products']=Cart::where('user_id',Auth::user()->id)
                           ->where('carts.status',1)
                           ->join('products','products.id','carts.product_id')
                           ->get();
     $data['countries']=Country::get();
     $data['sum']=Cartdetails::where('user_id',Auth::user()->id)->where('status',1)->first();
     //dd($data['sum']);
     return view('checkout')->with($data);
    }
    
    // public function userCheckout(Request $request)
    // { 
    //     $data['user']=Auth::user()->id;
    //     $data['cart']=Cart::where('user_id',Auth::user()->id)
    //                         ->where('status',1)
    //                         ->count();
    //     $data['products']=Cart::where('user_id',Auth::user()->id)
    //                            ->where('carts.status',1)
    //                            ->join('products','products.id','carts.product_id')
    //                            ->get();
    //     $data['countries']=Country::get();
    //     // dd($data['countries']);
    //     $data['sum']=Cart::where('user_id',Auth::user()->id)->where('status',1)->sum('total');
    //     return view('checkout')->with($data);

    // }

    public function productCheckout(Request $request)
    {
        // checkout table
        if($request->get('shipto'))
        {
            $result2=Checkout::create([
            'user_id'=>Auth::user()->id,
              ]);
           // billing addrss table
            $result3=BillingAddress::create([
             'user_id'=>Auth::user()->id,
             'purchase_id'=>$result2->id,
             'first_name'=>$request->get('first_name'),
             'last_name'=>$request->get('last_name'),
             'email'=>$request->get('email'),
             'mobile'=>$request->get('mobile_no'),
             'address_1'=>$request->get('address_one'),
             'address_2'=>$request->get('address_two'),
             'country'=>$request->get('country'),
             'state'=>$request->get('state'),
             'city'=>$request->get('city'),
             'postcode'=>$request->get('postcode')
             ]);
           // shipping address
            $result4=ShippingAddress::create([
             'user_id'=>Auth::user()->id,
             'purchase_id'=>$result2->id,
             'first_name'=>$request->get('shipping_firstname'),
             'last_name'=>$request->get('shipping_lastname'),
             'email'=>$request->get('shipping_email'),
             'mobile'=>$request->get('shipping_mobile'),
             'address_1'=>$request->get('shipping_address1'),
             'address_2'=>$request->get('shipping_address2'),
             'country'=>$request->get('shipping_country'),
             'state'=>$request->get('shipping_state'),
             'city'=>$request->get('shipping_city'),
             'postcode'=>$request->get('shipping_postcode')
            ]);
            $result=Cart::where('user_id',Auth::user()->id)
                        ->where('status',1)
                        ->get();
           foreach($result as $res)
           {
             $result1=ProductCheckout::create([
                'checkout_id'=>$result2->id,
                'product_id'=>$res->product_id, 
                'user_id'   =>Auth::user()->id,
                'price'     =>$res->price,
                'colour'    =>$res->color,
                'count'     =>$res->count,
                'size'      =>$res->size,
                'total'     =>$res->total,
                'status'    =>1
            ]);
             $cart=Cart::where('user_id',Auth::user()->id)
                       ->where('status',1)
                       ->first();
             $cart->status=0;
             $cart->save();
           }
           $data['cart']=Cart::where('user_id',Auth::user()->id)
                            ->where('status',1)
                            ->count();
           $data['products']=Product::where('status',1)
                                    ->join('users','users.id','products.shop_id')
                                    ->leftjoin('shop_details','shop_details.shop_id','products.shop_id')
                                    ->select('products.*','users.name','shop_details.shop_id')
                                    ->get();
            $data['categories']=Category::get();    
            if($result)
            {
            Session::flash('message','Purchase success!');
            return redirect('home')->with($data);
            }     
        }
        else{
            $result2=Checkout::create([
             'user_id'=>Auth::user()->id,
            ]);
           // billing addrss table
            $result3=BillingAddress::create([
             'user_id'=>Auth::user()->id,
             'purchase_id'=>$result2->id,
             'first_name'=>$request->get('first_name'),
             'last_name'=>$request->get('last_name'),
             'email'=>$request->get('email'),
             'mobile'=>$request->get('mobile_no'),
             'address_1'=>$request->get('address_one'),
             'address_2'=>$request->get('address_two'),
             'country'=>$request->get('country'),
             'state'=>$request->get('first_name'),
             'city'=>$request->get('city'),
             'postcode'=>$request->get('postcode')
            ]);
            $result=Cart::where('user_id',Auth::user()->id)
                       ->where('status',1)
                       ->get();
            foreach($result as $res)
            {
              $result1=ProductCheckout::create([
                'checkout_id'=>$result2->id,
                'product_id'=>$res->product_id, 
                'user_id'   =>Auth::user()->id,
                'price'     =>$res->price,
                'colour'    =>$res->color,
                'count'     =>$res->count,
                'size'      =>$res->size,
                'total'     =>$res->total,
                'status'    =>1
               ]);
              $cart=Cart::where('user_id',Auth::user()->id)
                        ->where('status',1)
                        ->first();
              $cart->status=0;
              $cart->save();
            }
            $cartdetails=Cartdetails::where('user_id',Auth::user()->id)->delete();
            $data['cart']=Cart::where('user_id',Auth::user()->id)
                              ->where('status',1)
                              ->count();
            $data['products']=Product::where('status',1)
                                     ->join('users','users.id','products.shop_id')
                                     ->leftjoin('shop_details','shop_details.shop_id','products.shop_id')
                                     ->select('products.*','users.name','shop_details.shop_id')
                                     ->get();
            $data['categories']=Category::get();    
            if($result)
            {
             Session::flash('message','Purchase success!');
             return redirect('home')->with($data);
            }  
        }
    }
    public function userPostManage(Request $request){
      $user = Auth::user();
      $message = "";
      $statusCode = 6004;
      $result = null;
     switch ($request->get('type')){
      case 'add_cart' :
        $price=$request->get('price');
        $count=$request->get('count');
        $total=$price*$count;
        $result=Cart::create([
               'product_id' =>$request->get('id'),
               'user_id'   =>$user->id,
               'color'  =>$request->get('color'),
               'size'    =>$request->get('size'),
               'count'=>$count,
               'price'=>$price,
               'total'=>$total,
               'status'=>1,
        ]);
        if($result)
        {
        $statusCode=6000;
        $message="product added to cart";
        return response()->json(['statusCode' => $statusCode, 'message' => $message]);
        }
      break;
      case 'cart_minus':
        $result=Cart::where('id',$request->get('id'))->first();
        $count=$request->get('count');
        $countfinal=$count-1;
        $price=$result->price;
        $total=$countfinal*$price;
        $result->count=$countfinal;
        $result->total=$total;
        $result->save();
        if($result)
        {
          $statusCode=6000;
          $message="cart updated";
          return response()->json(['statusCode' => $statusCode, 'message' => $message]);
        }
      break;
      case 'cart_plus':
        $result=Cart::where('id',$request->get('id'))->first();
        $count=$request->get('count');
        $countfinal=$count+1;
        $price=$result->price;
        $total=$countfinal*$price;
        $result->count=$countfinal;
        $result->total=$total;
        $result->save();
        if($result)
        {
          $statusCode=6000;
          $message="cart updated";
          return response()->json(['statusCode' => $statusCode, 'message' => $message]);
        }
      break;
      case 'delete_item':
        $result=Cart::where('id',$request->get('id'))->delete();
        if($result)
        {
          $statusCode=6000;
          $message="item deleted";
          return response()->json(['statusCode' => $statusCode, 'message' => $message]);
        }
      break;
      case 'cancel_order':
        $result=ProductCheckout::where('checkout_id',$request->get('id'))->get();
        foreach($result as $res)
        {
            $res->status=2;
            $res->save();
        }
        if($result)
        {
         $statusCode=6000;
         $message="Order Cancelled ..!";
         return response()->json(['statusCode' => $statusCode, 'message' => $message]);
        }
      break; 
      case 'check_state':
       $country_id = $request->get('val');
       $results=State::where('country_id',$country_id)->get();
       $html="";
       if($results)
       {
         foreach($results as $res){
          $html.="<option value='".$res->id."'>".$res->name."</option>";
         } 
       }
       $statusCode=6000;
       $message="success";
       return response()->json(['statusCode' => $statusCode, 'message' => $message, 'result' => $html]);
      break;
      case 'coupon_code':
       $coupon=$request->get('coupon');
       $result=Coupons::where('coupon_code',$coupon)->where('status',1)->first();
       $id=$result->id;

       if($result)
       {
        $result1=Couponapplied::where('user_id',Auth::user()->id)->first();
        if($result1)
        {
        $statusCode=6004;
        $message="coupon already applied"; 
        return response()->json(['statusCode' => $statusCode, 'message' => $message]);
        }
        else
        {

        $result3=Couponapplied::create([
        'user_id'=>Auth::user()->id,
        'coupon_id'=>$id,
        ]);    
        $amount1=$result->amount;
        $result2=Cart::where('user_id',Auth::user()->id)->where('status',1)->sum('total');
        $html=$result2-$amount1;
        $statusCode=6000;
        $message="Coupon applied successfully..!";
        return response()->json(['statusCode' => $statusCode, 'message' => $message, 'result' => $html]);
        }
        
       }
       else
       {
        $statusCode=6004;
        $message="No coupon found"; 
        return response()->json(['statusCode' => $statusCode, 'message' => $message]);
       }
      break; 

      }
    }

}
