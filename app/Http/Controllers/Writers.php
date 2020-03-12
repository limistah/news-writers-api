<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Writers extends Controller
{
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
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return response()->json(["message" => "Returns a writer"]);
    }
}
