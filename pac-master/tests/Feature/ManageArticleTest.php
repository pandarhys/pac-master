<?php

namespace Tests\Feature;

use App\Article;
use App\Task;
use Facades\Tests\Setup\ArticleFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageArticlesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_articles()
    {
        $article = factory('App\Article')->create();

        $this->get('/article')->assertRedirect('login');
        $this->get('/article/create')->assertRedirect('login');
        $this->get($article->path().'/edit')->assertRedirect('login');
        $this->get($article->path())->assertRedirect('login');
        $this->post('/article', $article->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_article()
    {
        $this->signIn();

        $this->get('/article/create')->assertStatus(200);

        $this->followingRedirects()
            ->post('/article', $attributes = factory(Article::class)->raw())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description']);
    }

//    /** @test */
//    function tasks_can_be_included_as_part_a_new_article_creation()
//    {
//        $this->signIn();
//
//        $attributes = factory(Article::class)->raw();
//
//        $attributes['tasks'] = [
//            ['body' => 'Task 1'],
//            ['body' => 'Task 2']
//        ];
//
//        $this->post('/article', $attributes);
//
//        $this->assertCount(2, Article::first()->tasks);
//    }

//    /** @test */
//    function a_user_can_see_all_articles_they_have_been_invited_to_on_their_dashboard()
//    {
//        $article = tap(ArticleFactory::create())->invite($this->signIn());
//
//        $this->get('/article')->assertSee($article->title);
//    }

    /** @test */
    function unauthorized_users_cannot_delete_articles()
    {
        $article = ArticleFactory::create();

        $this->delete($article->path())
            ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($article->path())->assertStatus(403);

        $article->invite($user);

        $this->actingAs($user)->delete($article->path())->assertStatus(403);
    }

    /** @test */
    function a_user_can_delete_a_article()
    {
        $article = ArticleFactory::create();

        $this->actingAs($article->owner)
            ->delete($article->path())
            ->assertRedirect('/article');

        $this->assertDatabaseMissing('articles', $article->only('id'));
    }

    /** @test */
    function a_user_can_update_a_article()
    {
        $article = ArticleFactory::create();

        $this->actingAs($article->owner)
             ->patch($article->path(), $attributes = ['title' => 'Changed', 'description' => 'Changed'])
             ->assertRedirect($article->path());

        $this->get($article->path().'/edit')->assertOk();

        $this->assertDatabaseHas('articles', $attributes);
    }

//    /** @test */
//    function a_user_can_update_a_articles_general_notes()
//    {
//        $article = ArticleFactory::create();
//
//        $this->actingAs($article->owner)
//            ->patch($article->path(), $attributes = ['notes' => 'Changed']);
//
//        $this->assertDatabaseHas('articles', $attributes);
//    }

    /** @test */
    public function a_user_can_view_their_article()
    {
        $this->withExceptionHandling();
        $article = ArticleFactory::create();

        $this->actingAs($article->owner)
            ->get($article->path())
            ->assertSee($article->title)
            ->assertSee($article->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_articles_of_others()
    {
        $this->signIn();

        $article = factory('App\Article')->create();

        $this->get($article->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_articles_of_others()
    {
        $this->signIn();

        $article = factory('App\Article')->create();

        $this->patch($article->path())->assertStatus(403);
    }

    /** @test */
    public function a_article_requires_a_title()
    {
        $this->signIn();

        $attributes = factory('App\Article')->raw(['title' => '']);

        $this->post('/article', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_article_requires_a_description()
    {
        $this->signIn();

        $attributes = factory('App\Article')->raw(['description' => '']);

        $this->post('/article', $attributes)->assertSessionHasErrors('description');
    }
}
