<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user may manage a article.
     *
     * @param  User    $user
     * @param  Article $article
     * @return bool
     */
    public function manage(User $user, Article $article)
    {
        return $user->is($article->owner);
    }

    /**
     * Determine if the user may update the article.
     *
     * @param  User    $user
     * @param  Article $article
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $user->is($article->owner) || $article->members->contains($user);
    }
}
