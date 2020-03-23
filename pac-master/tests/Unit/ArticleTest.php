<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $article = factory('App\Article')->create();

        $this->assertEquals('/article/' . $article->id, $article->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $article = factory('App\Article')->create();

        $this->assertInstanceOf('App\User', $article->owner);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $article = factory('App\Article')->create();

        $task = $article->addTask('Test task');

        $this->assertCount(1, $article->tasks);
        $this->assertTrue($article->tasks->contains($task));
    }

    /** @test */
    function it_can_invite_a_user()
    {
        $article = factory('App\Article')->create();

        $article->invite($user = factory(User::class)->create());

        $this->assertTrue($article->members->contains($user));
    }
}
