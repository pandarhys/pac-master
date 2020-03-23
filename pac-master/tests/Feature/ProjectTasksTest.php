<?php

namespace Tests\Feature;

use App\Article;
use Facades\Tests\Setup\ArticleFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_articles()
    {
        $article = factory('App\Article')->create();

        $this->post($article->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    function only_the_owner_of_a_article_may_add_tasks()
    {
        $this->signIn();

        $article = factory('App\Article')->create();

        $this->post($article->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    function only_the_owner_of_a_article_may_update_a_task()
    {
        $this->signIn();

        $article = ArticleFactory::withTasks(1)->create();

        $this->patch($article->tasks[0]->path(), ['body' => 'changed'])
             ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /** @test */
    public function a_article_can_have_tasks()
    {
        $article = ArticleFactory::create();

        $this->actingAs($article->owner)
             ->post($article->path() . '/tasks', ['body' => 'Test task']);

        $this->get($article->path())
            ->assertSee('Test task');
    }

    /** @test */
    function a_task_can_be_updated()
    {
        $article = ArticleFactory::withTasks(1)->create();

        $this->actingAs($article->owner)
             ->patch($article->tasks[0]->path(), [
                'body' => 'changed'
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed'
        ]);
    }

    /** @test */
    function a_task_can_be_completed()
    {
        $article = ArticleFactory::withTasks(1)->create();

        $this->actingAs($article->owner)
            ->patch($article->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    function a_task_can_be_marked_as_incomplete()
    {
        $this->withoutExceptionHandling();

        $article = ArticleFactory::withTasks(1)->create();

        $this->actingAs($article->owner)
            ->patch($article->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->patch($article->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $article = ArticleFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($article->owner)
             ->post($article->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
