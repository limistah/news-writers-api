<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WritersController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    /**
     * Returns all the writers in the application
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["message" => "Returns all writers"]);
    }

    /**
     * Returns an writer by the specified user id.
     *
     * @param  int  $author_id
     * @return \Illuminate\Http\Response
     */
    public function show($author_id)
    {
        return response()->json(["message" => "Returns a writer"]);
    }
}