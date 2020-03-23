<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ArticleFactory;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_articles()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->articles);
    }

    /** @test */
    function a_user_has_accessible_articles()
    {
        $john = $this->signIn();

        ArticleFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->accessibleArticles());

        $sally = factory(User::class)->create();
        $nick = factory(User::class)->create();

        $article = tap(ArticleFactory::ownedBy($sally)->create())->invite($nick);

        $this->assertCount(1, $john->accessibleArticles());

        $article->invite($john);

        $this->assertCount(2, $john->accessibleArticles());
    }
}
