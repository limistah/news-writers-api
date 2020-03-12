<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticle;
use App\Article;
use App\Http\Resources\ArticlesResource;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticlesResource::collection(Article::with("author")->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $credentials = $request->only("title", "body");
        $user = auth()->guard()->user();

        $credentials["author_na
        me"] = $user->name;
        $credentials["author_id"] = $user->id;

        $article = new Article($credentials);
        $article->save();

        return response()->json(["message" => "Article saved successfully", "data" => $article]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return Article::with("author")->findOrFail($article->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(["message" => "Updates an article"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article = Article::with("author")->find($article->id);
        Article::destroy($article->id);
        return response()->json(["message" => "Article deleted successfully", "data" => $article]);
    }
}
