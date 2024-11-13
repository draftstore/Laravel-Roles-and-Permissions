<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware():array{
        return [
            new Middleware('permission:view articles',['only' => ['index']]),
            new Middleware('permission:edit articles',['only' => ['edit']]),
            new Middleware('permission:create articles',['only' => ['create']]),
            new Middleware('permission:delete articles',['only' => ['destroy']]),
        ];
    }
    
    public function index()
    {
        $articles = Article::all();
        return view('articles.list', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'author' => 'required',
        ]);
        if($validator->passes())
        {
            // Store data
            $article = new Article;
            $article->title = $request->title;
            $article->author = $request->author;
            $article->text = $request->text;
            $article->save();
            return redirect()->route('articles.index')->with('success', 'Article created successfully');
        }
        else
        {
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit',[
            'article' => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
        ]);
        if($validator->passes())
        {
            $article->title = $request->title;
            $article->author = $request->author;
            $article->text = $request->text;
            $article->save();
            return redirect()->route('articles.index')->with('success', 'Article updated successfully');
        }
        else
        {
            return redirect()->route('articles.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }   
}
