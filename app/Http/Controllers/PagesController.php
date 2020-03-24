<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class PagesController extends Controller
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
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('selestaMain')->with('sliders', $sliders);
    }





    public function about()
    {
        return view('about');
    }




    public function contacts()
    {
        return view('contacts');
    }
}
