<?php

namespace Tests\Unit;

use App\Activity;
use App\Article;
use App\User;
use Facades\Tests\Setup\ArticleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_a_user()
    {
        $user = $this->signIn();

        $article = ArticleFactory::ownedBy($user)->create();

        $this->assertEquals($user->id, $article->activity->first()->user->id);
    }
}
