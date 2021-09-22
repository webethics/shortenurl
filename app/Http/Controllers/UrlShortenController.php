<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUrlPostRequest;
use App\Models\Url;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
class UrlShortenController extends Controller
{

	protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config('app.limit');
    }
	
   /**
	* Store a new Shorten Url.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(StoreUrlPostRequest $request)
	{
		
		$data = array();
		$userId = Auth::id();
	    $data['destination'] = $request['destination'];
	    $data['slug'] = unique_random_strings('urls', 'slug', 5);
	    $data['user_id'] =$userId;

	    $shortenurl = Url::create($data);

	    if(!$shortenurl){

	    	Session::flash('success', 'Error in saving data.'); 

	    }else{
	    	Session::flash('success', 'Shorten url created.'); 
		}

	    return redirect('/home');
	}

}
