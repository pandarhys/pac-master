<?php

namespace Tests\Setup;

use App\Article;
use App\Task;
use App\User;

class ArticleFactory
{
    /**
     * The number of tasks for the article.
     *
     * @var int
     */
    protected $tasksCount = 0;

    /**
     * The owner of the article.
     *
     * @var User
     */
    protected $user;

    /**
     * Set the number of tasks to create for the article.
     *
     * @param  int $count
     * @return $this
     */
    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    /**
     * Set the owner of the new article.
     *
     * @param  User $user
     * @return $this
     */
    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Arrange the world.
     *
     * @return Article
     */
    public function create()
    {
        $article = factory(Article::class)->create([
            'owner_id' => $this->user ?? factory(User::class)
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'article_id' => $article
        ]);

        return $article;
    }
}

