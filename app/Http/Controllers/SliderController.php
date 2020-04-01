<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use Validator;
use File;
use DataTables;

class SliderController extends Controller
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


     public function getSlides(Request $request)  //   1
     {
        if ($request->ajax()) {
            $sliders = Slider::latest()->orderBy('sliders_status')->get();
            return Datatables::of($sliders)
                ->addIndexColumn()
                // ->addColumn('sliders_header', function($sliders){
                //   $btn = $sliders->sliders_header;
                //   return $btn;})
                ->addColumn('sliders_description', function($sliders){
                  $btn = $sliders->sliders_description;
                  return $btn;})
                ->addColumn('sliders_product_name', function($sliders){
                  $product = Product::find($sliders->product_id);
                  $btn = $product->product_name;
                  return $btn;})
                ->addColumn('sliders_image', function($sliders){
                  $btn = "<img src=".url("/images/slider/{$sliders->sliders_image}")." alt='image' style='width:100px; height:100px;' onerror='altImage(this)'>";
                  return $btn;})
                ->addColumn('edit', function($sliders){
                  $btn = "<a href=".url("/admin/addSlide/{$sliders->sliders_id}")." class='btn btn-warning'>Редагувати</a>";
                  return $btn;})
                ->addColumn('status', function($sliders){
                  if($sliders->sliders_status == 1) {
                    $btn = "<button type='button' class='btn btn-success actionButton' value=".url("admin/changeSlidersStatus/{$sliders->sliders_id}")." onclick='changeStatus(this)'>&nbsp;&nbsp;Активний&nbsp;&nbsp;</button>";
                  }
                  else {
                    $btn = "<button type='button' class='btn btn-danger actionButton' value=".url("admin/changeSlidersStatus/{$sliders->sliders_id}")." onclick='changeStatus(this)'>Неактивний</button>";
                  }
                  return $btn;})
                ->rawColumns(['sliders_description', 'sliders_product_name', 'sliders_image', 'edit','status'])
                ->make(true);
        }
        return view('admin.sliders', ['selected' => 3]);
      }

     public function addSlideForm()  //    2
     {
         $products = Product::all();
         return view('admin.add_slide', ['products' => $products, 'selected' => 3]);
     }

     public function  editSlideForm($id)   //    3/4
     {
         $products = Product::all('product_id', 'product_name');
         $slider = Slider::find($id);
         return view('admin.add_slide', ['slider' => $slider, 'products' => $products, 'selected' => 3]);
     }

     public function  addSlide(Request $request)   //    3/4
     {
          // далі відновити image = not nullable у бд, перевірити валідацію
          // зробити відображення слайдів на головній сторінці, та допрацювати ксс код картинок

         // return dd($request->product_id, $request->sliders_status);
          $validator = $request->validate([
            'sliders_header' => 'required|string|max:255',
            'sliders_description' => 'string|max:200000',
            //
            'sliders_image ' => 'image|mimes:jpeg,png,jpg,svg|max:1024',
            'sliders_status ' => 'integer|max:1|min:0',
            'product_id ' => 'integer',
            '_token' => 'required',
          ]);

            if($request->sliders_id) {
              $slider = Slider::find($request->sliders_id);
            }
            else {
              $slider = new Slider;
            }

            $slider->sliders_header = $request->sliders_header;
            $slider->sliders_description = $request->sliders_description;


            if($request->sliders_image) {
              $old_img = public_path('images/slider/').$slider->sliders_image;
              File::delete($old_img);
              $slider->sliders_image = time().'.'.$request->sliders_image->getClientOriginalExtension();
              $request->sliders_image->move(public_path('images/slider'), $slider->sliders_image);
            }

            $slider->sliders_status = $request->sliders_status;
            $slider->product_id = $request->product_id;
            $slider->save();
            return redirect('admin/sliders');
      }

      public function  changeStatus($id)  //  5
      {
          $slider = Slider::find($id);
          if($slider->sliders_status == 0) {
            $slider->sliders_status = 1;
          }
          else {
            $slider->sliders_status = 0;
          }
          $slider->save();
          $res = ['sliderStatus' => $slider->sliders_status];
          return json_encode($res);
      }

}
