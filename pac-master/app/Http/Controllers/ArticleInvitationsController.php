<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleInvitationRequest;
use App\Article;
use App\User;

class ArticleInvitationsController extends Controller
{
    /**
     * Invite a new user to the article.
     *
     * @param  Article                  $article
     * @param  ArticleInvitationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Article $article, ArticleInvitationRequest $request)
    {
        $user = User::whereEmail(request('email'))->first();

        $article->invite($user);

        return redirect($article->path());
    }
}
