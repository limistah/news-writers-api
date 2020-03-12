<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersArticlesController extends Controller
{
    /**
     * Display a listing of all articles by users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["message" => "Returns articles by all the users"]);
    }

    /**
     * Display an articles by the specified user id.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return response()->json(["message" => "Returns an article by just a user"]);
    }
}
