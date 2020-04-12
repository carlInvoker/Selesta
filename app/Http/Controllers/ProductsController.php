<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use File;
use DataTables;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index(Request $request)
     {
       if($request->product_category)
        {
          $products = Product::select("*")
          ->where('product_status',  1)
          ->where('product_category','LIKE','%'.$request->product_category.'%')
          ->get();
          return view('products', ['products' => $products, 'category' => $request->product_category]);
        }
        else {
          $products = Product::select("*")->where('product_status',  1)->get();
          return view('products')->with('products', $products);
        }
     }

     public function showCatalog()
     {
         return view('catalog');
     }


     public function getProducts(Request $request)
     {
        if ($request->ajax()) {
            $products = Product::orderBy('product_status', 'desc')->orderBy('updated_at', 'desc')->get();
            return Datatables::of($products)
                ->addIndexColumn()
                ->addColumn('product_description', function($products){
                  $btn = $products->product_description;
                  return $btn;})
                ->addColumn('product_image', function($products){
                  $btn = "<img src=".url("/images/products/{$products->product_image}")." alt='image' style='width:100px; height:100px;' onerror='altImage(this)'>";
                  return $btn;})
                ->addColumn('edit', function($products){
                  $btn = "<a href=".url("/admin/addProduct/{$products->product_id}")." class='btn btn-warning'>Редагувати</a>";
                  return $btn;})
                ->addColumn('status', function($products){
                  if($products->product_status == 1) {
                    $btn = "<button type='button' class='btn btn-success actionButton' value=".url("admin/changeStatus/{$products->product_id}")." onclick='changeStatus(this)'>&nbsp;&nbsp;Активний&nbsp;&nbsp;</button>";
                  }
                  else {
                    $btn = "<button type='button' class='btn btn-danger actionButton' value=".url("admin/changeStatus/{$products->product_id}")." onclick='changeStatus(this)'>Неактивний</button>";
                  }
                  return $btn;})
                ->rawColumns(['product_description','product_image', 'edit','status'])
                ->make(true);
        }
        return view('admin.products', ['selected' => 2]);
      }

      public function showDetails($id)
      {
          $product = Product::find($id);
          return view('product_details')->with('product', $product);
      }


         // $products = Product::all();
         // return view('admin.products')->with('products', $products);
    // }

     public function addProductForm()
     {
         $categories = array(
           "Догляд за волоссям" =>  array(
              "Шампуні та кондиціонери",
              "Маски для волосся",
              "Масло для волосся",
           ),
           "Мило та гелі для душу" => array(
             "Гелі для душу",
             "Гліцеринове мило",
             "Рослинне мило",
             "Традиційне мило",
             "Рідке мило",
           ),
           "Креми та маски" => array(
             "Креми для обличчя та рук",
             "Маски для обличчя",
             "Вазелін",
           ),
           "Інші засоби" => array(
             "Догляд за обличчям",
             "Антивікові засоби",
             "Спеціальні набори",
             "Антицелюлітні засоби",
             "Захист від сонця",
             "Інше",
           ),
         );
         return view('admin.add_product', ['categories' => $categories, 'selected' => 2]);
     }

     public function  editProductForm($id)
     {
         $product = Product::find($id);
         $categories = array(
           "Догляд за волоссям" =>  array(
              "Шампуні та кондиціонери",
              "Маски для волосся",
              "Масло для волосся",
           ),
           "Мило та гелі для душу" => array(
             "Гелі для душу",
             "Гліцеринове мило",
             "Рослинне мило",
             "Традиційне мило",
             "Рідке мило",
           ),
           "Креми та маски" => array(
             "Креми для обличчя та рук",
             "Маски для обличчя",
             "Вазелін",
           ),
           "Інші засоби" => array(
             "Догляд за обличчям",
             "Антивікові засоби",
             "Спеціальні набори",
             "Антицелюлітні засоби",
             "Захист від сонця",
             "Інше",
           ),
         );
         return view('admin.add_product', ['categories' => $categories, 'product' => $product, 'selected' => 2]);
     }

     public function  addProduct(Request $request)
     {
          $validator = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:200000',
            'product_price ' => 'numeric',
            'product_image ' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'product_status ' => 'integer|max:1|min:0',
            'title' => 'required|string|max:128',
            'metaDescription' => 'required|string|max:160',
            'metaKeywords' => 'required|string|max:160',
            '_token' => 'required',
          ]);

            if($request->product_id) {
              $product = Product::find($request->product_id);
            }
            else {
              $product = new Product;
            }

            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->product_price = $request->product_price;

            if($request->product_image) {
              $old_img = public_path('images/products/').$product->product_image;
              File::delete($old_img);
              $product->product_image = time().'.'.$request->product_image->getClientOriginalExtension();
              $request->product_image->move(public_path('images/products'), $product->product_image);
            }

            $product->product_status = $request->product_status;

            $product->product_category = $request->input('product_category');
            $product->product_category = implode(',', $product->product_category);

            $product->title = $request->title;
            $product->metaDescription = $request->metaDescription;
            $product->metaKeywords = $request->metaKeywords;
            $product->save();
            return redirect('admin/products')->with('selected', 2);
      }

      public function  changeStatus($id)
      {
          $product = Product::find($id);
          if($product->product_status == 0) {
            $product->product_status = 1;
          }
          else {
            $product->product_status = 0;
          }
          $product->save();
          $res = ['productStatus' => $product->product_status];
          return json_encode($res);
      }


      public function  searchCategory(Request $request)
      {
            $data = json_decode($request->input('data'));

            $products = Product::select("*")
                      ->when(!empty($data->product_name) , function ($query) use($data){
                      return $query->where('product_name', 'LIKE', '%'.$data->product_name.'%');
                      })
                      ->when(!empty($data->minPrice) , function ($query) use($data){
                      return $query->where('product_price', '>', $data->minPrice);
                      })
                      ->when(!empty($data->maxPrice) , function ($query) use($data){
                      return $query->where('product_price', '<', $data->maxPrice);
                      })
                      ->when(!empty($data->category) , function ($query) use($data){
                      return $query->where('product_category','LIKE','%'.$data->category.'%');
                      })
                      ->where('product_status',  1)
                      ->get();
            return json_encode($products);
      }

      public function  searchMain(Request $request)
      {
            $data = json_decode($request->input('data'));

            $products = Product::select("*")
                      ->where('product_name', 'LIKE', '%'.$data->product_name.'%')
                      ->where('product_status',  1)
                      ->get();
            return json_encode($products);
      }

}
