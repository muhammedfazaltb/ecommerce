<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShopDetails;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function createShop()
    {
        return view('admin.add_shop');
    }
    
    public function addShop(Request $request)
    {
        $result = User::create([
                 'name'=>$request->get('name'),
                 'email'=>$request->get('email'),
                 'role'=>'shop',
                 'password'=>Hash::make($request->get('password')),
                  ]);
       if($result)
       {
        $result1=ShopDetails::create([
                 'shop_id'=>$result->id,
                 'address'=>$request->get('address'),
                 'country'=>$request->get('country'),
                 'phone'=>$request->get('phone'),
                 ]);
        }
        $data['results']=User::where('role','shop')
                              ->join('shop_details','shop_details.shop_id','users.id')
                              ->get();
        return view('admin.lists_shop')->with($data); 
    }
    public function listShop()
    {
        $data['results']=User::where('role','shop')
                              ->join('shop_details','shop_details.shop_id','users.id')
                              ->get();
        return view('admin.lists_shop')->with($data);                      
    }
    public function editShop(Request $request)
    {
        $id=$request->segment(3);
        $data['results']=User::where('users.id',$id)
                              ->join('shop_details','shop_details.shop_id','users.id')
                              ->first();
        return view('admin.edit_shop')->with($data);                      
    }
    public function updateShop(Request $request)
    {
        $id=$request->get('shop_id');
        $data=User::where('id',$id)
                   ->first();
        $data->name=$request->get('name');
        $data->save();
        $details=ShopDetails::where('shop_id',$id)
                             ->first();
        $details->address=$request->get('address');
        $details->phone=$request->get('phone');
        $details->save();
        return redirect()->back();
         
    }
    public function productList(Request $request)
    {
    $result['products']=Product::where('status',0)->get();
    // dd($result['products']);
    return view('admin.productlist')->with($result);
    }
    public function ApprovedproductList(Request $request)
    {
    $result['products']=Product::where('status',1)->get();
    // dd($result['products']);
    return view('admin.approved_product')->with($result);
    }



    public function adminPostManage(Request $request){
      $user = Auth::user();
      $message = "";
      $statusCode = 6004;
      $result = null;
     switch ($request->get('type')){
      case 'approve_product' :
      // dd($request->get('id'));
      $result=Product::where('id',$request->get('id'))->first();
      $result->status = 1;
      $result->save();
      if($result)
      {
      $statusCode=6000;
      $message="Product Approved";
      return response()->json(['statusCode' => $statusCode, 'message' => $message]);
      }
      break;

      
        }
    }


}
