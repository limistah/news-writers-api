<?php

namespace App\Http\Controllers;

use App\Http\Resources\WritersResource;
use App\User;
use Illuminate\Http\Request;

class WritersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Returns all the writers in the application
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WritersResource::collection(User::withCount("articles")->paginate(100));
    }

    /**
     * Returns an writer by the specified user id.
     *
     * @param  int  $writer
     * @return \Illuminate\Http\Response
     */
    public function show(User $writer)
    {
        return User::withCount("articles")->findOrFail($writer->id);
    }
}
