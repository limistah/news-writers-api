<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersArticlesController extends Controller
{
    /**
     * Display an articles by the specified user id.
     *
     * @param  int  $writer
     * @return \Illuminate\Http\Response
     */
    public function show($writer)
    {
        return response()->json(["message" => "Returns an article by just a writer"]);
    }
}
