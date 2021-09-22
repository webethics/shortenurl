<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Redirect;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $per_page;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->per_page = Config('app.limit');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $urls = Url::where('user_id', $userId)->orderBy('id', 'DESC')->paginate($this->per_page);
        return view('home', compact('urls'));
        
    }

    public function redirect($slug){

        $slug = Url::where('slug',$slug)->first();
        if($slug){

            $destinationurl = $slug->destination;
            return Redirect::away($destinationurl);

        }else{

            return Redirect(route('/home'));
        }

        

    }
}
