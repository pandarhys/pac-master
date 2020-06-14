<?php

namespace App\Http\Controllers;

use App\Article;

class ArticlesController extends Controller
{
    /**
     * View all article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = auth()->user()->accessibleArticles();

        return view('article.index', compact('articles'));
    }

    /**
     * Show a single article.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Article $article)
    {
        $this->authorize('update', $article);

        return view('article.show', compact('article'));
    }

    /**
     * Create a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Persist a new article.
     *
     * @return mixed
     */
    public function store()
    {
        $article = auth()->user()->articles()->create($this->validateRequest());

        if ($tasks = request('tasks')) {
            $article->addTasks($tasks);
        }

        if (request()->wantsJson()) {
            return ['message' => $article->path()];
        }

        return redirect($article->path());

    }

    /**
     * Edit the article.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the article.
     *
     * @param  Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Article $article)
    {
        $this->authorize('update', $article);

        $article->update($this->validateRequest());

        return redirect($article->path());
    }

    /**
     * Destroy the article.
     *
     * @param  Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Article $article)
    {
        $this->authorize('manage', $article);

        $article->delete();

        return redirect('/article');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
          //  'title'                 => 'sometimes|required',
            'title'                 => 'required',
            'description'           => 'required',
            'earliest_date'         => 'required',
            'latest_date'           => 'required',
            'image_file_names'      => 'required',
            'physical_description'  => 'nullable',
            'designer'              => 'nullable',
            'origin'                => 'nullable',
            'materials'             => 'nullable',
            'techniques'            => 'nullable',
            'decorations'            => 'nullable',
            'search_words'          => 'nullable',
            'sewing_methods'        => 'nullable',
            'classification'        => 'nullable',
            'cut'                   => 'nullable',
            'fastenings'             => 'nullable',
            'stiffening'            => 'nullable',
            'condition'             => 'nullable',
            'measurements'          => 'nullable',
            'alterations'           => 'nullable',
            'provenance'            => 'nullable',
            'consent'               => 'required'
        ]);
    }
}
