<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Actions\CreateArticleAction;
use App\Actions\UpdateArticleAction;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view("pages.article.index", [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateArticleAction $createArticleAction)
    {
        try {
            $createArticleAction->execute($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['message' => "Client créé avec succès!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('pages.article.edit', compact('article'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article, UpdateArticleAction $updateArticleAction)
    {
        try {
            $updateArticleAction->execute($article, $request->all());
    
            return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
{
    try {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    } catch (\Exception $e) {
        return redirect()->route('articles.index')->with('error', 'Une erreur est survenue lors de la suppression.');
    }
}

}
