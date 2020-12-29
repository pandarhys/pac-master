<?php

namespace App\Http\Controllers;

use App\Article;
use App\Task;

class ArticleTasksController extends Controller
{
    /**
     * Add a task to the given article.
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Article $article)
    {
        $this->authorize('update', $article);

        request()->validate(['body' => 'required']);

        $article->addTask(request('body'));

        return redirect($article->path());
    }

    /**
     * Update the article.
     *
     * @param  Article $article
     * @param  Task    $task
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Article $article, Task $task)
    {
        $this->authorize('update', $task->article);

        $task->update(request()->validate(['body' => 'required']));

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($article->path());
    }
}
