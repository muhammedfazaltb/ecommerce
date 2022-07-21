<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Auth;
use Session;

class ShopController extends Controller
{
    //
    public function addCategory()
    {
        // dd('hit');
        return view('shop.addcategory');
    }
    public function createCategory(Request $request)
    {
       $file_url="";
        if ($request->hasFile('image')) {
            // dd('hit');
        $file = request()->file('image');
        $file_url =$file->store('toPath', ['disk' => 'my_files']);
                } 
     $result=Category::create([
        'shop_id'      => Auth::user()->id,
        'category_name' =>$request->get('category_name'),
        'description'   =>$request->get('description'),
        'image'        =>$file_url,
     ]);
     return redirect()->back();
    }
    public function addBrand()
    {
        $data['categories']=Category::where('shop_id',Auth::user()->id)->get();
        return view('shop.addbrand')->with($data);   
    }
    public function createBrand(Request $request)
    {
     $result=Brand::create([
        'shop_id'      => Auth::user()->id,
        'category_id' =>$request->get('category'),
        'brand_name'  =>$request->get('brand_name'),
        'description'   =>$request->get('description'),
     ]);
     return redirect()->back();
    }
    public function addProduct()
    {
        // dd('hit');
        $data['categories']=Category::where('shop_id',Auth::user()->id)->get();
        return view('shop.addproduct')->with($data);
    }
    public function shopPostManage(Request $request){
      $user = Auth::user();
      $message = "";
      $statusCode = 6004;
      $result = null;
      $url = "";
     switch ($request->get('type')){
      case 'check_brand' :
    // dd('hit');
      $category_id = $request->get('val');
      $results=Brand::where('category_id',$category_id)->get();
      // dd($results);
      $html="";
      if($results)
      {
         foreach($results as $res){
          $html.="<option value='".$res->id."'>".$res->brand_name."</option>";
         } 
      }
      $statusCode=6000;
      $message="success";
      return response()->json(['statusCode' => $statusCode, 'message' => $message, 'result' => $html]);

      break;
      // case 'delete_cat' :
      // $result=Category::where('id',$request->get('id'))->delete();
      // $statusCode=6000;
      // $message="Category deleted";
      // return response()->json(['statusCode' => $statusCode, 'message' => $message]);
      //break;
      
        }
    }
   public function createProduct(Request $request)
   {
     // dd($request->get('product_color'));
   $file_url="";
   if ($request->hasFile('image')) {
     $file = request()->file('image');
     $file_url =$file->store('toPath', ['disk' => 'my_files']);
                }
                
    $result=Product::create([
        'shop_id'     => Auth::user()->id,
        'category_id' => $request->get('category_id'),
        'brand_id'    => $request->get('division_id'),
        'product_name'=> $request->get('product_name'),
        'description' => $request->get('description'),
        'price'       => $request->get('product_price'),
        'primary_image'=>$file_url,
        'color'        =>$request->get('product_color'),
        'size'         =>$request->get('product_size'), 
        'status'=>0,
 
     ]); 
     return redirect()->back();          
   }
   public function listCategory()
   {
   $data['categories']=Category::get();
   return view('shop.listcategory')->with($data);
   }
   
   public function editCategory(Request $request)
   {
    $id=$request->segment(3);
    $data['category']=Category::where('id',$id)->first();
    return view('shop.editcategory')->with($data);
   }
   public function updateCategory(Request $request)
   {
    $id=$request->get('category_id');
    $result=Category::where('id',$id)->first();
    $result->category_name= $request->get('category_name');
    $result->description=   $request->get('description');
    $result->save();
    return redirect()->back();
   }
   public function listBrand()
   {
   $data['brands']=Brand::where('brands.shop_id',Auth::user()->id)
                        ->join('categories','categories.id','brands.category_id')
                         ->get();
                         // dd($data['brands']);
   return view('shop.listbrand')->with($data);
   }  
   public function editBrand(Request $request)
   {
    $id=$request->segment(3);
    $data['brand']=Brand::where('id',$id)->first();
    $data['categories']=Category::where('shop_id',Auth::user()->id)->get();
    return view('shop.editbrand')->with($data);
   } 
   public function updateBrand(Request $request)
   {
    $id=$request->get('brand_id');
    $result=Brand::where('id',$id)->first();
    $result->category_id = $request->get('category');
    $result->brand_name = $request->get('brand_name');
    $result->description= $request->get('description');
    $result->save();
    return redirect()->back();
   }
  public function listProduct()
  {
    $data['products']=Product::where('products.shop_id',Auth::user()->id)
                               ->join('categories','categories.id','products.category_id')
                               ->join('brands','brands.id','products.brand_id')
                               ->get();
                               // dd($data['products']);
    return view('shop.listproduct')->with($data);                           
  }
}
