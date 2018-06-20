<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use App\Article;
use App\Http\Requests\ArticleStoreRequest;

class ArticleController extends Controller
{
    protected $article;

    public function __construct(Article $article){
        $this->article = $article;
    }

    public function index(){
        return view('article.index');
    }

    public function create(){
        $route = URL::route('articles.store');
        return view('article.create', compact('route'));
    }

    public function edit($article_id){
        $route = URL::route('articles.update', $article_id);
        $article = $this->article->find($article_id);
        return view('article.edit', compact('route','article'));
    }

    public function store(ArticleStoreRequest $request){

        $basket = $request->except('_token');

        $store = $this->article->create($basket);

        if($store){
            return Redirect::route('articles.index')->with('success', 'Saved');
        }else{
            return Redirect::route('articles.index')->with('error', 'Save Failed');
        }

    }

    public function update(ArticleStoreRequest $request, $article_id){

        $basket = $request->except('_token', '_method');

        $store = $this->article->where('id', $article_id)->update($basket);

        if($store){
            return Redirect::route('articles.index')->with('success', 'Saved');
        }else{
            return Redirect::route('articles.index')->with('error', 'Save Failed');
        }

    }

    public function destroy($article_id){

        $if_article_exist = $this->article->where('id', $article_id)->exists();

        if($if_article_exist){
            $delete = $this->article->where('id', $article_id)->delete();
        }else{
            $delete = false;
        }

        return $delete;

    }

    public function getAll(){

        $articles = $this->article->all();

        foreach($articles as $article){
            $data[] = array(
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'created_at' => $article->created_at->format('Y-m-d H:i:s'),
                'edit_url' => URL::route('articles.edit', $article->id),
                'delete_url' => URL::route('articles.destroy', $article->id)
            ); 
        }

        return json_encode($data);

    }
}
