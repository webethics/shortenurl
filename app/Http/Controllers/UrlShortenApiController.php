<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UrlShortenApiController extends Controller
{

	protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }


    /**
     * Display a listing of the urls.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return $this->user
            ->urls()->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('destination');
        $validator = Validator::make($data, [
            'destination' => 'required|url',            
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new shorten url
        $url = $this->user->urls()->create([
            'destination' => $request->destination,
            'slug' => unique_random_strings('urls', 'slug', 5),            
        ]);

        //Shorten url created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Shorten url created successfully',
            'data' => $url
        ], Response::HTTP_OK);
    }
    
}
