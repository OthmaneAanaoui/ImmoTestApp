<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupère tous les articles et les retourne en tant que JSON
        return Article::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // Retourne un article spécifique en tant que JSON
        return $article;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valide les données de la requête et crée un nouvel article dans la base de données
        $article = Article::create($request->all());
        // Retourne l'article créé avec le code de réponse HTTP 201 (Created)
        return response()->json($article, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // Valide les données de la requête et met à jour l'article dans la base de données
        $article->update($request->all());
        // Retourne l'article mis à jour avec le code de réponse HTTP 200 (OK)
        return response()->json($article, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // Supprime l'article de la base de données
        $article->delete();
        // Retourne une réponse vide avec le code de réponse HTTP 204 (No Content)
        return response()->json(null, 204);
    }
}
