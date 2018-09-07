<?php

namespace App\Http\Controllers;
use App\Http\webConfig;
use Illuminate\Http\Request;
//use config\homePageSettings as conf;
//use App\Http\webConfig as web;
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
 public function index2()
    {
return view('homepopup');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$catOptions=[
        "Infraestructura",
        "Accidente",
        "Otros"
        ];*/
         $web=webConfig::$langs['en'];
         $catOptions=webConfig::$catOptions;
       // $catOptions2=conf['catOptions'];
        return view('home', ['catOptions' => $catOptions]);
    }
}
