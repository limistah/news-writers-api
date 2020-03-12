<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticlesResource;
use App\User;
use Illuminate\Http\Request;

class UsersArticlesController extends Controller
{
    /**
     * Display an articles by the specified user id.
     *
     * @param  int  $writer
     * @return \Illuminate\Http\Response
     */
    public function show(User $writer)
    {
        return ArticlesResource::collection(Article::with("author")->where("author_id", "=", $writer->id)->paginate(5));
    }
}
